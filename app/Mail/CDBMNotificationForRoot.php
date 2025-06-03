<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CDBMNotificationForRoot extends Mailable
{
    use Queueable, SerializesModels;
     public $print;
    /**
     * Create a new message instance.
     */
    public function __construct($print)
    {
        $this->print = $print;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Core Doctor Business Monitoring Notification - ' .$this->print[0]->DoctorBusinessMonitoring->GrantApproval->Manager->ZonalManager->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'doctor_business_monitorings.email_for_root',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
