<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Properties;

class brentGnaf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brent:gnaf';
    protected $description = 'Match the properties table data with gnaf_addresses table';
    public $table = 'gnaf_addresses';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        echo "function syncData calling \n\r";
        $this->syncData();
    }

    protected function translations()
    {
        return [
            // 'ADDRESS_DETAIL_PID' => 'gnaf',
            // 'ADDRESS_DETAIL_NAME' => 'name',
            'FLAT_NUMBER' => 'unit_number',
            'FLAT_TYPE' => 'unit_type_code',
            'NUMBER_FIRST' => 'road_number_1',
            'NUMBER_LAST' => 'road_number_2',
            'STREET_TYPE_CODE' => 'road_type_code',
            'LOCALITY_NAME' => 'locality_name',
            'POSTCODE' => 'postcode',
            'STREET_NAME' => 'road_name',
            'LOT_NUMBER' => 'lot_number',
            'STATE_ABBREVIATION' => 'state_territory_code',
        ];
    }

    protected function syncData()
    {

        $getPropertiesData = Properties::select('id', 'property_id', 'name', 'gnaf', 'road_number_1', 'road_number_2', 'postcode', 'locality_name', 'lot_number', 'road_type_code', 'state_territory_code', 'road_name', 'level_type_code', 'level_number', 'unit_type_code', 'unit_number')
        ->where(function($query){
            $query->where('gnaf', null)->orWhere('gnaf', '');
        })
        ->where('deleted_at',null)
        ->limit(8000)
        ->offset(144368)
        ->get()
        ->toArray();

        // set output filename
        $fileName = 'property.csv';
        // create the headers for the csv file
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        // declare the columns for the csv file and put the data to csv
        $columns = array('Property ID', 'Address Detail PID', 'Property Name', 'Address Detail Name');
        $path = storage_path('app/public/');
        $file = fopen($path . $fileName, 'a');
        fputcsv($file, $columns);

        //echo "Found Records: ".count($getPropertiesData );
        $i = 0;
        foreach ($getPropertiesData as $k => $row)
        {
            //echo "Checking: {$k} => {$row['name']}\n";
            $match = $this->loopMatch($row);
            //if ($match) {
            //    $i++;
            //    echo "\tMatch Count: {$i}\n";
            //}
            if (!empty($match)) {
                $i++;
                //echo "\tMatch Count: {$i}\n";
                fputcsv($file, array($row['id'], $match[0], $row['name'], $match[1]));
            }

        }

    }

    protected function loopMatch($row)
    {
        // Pure full match..
        $translation = $this->translations();
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Drop Lot number
        $translation = $this->translations();
        unset($translation['LOT_NUMBER']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }


        // Drop unit type.
        $translation = $this->translations();
        unset($translation['FLAT_TYPE']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Drop suburb
        $translation = $this->translations();
        unset($translation['LOCALITY_NAME']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Drop post code..
        $translation = $this->translations();
        unset($translation['POSTCODE']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Drop street type
        $translation = $this->translations();
        unset($translation['STREET_TYPE_CODE']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }


        // Drop lot and unit number
        $translation = $this->translations();
        unset($translation['LOT_NUMBER']);
        unset($translation['FLAT_TYPE']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Lot, unit, suburb
        $translation = $this->translations();
        unset($translation['LOT_NUMBER']);
        unset($translation['FLAT_TYPE']);
        unset($translation['LOCALITY_NAME']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }

        // Lot, unit, postcode
        $translation = $this->translations();
        unset($translation['LOT_NUMBER']);
        unset($translation['FLAT_TYPE']);
        unset($translation['POSTCODE']);
        $match = $this->performMatch($row,$translation);
        //if ($match) return true;
        if (!empty($match)) {
            return $match;
        }


        return false;
    }


    protected function performMatch($row,$translation)
    {
        $search = [];
        $match_up = array_flip($translation);
        foreach ($row as $key => $value)
        {
            if (isset($match_up[$key]) && $value) {
                $search[$match_up[$key]] = $value;
            }
        }

        if (count($search)) {

            $getGnafData = DB::table($this->table);

            foreach ($search as $key => $value)
            {
                $getGnafData->where($key, '=', $value);
            }

            $getGnafData->select('ADDRESS_DETAIL_PID', 'ADDRESS_DETAIL_NAME', 'FLAT_NUMBER', 'FLAT_TYPE', 'NUMBER_FIRST', 'NUMBER_LAST', 'STREET_TYPE_CODE', 'LOCALITY_NAME', 'POSTCODE', 'STREET_NAME', 'LOT_NUMBER', 'STATE_ABBREVIATION');
            $getGnafData = $getGnafData->limit('15')->get()->toArray();

            if (count($getGnafData) == 1) {
                //echo "\tSingle Match - {$getGnafData[0]->ADDRESS_DETAIL_NAME}\n";
                //return true;
                return array($getGnafData[0]->ADDRESS_DETAIL_PID, $getGnafData[0]->ADDRESS_DETAIL_NAME);
            }
        }
    }
}
