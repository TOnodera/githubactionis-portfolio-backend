<?php

namespace App\Domain\Validation;

use App\Helper\GuardHelper;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Role
{
    public function indexValidation(Request $request)
    {
        if (GuardHelper::disableAction('read-roles')) {
            return abort(403);
        }
    }
    public function createValidation(Request $request)
    {
        if (GuardHelper::disableAction('create-roles')) {
            return abort(403);
        }

        $request->validate([
            'name' => ['required','max:100'],
        ]);

        if (count($request->actions)<=0) {
            throw ValidationException::withMessages(['actions'=>'アクションを選択して下さい。']);
        }
    }
}
