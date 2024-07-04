<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role'); // user_role == pivot table
    }

    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }
}
