<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RescueMailNotifier extends Mailable
{
    use Queueable, SerializesModels;

    private array $recipients;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->cc([])
            ->bcc(['yaramayservices@gmail.com'])
            ->to($this->recipients)->subject('Tabang System')->markdown('emails.rescue-mail');
    }
}
