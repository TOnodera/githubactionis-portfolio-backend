<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ActionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //管理者には全てのアクション実行権限を付与
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->actions()->sync(Action::all()->pluck('id')->toArray());

        //一般ユーザーはブログの編集のみ可能
        $nomalUserRole = Role::where('name', 'normal')->first();
        $actions = Action::whereRaw("action REGEXP '^(read|edit|create):(?!=user)$'")->get()->map(function ($action) {
            return $action->id;
        })->toArray();
        
        //紐付け登録
        $nomalUserRole->actions()->sync($actions);
    }
}
