<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseMail;
use Illuminate\Http\Request;

class PurchaseMailController extends Controller
{
    public function purchas() {

        // データベースより値を取得
        $title = 'テストイベント';
        $subtitle = 'この度は、『'.$title.'にお申し込みいただきありがとうございます。』';
        $comment = 'とてもうれしく思います。
        
        また、詳細等は改めて送らせていただきますので、そちらをご確認くださいませ。
        
        改めて再度お申し込み内容となります。';

        Mail::send(new PurchaseMail($title, $subtitle, $comment));
    }
}
