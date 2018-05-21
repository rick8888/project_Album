<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\AbstractPaginator;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // defintion de la directive "admin"
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->role === 'admin';
        });
        
        // Prpagation de $categories à toutes les vues
        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            view ()->share ('categories', Category::all ());
        }
        
        // Definition de la directive "adminOrOwner"
        Blade::if('adminOrOwner', function ($id) {
        return auth()->check() && (auth()->id() === $id || auth()->user()->role === 'admin');
        });
        
        // Definition utilisation de Bootstrap 4 par paginate
        AbstractPaginator::defaultView("pagination::bootstrap-4");
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
