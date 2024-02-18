<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Product;
use App\Models\ProductView;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
	public function index(Request $request)
	{
		$request->validate([
			'q' => 'nullable|string|max:255',
			'ordering' => 'nullable|string|in:' . implode(',', array_keys(config()->get('settings.ordering'))),
		]);

		$q = $request->q ?: null;
		$f_order = $request->ordering;
		$ordering = $f_order ? config()->get('settings.ordering')[$f_order] : null;

		$config = Config::first();

		$products = Product::where('is_active', 1)
			->where('stock', '>', 0)
			->when($q, function ($query) use ($q) {
				$query->where(function ($query) use ($q) {
					$query->where('name', 'like', "%{$q}%")
						->orWhere('name_ru', 'like', "%{$q}%")
						->orWhere('slug', 'like', "%{$q}%")
						->orWhere('barcode', 'like', "%{$q}%")
						->orWhereHas('brand', function ($brandQuery) use ($q) {
							$brandQuery->where('name', 'like', "%{$q}%");
						})
						->orWhereHas('category', function ($categoryQuery) use ($q) {
							$categoryQuery->where('name', 'like', "%{$q}%")
								->orWhere('name_ru', 'like', "%{$q}%");
						});
				});
			})
			->when($ordering, function ($query) use ($ordering) {
				$query->orderBy($ordering[0], $ordering[1]);
			}, function ($query) {
				$query->inRandomOrder();
			})
			->paginate(24);

		$productsCount = Product::where('is_active', 1)
			->where('stock', '>', 0)
			->when($q, function ($query) use ($q) {
				$query->where(function ($query) use ($q) {
					$query->where('name', 'like', "%{$q}%")
						->orWhere('name_ru', 'like', "%{$q}%")
						->orWhere('slug', 'like', "%{$q}%")
						->orWhere('barcode', 'like', "%{$q}%")
						->orWhereHas('brand', function ($brandQuery) use ($q) {
							$brandQuery->where('name', 'like', "%{$q}%");
						})
						->orWhereHas('category', function ($categoryQuery) use ($q) {
							$categoryQuery->where('name', 'like', "%{$q}%")
								->orWhere('name_ru', 'like', "%{$q}%");
						});
				});
			})
			->count();

		return view('client.product.index')->with([
			'q' => $q,
			'products' => $products,
			'productsCount' => $productsCount,
			'f_order' => $f_order,
			'config' => $config,
		]);
	}

	public function show($slug)
	{
		$config = Config::first();

		$product = Product::where('slug', $slug)
			->firstOrFail();

		$colors = Product::where('group_code', $product->group_code)
			->with('color')
			->get(['id', 'slug', 'color_id', 'image']);

		if (Cookie::has('pr_v')) {
			$productIds = explode(',', Cookie::get('pr_v'));
			if (!in_array($product->id, $productIds)) {
				$product->increment('viewed');
				$productView = ProductView::firstOrCreate(['date' => Carbon::today()]);
				$productView->increment('viewed');
				$productIds[] = $product->id;
				Cookie::queue('pr_v', implode(',', $productIds), 60 * 8);
			}
		} else {
			$product->increment('viewed');
			$productView = ProductView::firstOrCreate(['date' => Carbon::today()]);
			$productView->increment('viewed');
			Cookie::queue('pr_v', $product->id, 60 * 8);
		}
		return view('client.product.show')
			->with([
				'product' => $product,
				'config' => $colors,
				'config' => $config,
				'colors' => $colors,
			]);
	}
}
