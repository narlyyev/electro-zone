<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
		Gate::define('productsPanel', [UserPolicy::class, 'productsPanel']);
		Gate::define('ordersPanel', [UserPolicy::class, 'ordersPanel']);
		Gate::define('visitorsPanel', [UserPolicy::class, 'visitorsPanel']);
		Gate::define('adminPanel', [UserPolicy::class, 'adminPanel']);

		Gate::define('orders', [UserPolicy::class, 'orders']);
		Gate::define('contacts', [UserPolicy::class, 'contacts']);

		Gate::define('products', [UserPolicy::class, 'products']);
		Gate::define('categories', [UserPolicy::class, 'categories']);
		Gate::define('brands', [UserPolicy::class, 'brands']);
		Gate::define('attributes', [UserPolicy::class, 'attributes']);

		Gate::define('sliders', [UserPolicy::class, 'sliders']);

		Gate::define('locations', [UserPolicy::class, 'locations']);
		Gate::define('users', [UserPolicy::class, 'users']);

		Gate::define('ipAddresses', [UserPolicy::class, 'ipAddresses']);
		Gate::define('userAgents', [UserPolicy::class, 'userAgents']);
		Gate::define('authAttempts', [UserPolicy::class, 'authAttempts']);
		Gate::define('visitors', [UserPolicy::class, 'visitors']);
		Gate::define('attribute_values', [UserPolicy::class, 'attributeValues']);
		Gate::define('banners', [UserPolicy::class, 'banners']);

		Gate::define('news_categories', [UserPolicy::class, 'newsCategories']);
		Gate::define('news', [UserPolicy::class, 'news']);

		Gate::define('config', [UserPolicy::class, 'colors']);
	}
}
