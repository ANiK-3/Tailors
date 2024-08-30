<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Tailor;
use App\Models\Fabric;


class Request extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function tailor()
    {
        return $this->belongsTo(Tailor::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function fabrics()
    {
        return $this->hasMany(Fabric::class);
    }

    public static function canSendHireRequest($customerId, $tailorId)
    {
        $lastRequest = self::where('customer_id', $customerId)
            ->where('tailor_id', $tailorId)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastRequest) {
            return true;
        }

        $timeSinceLastRequest = Carbon::parse($lastRequest->created_at)->diffInMinutes(Carbon::now());

        return $timeSinceLastRequest >= 30;
    }

}
