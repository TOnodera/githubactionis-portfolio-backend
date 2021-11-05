<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    
    public function test登録済みユーザはログイン出来る()
    {
        $role = Role::create(['name'=>'test']);
        $password = 'abcd1234';
        $user = User::factory()->create([
            'role_id' => $role->id,
            'email' => 'test@test.com',
            'password' => Hash::make($password)
        ]);
        $this->post('api/login', [
            'email' => $user->email,
            'password' => $password
        ])->assertOk();
    }

    public function test未登録のユーザーはログインに失敗、loginページにリダイレクトされる()
    {
        $this->post('api/login', [
            'email' => 'didnt-register@test.com',
            'password' => 'didnt-registered'
        ])->assertStatus(401);
    }

    public function testルートisLoginでログインチェックできる()
    {
        // $this->withoutExceptionHandling();
        $role = Role::create(['name'=>'test']);
        $password = 'abcd1234';
        $user = User::factory()->create([
            'role_id' => $role->id,
            'email' => 'test@test.com',
            'password' => Hash::make($password)
        ]);
        Auth::login($user);
        $this->postJson('api/login', [
            'email'=>'test@test.com',
            'password'=>$password
        ])->assertOk();
        Auth::logout();
    }
}
