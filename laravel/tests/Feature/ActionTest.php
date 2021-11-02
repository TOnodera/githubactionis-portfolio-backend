<?php

namespace Tests\Feature;

use App\Models\Action;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ActionTest extends TestCase
{
    use RefreshDatabase;
    
    public function testアクションの登録ができる()
    {
        $action = 'ユーザー情報の閲覧';
        Action::create(['name'=> $action]);

        $this->assertDatabaseHas('actions', ['name'=>$action]);
    }
}
