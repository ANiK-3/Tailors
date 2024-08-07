<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tailor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    public function tailorTypes()
    {
        return $this->belongsToMany(TailorType::class, 'tailor_with_type'); // tailor_with_type == pivot table
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


}
