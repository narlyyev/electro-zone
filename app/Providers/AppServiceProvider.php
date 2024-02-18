<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		Paginator::useBootstrapFive();
		Model::preventLazyLoading(app()->isProduction());

		View::composer(['app.nav', 'client.layouts.app'], function ($view) {
			$categories = Category::whereNull('parent_id')
				->with(['products' => function ($query) {
					$query->where('stock', '>', 0);
				}])
				->orderBy('sort_order')
				->get();

			$cookieProducts = [];
			$cartProducts = [];

			if (Cookie::has('pr_c')) {
				if (Cookie::get('pr_c') != '') {
					$cookieProducts = explode(',', Cookie::get('pr_c'));
					$cookieProductsCount = array_count_values($cookieProducts);
					$cartProducts = array_keys($cookieProductsCount);
				}
			}
			$config = Config::first();
			$view->with([
				'config' => $config,
				'categories' => $categories,
				'cart' => count($cookieProducts),
				'cartPs' => $cartProducts,
			]);
		});
	}
}
