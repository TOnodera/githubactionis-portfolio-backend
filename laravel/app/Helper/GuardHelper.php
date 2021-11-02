<?php

namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GuardHelper
{
    public static function enableAction(string $actionName, User $user = null): bool
    {
        $user = $user ?: Auth::user();
        $actions = $user->role->actions->pluck('action')->toArray();
        return in_array($actionName, $actions);
    }

    public static function disableAction(string $actionName, User $user = null): bool
    {
        return !self::enableAction($actionName, $user);
    }
}
