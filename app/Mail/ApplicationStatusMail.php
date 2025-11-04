<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($applicant, $status)
    {
        // $applicant adalah objek MagangApplicants, $status adalah 'accepted' atau 'rejected'
        $this->applicant = $applicant;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = ($this->status === 'accepted')
            ? 'Pemberitahuan Status Magang: DITERIMA'
            : 'Pemberitahuan Status Magang: DITOLAK';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Memilih view Blade berdasarkan status
        $view = ($this->status === 'accepted')
            ? 'emails.application_accepted'
            : 'emails.application_rejected';

        return new Content(
            view: $view,
            with: [
                'name' => $this->applicant->nama_lengkap, // <--- PERBAIKAN DI SINI
                'status' => $this->status,
            ],
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
