<?php

namespace App\Providers;

use App\Models\Brands\Brand;
use App\Models\User;
use App\Policies\BrandPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//         'App\Models\Brand' => 'App\Policies\BrandPolicy',
        Brand::class => BrandPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('Read Brand',[BrandPolicy::class,'view']);
        Gate::define('Create Brand',[BrandPolicy::class,'create']);
        Gate::define('Update Brand',[BrandPolicy::class,'update']);
        Gate::define('Delete Brand',[BrandPolicy::class,'delete']);
        Gate::define('Restore Brand',[BrandPolicy::class,'restore']);

        Gate::define('Read Product',[ProductPolicy::class,'view']);
        Gate::define('Create Product',[ProductPolicy::class,'create']);
        Gate::define('Update Product',[ProductPolicy::class,'update']);
        Gate::define('Delete Product',[ProductPolicy::class,'delete']);
        Gate::define('Restore Product',[ProductPolicy::class,'restore']);
   }
}
