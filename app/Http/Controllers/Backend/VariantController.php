<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function checkMail()
    {
        return view('backend.order.mail-templete');
    }
}
