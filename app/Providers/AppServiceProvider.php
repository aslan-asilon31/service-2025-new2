<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\RoleAksesStatus;
use App\Models\TrTandaTerimaServiceHeader;
use App\Policies\RoleAksesStatusPolicy;
use App\Policies\TrTandaTerimaServiceHeaderPolicy;
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
        Gate::policy(RoleAksesStatus::class, RoleAksesStatusPolicy::class);
        Gate::define(TrTandaTerimaServiceHeader::class, TrTandaTerimaServiceHeaderPolicy::class);
    }
}
