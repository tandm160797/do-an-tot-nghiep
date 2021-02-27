<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SCRoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        require_once app_path() . '/Helpers/SCRole.php';
    }
}
