<?php

namespace App\Listeners\Auth\RegisterEventListeners;

use App\Events\Auth\RegisterEvent;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendVerificationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        $token = $event->getUser()->generateEmailVerifyToken();
        $redirect = trim(config('mail.verification-mails.redirect'), '/') . '/' . $event->getUser()->id . '?token=' . $token;
        Mail::to($event->getUser()->email)->send(new \App\Mail\Auth\VerifyMail($redirect, $event->getUser()));

    }
}
