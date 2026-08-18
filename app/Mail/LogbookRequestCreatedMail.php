<?php

namespace App\Mail;

use App\Models\LogbookRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LogbookRequestCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public LogbookRequest $logbookRequest)
    {
        $this->logbookRequest = $logbookRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Logbook Transfer Request: ' . $this->logbookRequest->chasisNumber,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.logbook-request-created',
        );
    }
}