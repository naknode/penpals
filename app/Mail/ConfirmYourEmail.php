<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmYourEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user associated with the email.
     *
     * @var \App\User
     */
    public $user;

    /**
     * Create a new mailable instance.
     *
     * @param \App\User $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @codeCoverageIgnore
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.confirm-email');
    }
}
