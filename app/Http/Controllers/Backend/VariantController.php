<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function checkMail($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.order.mail-templete', compact('order'));
    }
}
