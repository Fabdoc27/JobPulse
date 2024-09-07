<?php

namespace App\Providers;

use App\Models\Plugin;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();

        view()->composer('components.leftSidebar', function ($view) {
            $user = auth()->user();

            if ($user->role === 'company') {
                $plugins = $user->companyDetails->plugins()->where('status', 'active')->get();
            } else {
                $plugins = Plugin::all();
            }

            $view->with('plugins', $plugins);
        });
    }
}
