<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role'); // user_role == table name
    }
}
