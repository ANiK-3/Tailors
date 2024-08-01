<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TailorType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function tailors()
    {
        return $this->belongsToMany(Tailor::class, 'tailor_with_type'); // tailor_with_type == pivot table
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
