<?php

namespace Tests\Feature;

use App\Models\Action;
use App\Models\Role;
use Tests\TestCase;

class ActionRoleTest extends TestCase
{
    public function testロールにアクションを紐付け登録できる()
    {
        //アクション登録
        $action1 = Action::create([
            'name'=>'ユーザー情報の閲覧',
            'action' => 'read:user'
        ]);
        $action2 = Action::create([
            'name'=>'ユーザー情報の編集',
            'action' => 'edit:user'
        ]);

        //ロール登録
        $role = Role::create([
            'name'=>'管理者'
        ]);

        //ロールのアクションとして紐付け登録
        $role->actions()->sync([$action1->id,$action2->id]);

        foreach ($role->actions as $action) {
            $this->assertDatabaseHas('action_role', ['role_id'=>$role->id,'action_id'=>$action->id]);
        }
    }
}
