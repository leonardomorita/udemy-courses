<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = \App\Category::all(['name', 'slug']);

        // Utilizando o 'View Share'. Com essa forma, todas as views serão compartilhadas
        // view()->share('categories', $categories);

        // Utilizando o 'View Composer'. Com essa forma, terá que ser informado qual arquivo será compartilhado. Se utilizar '*', será selecionado todas as views
        // view()->composer('*', function($view) use($categories) {
        //     $view->with('categories', $categories);
        // });

        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
