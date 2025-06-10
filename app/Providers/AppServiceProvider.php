<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MsPegawai;
use App\Policies\PermissionPolicy;
use Illuminate\Support\Facades\Gate;


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
        \Illuminate\Support\Facades\Auth::shouldUse('pegawai');
        Gate::policy(MsPegawai::class, PermissionPolicy::class);
    }
}
