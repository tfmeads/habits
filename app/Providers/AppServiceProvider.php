<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Habit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Whitecube\LaravelTimezones\Facades\Timezone;

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
        Timezone::set('America/Los_Angeles'); //TODO set this dynamically when user logs in


        Gate::define('edit-habit', function(User $user, Habit $habit){
            return $habit->user->is($user);
        });
    }
}
