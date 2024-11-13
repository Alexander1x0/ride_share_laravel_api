<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $email_verification_code;
    public function __construct($email_verification_code)
    {
        $this->email_verification_code = $email_verification_code;
    }

    public function build() {
        return $this->subject('Email Verification')
                            ->html('<p>Your verification code is: <strong>' . $this->email_verification_code . '</strong></p>');
    }

}
