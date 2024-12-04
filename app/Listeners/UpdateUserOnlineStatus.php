<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserOnlineStatus
{
    public function handle(object $event): void
    {
        $user = $event->user;
        $user->is_online = true;
        $user->save();
    }
}
