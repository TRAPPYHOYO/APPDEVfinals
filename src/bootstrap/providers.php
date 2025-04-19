<?php
use Illuminate\Support\Facades\Schema;

class BootstrapServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
return [
    App\Providers\AppServiceProvider::class,
];
