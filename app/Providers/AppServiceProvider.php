<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;
use App\Models\User;

use Illuminate\Support\Facades\View;
use App\Models\Asset;

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
        View::composer('layouts.partials.navbar', function ($view) {
            $logo = Asset::where('asset_type', 'logo')->latest()->first();
            $view->with('logo', $logo);
        });

        View::composer('layouts.app', function ($view) {
            $background = Asset::where('asset_type', 'background')->latest()->first();
            $view->with('background', $background);
        });

        Paginator::useBootstrapFive();

        Gate::define('admin', function (User $user) {
            return $user->roles()->pluck('role')->contains('Admin');
        });
        Gate::define('customer', function (User $user) {
            return $user->roles()->pluck('role')->contains('Customer');
        });
        Gate::define('tailor', function (User $user) {
            return $user->roles()->pluck('role')->contains('Tailor');
        });
        Gate::define('isVerified', function (User $user) {
            return !is_null($user->email_verified_at);
        });

        Gate::define('view_profile', function (User $user, $user_id) {
            return $user->id === $user_id;
        });
        Gate::define('view_measurements', function (User $user, $user_id) {
            return $user->id === $user_id;
        });
    }
}
