<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function savePushNotificationToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendPushNotification()
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = 'AAAAjTr866o:APA91bF0VfNjECCv71_UYujiHcTByXq3sy3JdV4gsIkCpK6Q39vpQ11tW4cRLYL0xLp6iM5nYS4i0Teifa2CS8XOaGklHpxr3T2FWAxDRjMLkzLpJMtmbRAuBxtebjXZhK34knWN-d8j';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Success',
                "body" => 'The company has created successfully',  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);

        if (!empty($response)) {
            $response = json_decode($response);
            if (!empty($response->success)) {
                return json_encode(['message_id' => $response->multicast_id, 'success' => true]);
            } else {
                return json_encode(['error' => 'There is some issue with Firebase message', 'success' => false]);
            }
        } else {
            return json_encode(['error' => 'There is some issue with Firebase message', 'success' => false]);
        }
    }
}
