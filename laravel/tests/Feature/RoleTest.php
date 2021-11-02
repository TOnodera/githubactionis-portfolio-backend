<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    public function testロールの登録ができる()
    {
        $role = Role::create(['name'=>'管理者']);
        $this->assertDatabaseHas('roles', ['name'=>'管理者']);
    }
}
