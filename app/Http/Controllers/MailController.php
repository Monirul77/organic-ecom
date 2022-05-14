<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function contact(){
        return view('pages.contact');
    }





    public function sendMail(Request $request){
        $details=[
            'name'=> $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
             
        ];
        Mail::to("monirul7377227@gmail.com")->send(new TestMail($details));
        return back()->with(" message_sent", "Your message has been sent successfully!");
    }

    
}
