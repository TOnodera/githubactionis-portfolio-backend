<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //初期ユーザーとして管理者、一般ユーザーを１アカウントずつ作成しておく
        //　管理者ユーザー
        User::create([
            'role_id' => Role::where('name', 'admin')->first()->id,
            'name' => '太郎',
            'email' => 'taro@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password1'), // password
            'remember_token' => Str::random(10),
        ]);
        //　一般ユーザー
        User::create([
            'role_id' => Role::where('name', 'normal')->first()->id,
            'name' => '次郎',
            'email' => 'jiro@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password2'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
