<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountProductController extends Controller
{
    public function index()
	{
		$config = Config::first();

		$discountProducts = Product::where('discount_percent', '>', 0)
			->where('discount_end', '>=', Carbon::now())
			->where('stock', '>', 0)
			->orderBy('id', 'desc')
			->paginate(24, ['id', 'name', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price']);


		$categories = Category::whereNull('parent_id')
			->with('children')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('client.products.discount_products')
			->with([
				'discountProducts' => $discountProducts,
				'categories' => $categories,
				'config' => $config,
			]);
	}

}
