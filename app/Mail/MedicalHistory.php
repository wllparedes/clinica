<?php

namespace App\Mail;

use App\Models\MedicalHistory as ModelsMedicalHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MedicalHistory extends Mailable
{
    use Queueable, SerializesModels;

    public ModelsMedicalHistory $medicalHistory;

    /**
     * Create a new message instance.
     */
    public function __construct(ModelsMedicalHistory $medicalHistory)
    {
        $this->medicalHistory = $medicalHistory;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Medical History',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.medical-history',
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
