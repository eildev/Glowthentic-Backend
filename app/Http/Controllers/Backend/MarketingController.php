<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index(){
        return view('backend.marketing.smssend');
    }
    public function sendSMS(Request $request){
        $number = $request->phonenumbers;
        $api_key = "0yRu5BkB8tK927YQBA8u";
        $senderid = "8809617615171";
        $message = $request->sms;
        $url = "http://bulksmsbd.net/api/smsapi";
        $data = [
            "api_key" => $api_key,
            'number' =>$number,
            'senderid' => $senderid,
            'message' => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
        if($response['response_code'] == 202){
            return back()->with('success', 'All Message has send');
        }  
        else{
            return back()->with('worning', 'Bad Request');
        //   return response()->json([
        //     'status' => 404,
        //     'message' => 'Bad Request',
        //     ]);
        }
    }

}
