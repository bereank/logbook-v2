<?php

namespace App\Mail;

use App\Models\LogbookRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LogbookRequestPendingAcceptanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public LogbookRequest $logbookRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Logbook Transfer Pending Acceptance: '.$this->logbookRequest->chasisNumber,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.logbook-request-pending-acceptance',
        );
    }
}