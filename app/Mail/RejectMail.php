<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $comment)
    {
        $this->email = $email;
        $this->password = $password;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
        $this->markdown('email.rejectemail', [
            'email' => $this->email,
            'password' => $this->password,
            'comment' => $this->comment,
        ]);
    }
}
