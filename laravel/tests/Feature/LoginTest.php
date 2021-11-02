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
        // $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'role_id' => $role->id,
            'email' => 'test@test.com',
            'password' => Hash::make($password)
        ]);
        $this->post('api/login', [
            'email' => $user->email,
            'password' => $password
        ])->assertRedirect('dashboard');
    }

    public function test未登録のユーザーはログインに失敗、loginページにリダイレクトされる()
    {
        $this->from('api/login')->post('api/login', [
            'email' => 'didnt-register@test.com',
            'password' => 'didnt-registered'
        ])->assertRedirect('api/login')->assertSessionHasErrors([
            'email' => '入力された認証情報ではログインできません。',
        ]);
    }
}
