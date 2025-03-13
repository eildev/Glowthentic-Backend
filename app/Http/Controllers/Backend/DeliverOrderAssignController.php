<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Validator;
use Yoeunes\Toastr\Facades\Toastr;

class DeliverOrderAssignController extends Controller
{

    public function assignDeliver(Request $request){
        // dd($request->all());
        try{
            $validator = Validator::make($request->all(), [

                 'order_id' => 'required',
                 'delivery_method' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $deliver_order_assign = new DeliveryOrder();
            $deliver_order_assign->order_id = $request->order_id;
            $deliver_order_assign->delivery_method = $request->delivery_method;
            $deliver_order_assign->courier_service = $request->courier_service;
            if($request->courier_service=="SteadFast"){

                $validator = Validator::make($request->all(), [

                    'invoice' => 'required',
                    'recipient_name' => 'required',
                    'recipient_phone' => 'required',
                    'cod_amount' => 'required',
                    'recipient_address' => 'required',

               ]);

               if ($validator->fails()) {
                   return response()->json(['errors' => $validator->errors()], 422);
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
            //   dump($response->json());

            //   dd($responseData);

            }
            $deliver_order_assign->assign_to = $request->assign_to;
            $order = Order::where('id', $request->order_id)->first();
            $order->status = "Delivering";
            $order->save();
            $deliver_order_assign->save();

            return response()->json([
                'status'=>200,

                'message'=>'Delivery Order Assign Successfully',
            ]);

        }
        catch(\Exception $e){
            return response()->json([
                'status'=>500,
                'message'=>$e->getMessage(),
            ]);
         }
    }

    public function shippingChangeTransit($id){
         $DeliveryOrder = DeliveryOrder::where('id', $id)->first();
         $DeliveryOrder->delivery_status = "In Transit";
         $DeliveryOrder->save();

         Toastr::success('Delivery Status Change To In Transit');
         return back();
    }

    public function TransitOrder(){
        $transit_orders = DeliveryOrder::where("delivery_status", 'In Transit')->with('order')->latest()->get();
        return view('backend.order.transit-order', compact('transit_orders'));
    }

    public function TransitChangeCompleted($id){
        $DeliveryOrder = DeliveryOrder::where('id', $id)->first();
        $DeliveryOrder->delivery_status = "delivered";
        $DeliveryOrder->save();
        Toastr::success('Delivery Status Change To Delivered');
        return back();
    }

    public function Delivered(){
        $delivered_orders = DeliveryOrder::where("delivery_status", 'delivered')->with('order')->latest()->get();
        return view('backend.order.delivered-order', compact('delivered_orders'));
    }
}
