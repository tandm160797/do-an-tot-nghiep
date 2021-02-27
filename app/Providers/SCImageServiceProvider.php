<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SCImageServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        require_once app_path() . '/Helpers/SCImage.php';
    }
}
