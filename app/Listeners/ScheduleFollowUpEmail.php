<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegistered;
use App\Models\User;
use Carbon\Carbon;

class ScheduleFollowUpEmail
{
    public Carbon $delay;
    public User $user;

    public function __construct()
    {
        $this->delay = now()->addDays(3);
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        info('Scheduling follow-up email for user: ' . $user->email);
        // Mail::to($event->user)
        // ->later($this->delay, new FollowUpMail($event->user));
    }
}
