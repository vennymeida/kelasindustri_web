<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPelamar extends Mailable
{
    use Queueable, SerializesModels;
    public $dataOkeOke;
    /**
     * Create a new messaZZZZZZZZZZge instance.
     *
     * @return void
     */
    public function __construct($dataOkeOke)
    {
        $this->dataOkeOke = $dataOkeOke;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Perusahaan')
            ->html($this->dataOkeOke['body']);
    }
}
