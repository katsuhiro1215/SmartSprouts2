<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogUserLogout
{
    public function __construct()
    {
        //
    }

    public function handle(Logout $event)
    {
        $user = $event->user;
        $user->logout_at = now();
        $user->save();
    }
}
