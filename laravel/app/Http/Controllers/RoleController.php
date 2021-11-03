<?php

namespace App\Http\Controllers;

use App\Helper\GuardHelper;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index()
    {
        if (GuardHelper::disableAction('read-roles')) {
            return abort(403);
        }
        return ['roles'=>Role::all()];
    }

    public function create(Request $request)
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
        
        
        $role = Role::create(['name'=>$request->name]);
        $role->actions()->sync($request->actions);
        
        return ['created'=>true];
    }
}
