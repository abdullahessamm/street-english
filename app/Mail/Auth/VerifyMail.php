<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $redirect;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $redirect, $user)
    {
        $this->redirect = $redirect;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.verify-mail')
            ->with('redirect', $this->redirect)
            ->with('user', $this->user);
    }
}
