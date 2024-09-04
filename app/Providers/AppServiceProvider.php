<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
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
        Gate::define('check-admin', function(User $user){
            return $user->name === 'admin';
        });

        Gate::define('check-subscription', function(User $user, $categoryID){
            if ($user->categories()->where('category_id', $categoryID)->exists()){
                return true;
            } else {
                return false;
            }
        });

        Blade::if('isSubscribed', function($categoryID){
            if (Auth::user()){
                $user = Auth::user();
                if ($user->categories()->where('category_id', $categoryID)->exists()){
                    return true;
                } else {
                    return false;
                }
            }
            
        });

        Blade::if('commentAuthor', function($commentUserID){
            if (Auth::user()->id == $commentUserID){
                return true;
            }
        });


    }

}
