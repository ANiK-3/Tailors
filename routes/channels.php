<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::channel('tailors.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('customers.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
});
// Broadcast::channel('hire.user.{id}', function ($user, $id) {
//     return $user->id == $id;
// });

Broadcast::channel('chat', function () {
    //
});