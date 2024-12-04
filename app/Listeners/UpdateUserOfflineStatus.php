<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;

class UpdateUserOfflineStatus
{
    public function handle($event)
    {
        $user = $event->user;
        $user->is_online = false;
        $user->save();
    }
}
