<?php

namespace App\Providers;

use App\Models\Marketplace;
use App\Policies\MarketplacePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Marketplace::class => MarketplacePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
} 