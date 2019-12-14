<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $client;

    /**
     * Create a new message instance.
     *
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Confirmacion de cuenta Genesis';
        $client = $this->client;
        return $this
            ->subject($subject)
            ->from(['address' => 'info@genesis.com', 'name' => 'Genesis'])
            ->view('emails.registration-request-email', compact('client'));
    }
}
