<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Habit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
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

        Model::shouldBeStrict(! $this->app->isProduction());
        Model::unguard();

        //Can't make this work on my local test environment - breaks CSS even when I force the asset to load  with {{asset('css/home.css',true)}}
        if($this->app->isProduction()){
            URL::forceScheme('https');
        }

        DB::prohibitDestructiveCommands($this->app->isProduction());

        Gate::define('edit-habit', function(User $user, Habit $habit){
            return $habit->user->is($user);
        });
    }
}
