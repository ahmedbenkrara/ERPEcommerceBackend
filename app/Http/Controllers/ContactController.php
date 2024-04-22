<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\HttpResponses;

class ContactController extends Controller
{
    use HttpResponses;

    public function sendMail(Request $request){
        $data = [
            'subject' => $request->subject,
            'from' => $request->email,
            'fullname' => $request->fullname,
            'message' => $request->message,
        ];

        Mail::to(env('MAIL_USERNAME'))->send(new ContactMail($data));
        return $this->success(null, 'Mail sent successfully !');
    }
}
