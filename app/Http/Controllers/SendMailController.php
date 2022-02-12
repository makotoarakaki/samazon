<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendMailController extends Controller
{
    public function send($email, $name, $title, $comment) {

        Mail::send(new SendMail($email, $name, $title, $comment));
    }
}
