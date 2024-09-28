<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReply extends Mailable
{
    use Queueable, SerializesModels;

    public $contactName;
    public $messageBody;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactName, $messageBody)
    {
        $this->contactName = $contactName;
        $this->messageBody = $messageBody;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Thank you for contacting us')
                    ->view('emails.contact_reply')
                    ->with([
                        'contactName' => $this->contactName,
                        'messageBody' => $this->messageBody,
                    ]);
    }
}