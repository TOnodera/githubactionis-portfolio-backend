<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run()
    {
        foreach (Action::COMMANDS as $command=>$commandName) {
            foreach (Action::RESOUCES as $resouce=>$resouceName) {
                Action::create([
                    'name'=>"{$resouceName}{$commandName}",
                    'action'=>"{$command}-{$resouce}"
                ]);
            }
        }
    }
}
