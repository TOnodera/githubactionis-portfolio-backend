<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];
    const ROLES = ['admin','normal'];


    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }
}
