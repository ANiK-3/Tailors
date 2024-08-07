<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Accessors & Mutators
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
