<?php

namespace App\Domain\Content;

use App\Domain\Validation\Role as ValidationRole;
use App\Models\Role as ModelsRole;
use Illuminate\Http\Request;

class Role
{
    private ValidationRole $validation;
    public function __construct()
    {
        $this->validation = new ValidationRole;
    }

    public function index(Request $request): string
    {
        $this->validation->indexValidation($request);
        return ModelsRole::all()->toJson();
    }
    
    public function create(Request $request): string
    {
        $this->validation->createValidation($request);
        $role = ModelsRole::create(['name'=>$request->name]);
        $role->actions()->sync($request->actions);
        return true;
    }
}
