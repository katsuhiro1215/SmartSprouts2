<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogUserLogin
{
    public function __construct()
    {
        //
    }

    public function handle(Login $event)
    {
        $user = $event->user;
        $user->login_at = now();
        $user->save();
    }
}
