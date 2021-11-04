<?php

namespace App\Helper;

use Illuminate\Http\Request;

class GuardHelper
{
    public static function enableAction(string $actionName, Request $request): bool
    {
        $user = $request->user();
        $actions = $user->role->actions->pluck('action')->toArray();
        return in_array($actionName, $actions);
    }

    public static function disableAction(string $actionName, Request $request): bool
    {
        return !self::enableAction($actionName, $request);
    }
}
