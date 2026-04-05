<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $userId,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Vixlo Account Credentials',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.user-credentials',
        );
    }
}
