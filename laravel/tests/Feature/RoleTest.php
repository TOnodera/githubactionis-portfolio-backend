<?php

namespace Tests\Feature;

use App\Models\Action;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;
    
    public function testロールの登録ができる()
    {
        $role = Role::create(['name'=>'管理者']);
        $this->assertDatabaseHas('roles', ['name'=>'管理者']);
    }

    public function test管理者はロールにアクセス出来るが、一般ユーザーはアクセスできない()
    {
        
        //シード
        $this->seed();
        //管理者権限を持つユーザーを取得
        $adminUser = User::find(2);
        Auth::login($adminUser);
        $this->get('/api/roles')->assertOk();
        Auth::logout();

        //一般ユーザーはリダイレクトされる
        $normalUser = User::find(3);
        Auth::login($normalUser);
        $this->get('/api/roles')->assertForbidden();
        Auth::logout();
    }
    

    public function test管理者はロールの新規登録ができる()
    {
        //シード
        $this->seed();
        //管理者権限を持つユーザーを取得
        $adminUser = User::join('roles', function ($join) {
            $join->on('users.role_id', '=', 'roles.id');
        })->where('roles.name', '=', 'admin')->first();

        $this->actingAs($adminUser)->postJson('/api/roles', [
            'name'=>'testロール',
            'actions'=>Action::limit(5)->get()->pluck('id')->toArray()
        ])->assertOk();
    }
    public function testアクションが未選択の場合は登録出来ない()
    {
        $this->withoutExceptionHandling();
        //シード
        $this->seed();
        //管理者権限を持つユーザーを取得
        $adminUser = User::join('roles', function ($join) {
            $join->on('users.role_id', '=', 'roles.id');
        })->where('roles.name', '=', 'admin')->first();

        $this->expectException(ValidationException::class);
        $this->actingAs($adminUser)->postJson('/api/roles', [
            'name'=>'testロール',
            'actions'=>[]
        ]);
    }


    public function test一般ユーザーはロール管理にアクセスできない()
    {
        $this->seed();
        //管理者権限を持たないユーザーを取得
        $normalUser = User::join('roles', function ($join) {
            $join->on('users.role_id', '=', 'roles.id');
        })->where('roles.name', '=', 'normal')->first();

        $this->actingAs($normalUser)->postJson('/api/roles', [
            'name'=>'testロール',
            'actions'=>Action::limit(5)->get()->pluck('id')->toArray()
        ])->assertForbidden();
    }
}
