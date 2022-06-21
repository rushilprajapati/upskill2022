<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
  
class Employees extends Model
{
    use HasFactory;
  
    protected $fillable = [
        'firstname', 'lastname', 'company_id', 'email', 'phone'
    ];
    public function company() {
    	return $this->hasOne(Companies::class,'id','company_id');
    }
}