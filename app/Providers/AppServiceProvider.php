<?php

namespace App\Providers;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $sekolah = Sekolah::first();
        View::share('sekolah', $sekolah);

        Gate::define('admin', function(User $user){
          return $user->isAdmin();
        });

        Gate::define('staf', function(User $user){
          return $user->isStaf();
        });

        Gate::define('kapus', function(User $user){
          return $user->isKapus();
        });

        Gate::define('admindankapus', function(User $user){
          return $user->isAdmin() || $user->isKapus();
        });


    }
}
