<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Mail\reply;
class AllMail extends Controller
{
    public function replyMail(Request $request){
        $email = ContactUs::where('email',$request->mail)->first();
        $data = [
            'name' => $email->name,
            'message' => $request->message
        ];
        $email->read = 1;
        $email->update();
        Mail::to($email->email)->send(new reply($data));
        return back();
    }
}
