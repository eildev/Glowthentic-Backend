<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class CourierController extends Controller
{
    public function steadfast(){
        return view('backend.courier.steadfast');
    }

    public function steadfastSend(Request $request){
        $validator = Validator::make($request->all(), [

            'invoice' => 'required',
            'recipient_name' => 'required',
            'recipient_phone' => 'required',
            'cod_amount' => 'required',
            'recipient_address' => 'required',

       ]);

       if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
       }


       $endPoint ="https://portal.packzy.com/api/v1/create_order";

       $appKey="lgx16toeschl9fmulen1rwbdqfluhrin";
       $secretKey="kswetbgjpcuz7nwbqgj4vp8z";

       $invoice = $request->invoice;
       $recipient_name = $request->recipient_name;
       $recipient_phone = $request->recipient_phone;
       $cod_amount = $request->cod_amount;
       $recipient_address = $request->recipient_address;
       $note = $request->note;

       $header=[
        'Api-Key'=>$appKey,
        'Secret-Key'=>$secretKey,
          'Content-Type'=>'application/json'

       ];

       $data = [
        'invoice'=>$invoice,
        'recipient_name'=>$recipient_name,
        'recipient_phone'=>$recipient_phone,
        'cod_amount'=>$cod_amount,
        'recipient_address'=>$recipient_address,
        'note'=>$note,
       ];

      $response=Http::withHeaders($header)->post($endPoint,$data);
      return redirect()->back()->with('success','Order Successfully Send');
    //   dump($response->json());

    //   dd($responseData);

    }
    }

