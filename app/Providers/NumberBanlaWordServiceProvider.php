<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\BanglaNumberToWord;
class NumberBanlaWordServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $BanglaNumberToWord = new BanglaNumberToWord();
            $view->with('BanglaNumberToWord', $BanglaNumberToWord);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
