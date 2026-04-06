<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $token,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            // set the subject of the email
            subject: 'Vixlo Password Reset',
        );
    }

    public function content(): Content
    {
        return new Content(
            // set the view of the email
            view: 'emails.forgot-password',
        );
    }
}
