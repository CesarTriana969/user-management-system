<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class InstanceInterfaceAppProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // --BEGIN ACTION BINDINGS--

        $this->app->bind(\App\Actions\Panel\User\interfaces\UserInterface::class, \App\Actions\Panel\User\UserAction::class);

        $this->app->bind(\App\Actions\Panel\Role\Interfaces\RoleInterface::class, \App\Actions\Panel\Role\RoleAction::class);

// --END ACTION BINDINGS--
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
