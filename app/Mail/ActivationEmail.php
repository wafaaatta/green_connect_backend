<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $activationCode;
    public $activationLink;

    public function __construct(User $user, $activationLink)
    {
        $this->user = $user;
        $this->activationLink = $activationLink;
    }

    public function build()
    {
        return $this->view('emails.activation')
                    ->subject('Activate Your Account')
                    ->with([
                        'user' => $this->user,
                        'activationLink' => $this->activationLink
                    ]);
    }
}