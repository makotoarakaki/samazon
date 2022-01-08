<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $subtitle, $comment)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = Auth::user()->email;
        $name = Auth::user()->name;

        $from = config('app.from_mail'); // config.app.phpで定義した値を取得
        $from_name = config('app.from_name'); // config.app.phpで定義した値を取得
        return $this->to($email)
                    ->from($from, $from_name)
                    ->view('emails.purchase')
                    ->with(
                        [
                            'name' => $name, 
                            'title' => $this->title, 
                            'subtitle' => $this->subtitle, 
                            'comment' => $this->comment, 
                        ]
                    )
                    ->subject($this->title.'のお申し込みありがとうございます。');
    }
}
