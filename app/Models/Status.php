<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
    public function orders()
    {
        return $this->has(Order::class);
    }
}
