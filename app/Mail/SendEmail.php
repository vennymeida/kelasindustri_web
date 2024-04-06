<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $dataOke;
    /**
     * Create a new messaZZZZZZZZZZge instance.
     *
     * @return void
     */
    public function __construct($dataOke)
    {
        $this->dataOke = $dataOke;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Perusahaan')
            ->html($this->dataOke['body']);
    }
}
