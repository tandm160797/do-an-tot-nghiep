<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
    
class SCMailServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        require_once app_path() . '/Helpers/SCMail.php';
    }
}
