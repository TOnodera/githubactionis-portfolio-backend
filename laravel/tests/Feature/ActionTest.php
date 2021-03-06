<?php

namespace Tests\Feature;

use App\Models\Action;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionTest extends TestCase
{
    use RefreshDatabase;
    
    public function testアクションの登録ができる()
    {
        $action = 'ユーザー情報の閲覧';
        Action::create(['name'=> $action,'action'=>'read:user']);

        $this->assertDatabaseHas('actions', ['name'=>$action,'action' => 'read:user']);
    }
}
