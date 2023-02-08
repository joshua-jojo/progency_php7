<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Agen;
use App\Models\Developer;
use App\Models\Perumahan;
use App\Models\User;
use App\Policies\AgenPolicy;
use App\Policies\BookingPolicy;
use App\Policies\DaftarPerumahanPolicy;
use App\Policies\DeveloperPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Agen::class => AgenPolicy::class,
        User::class => UserPolicy::class,
        Developer::class => DeveloperPolicy::class,
        Perumahan::class => DaftarPerumahanPolicy::class,
        Booking::class => BookingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
