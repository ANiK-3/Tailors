<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->roles()->pluck('role')->contains('Admin');
        });
        Gate::define('customer', function (User $user) {
            return $user->roles()->pluck('role')->contains('Customer');
        });
        Gate::define('tailor', function (User $user) {
            return $user->roles()->pluck('role')->contains('Tailor');
        });
        Gate::define('view_profile', function (User $user, $user_id) {
            return $user->id === $user_id;
        });


    }
}
