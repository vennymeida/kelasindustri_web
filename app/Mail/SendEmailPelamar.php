<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailPelamar extends Mailable
{
    use Queueable, SerializesModels;
    public $dataOkeOke;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataOkeOke)
    {
        $this->dataOkeOke = $dataOkeOke;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        return $this->subject('Perusahaan')
            ->html($this->dataOkeOke['body']);
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Send Email Pelamar',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
