<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\DeliveryOrder;
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
            'recipient_address' => 'required|min:50',

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


     public function All(){
        $steadfastData =DeliveryOrder::where('courier_service','SteadFast')->get();

        foreach ($steadfastData as $SteadFast) {

            if ($SteadFast->tracking_number) {
                $endPoint = "https://portal.packzy.com/api/v1/status_by_trackingcode/{$SteadFast->tracking_number}";

                $appKey = "lgx16toeschl9fmulen1rwbdqfluhrin";
                $secretKey = "kswetbgjpcuz7nwbqgj4vp8z";

                $header = [
                    'Api-Key' => $appKey,
                    'Secret-Key' => $secretKey,
                    'Content-Type' => 'application/json'
                ];


                $response = Http::withHeaders($header)->get($endPoint);

                $responseData=$response->json();

                 if($responseData['status'] == 200){
                    $steadfastStatus=DeliveryOrder::find($SteadFast->id);
                    $steadfastStatus->status = $responseData['delivery_status'];
                    $steadfastStatus->save();
                 }

            }
        }

        $SteadfastStatus=DeliveryOrder::where('courier_service','SteadFast')->with('order')->get();

        $pendingStatus=DeliveryOrder::where('status','pending')->with('order')->get();
        $ApprovelStatus=DeliveryOrder::where('status','approval')->with('order')->get();
        $cancelStatus=DeliveryOrder::where('status','cancelled')->with('order')->get();
        $deliveredStatus=DeliveryOrder::where('status','delivered')->with('order')->get();
        return view('backend.CourierManage.all',compact('SteadfastStatus','pendingStatus','ApprovelStatus','cancelStatus','deliveredStatus'));
     }

    }

