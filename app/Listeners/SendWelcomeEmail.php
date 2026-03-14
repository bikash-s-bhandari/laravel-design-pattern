<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        info('Sending welcome email to user: ' . $user->email);
        Mail::to($user)->send(new WelcomeEmail($user));
    }


}
