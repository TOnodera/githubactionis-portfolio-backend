<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    protected $guarded = [];

    const RESOUCES = [
        'users'=>'ユーザー',
        'blogs'=>'ブログ',
        'roles'=>'ロール'
    ];
    
    const COMMANDS = [
        'read'=>'閲覧',
        'edit'=>'編集',
        'create'=>'作成'
    ];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
