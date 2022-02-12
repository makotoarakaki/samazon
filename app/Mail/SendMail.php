<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $title, $comment)
    {
        $this->email = $email;
        $this->name = $name;
        $this->title = $title;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = config('app.from_mail'); // config.app.phpで定義した値を取得
        $from_name = config('app.from_name'); // config.app.phpで定義した値を取得

        return $this->to($this->email)
                    ->from($from, $from_name)
                    ->view('emails.sendmail')
                    ->with(
                        [
                            'name' => $this->name,
                            'comment' => $this->comment
                        ]
                    )
                    ->subject($this->title);
    }
}
