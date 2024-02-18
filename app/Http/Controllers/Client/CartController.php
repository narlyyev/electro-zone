<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Location;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
	public function index()
	{
		$categories = Category::whereNulL('parent_id')
			->with('children')
			->get();

		$cookieProducts = [];
		$cookieProductsCount = [];
		$cartProducts = [];
		if (Cookie::has('pr_c')) {
			if (Cookie::get('pr_c') != '') {
				$cookieProducts = explode(',', Cookie::get('pr_c'));
				$cookieProductsCount = array_count_values($cookieProducts);
			}
		}

		if (count($cookieProductsCount) > 0) {
			$products = Product::whereIn('id', array_keys($cookieProductsCount))
				->where('stock', '>', 0)
//				->whereNotNull('image')
				->get(['id', 'name', 'slug', 'image', 'price', 'stock', 'discount_percent', 'discount_start', 'discount_end', 'created_at']);

			$cookieProducts = [];
			foreach ($products as $product) {
				if ($product->stock >= $cookieProductsCount[$product->id]) {
					$quantity = $cookieProductsCount[$product->id];
					$cartProducts[] = ['product' => $product, 'quantity' => $quantity, 'updated' => 0];
				} else {
					$quantity = $product->stock;
					$cartProducts[] = ['product' => $product, 'quantity' => $quantity, 1];
				}
				for ($i = 1; $i <= $quantity; $i++) {
					$cookieProducts[] = $product->id;
				}
			}
		}

		Cookie::queue('pr_c', implode(',', $cookieProducts), 60 * 24 * 14);

		$locations = Location::orderBy('sort_order')
			->orderBy('name')
			->get();

		$config = Config::first();

		$parentCategories = Category::whereNull('parent_id')
			->orderBy('id', 'desc')
			->with('children')
			->get();

		return view('client.cart.index')
			->with([
				'categories' => $categories,
				'cart' => count($cookieProducts),
				'products' => collect(array_reverse($cartProducts)),
				'locations' => $locations,
				'parentCategories' => $parentCategories,
				'config' => $config,
			]);
	}

	public function add(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$product = Product::where('id', $request->id)
			->where('is_active', 1)
			->where('stock', '>', 0)
//			->whereNotNull('image')
			->first(['id', 'stock']);
		if (!$product) {
			return response()->json([
				'status' => 0,
			], Response::HTTP_NOT_FOUND);
		}

		if (Cookie::has('pr_c')) {
			if (Cookie::get('pr_c') != '') {
				$cookieProducts = explode(',', Cookie::get('pr_c'));
				if (in_array($request->id, $cookieProducts)) {
					$cookieProductsCount = array_count_values($cookieProducts);
					if ($cookieProductsCount[$product->id] < $product->stock) {
						$cookieProductsCount[$product->id] += 1;
					} else {
						$cookieProductsCount[$product->id] = $product->stock;
					}
					$cookieProducts = [];
					foreach ($cookieProductsCount as $productId => $productQuantity) {
						for ($i = 1; $i <= $productQuantity; $i++) {
							$cookieProducts[] = $productId;
						}
					}
					$cookieProductsCount = array_count_values($cookieProducts);
					$quantity = $cookieProductsCount[$product->id];
				} else {
					$cookieProducts = array_merge($cookieProducts, [$request->id]);
					$quantity = 1;
				}
			} else {
				$cookieProducts = [$request->id];
				$quantity = 1;
			}
		} else {
			$cookieProducts = [$request->id];
			$quantity = 1;
		}
		Cookie::queue('pr_c', implode(',', $cookieProducts), 60 * 24 * 14);

		return response()->json([
			'status' => 1,
			'cart' => count($cookieProducts),
			'quantity' => $quantity,
		], Response::HTTP_OK);
	}


	public function remove(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$product = Product::where('id', $request->id)
			->where('is_active', 1)
			->where('stock', '>', 0)
//			->whereNotNull('image')
			->first(['id', 'stock']);
		if (!$product) {
			return response()->json([
				'status' => 0,
			], Response::HTTP_NOT_FOUND);
		}

		$cookieProducts = [];
		$quantity = 0;
		if (Cookie::has('pr_c')) {
			if (Cookie::get('pr_c') != '') {
				$cookieProducts = explode(',', Cookie::get('pr_c'));
				if (in_array($product->id, $cookieProducts)) {
					$cookieProductsCount = array_count_values($cookieProducts);
					if (array_key_exists($product->id, $cookieProductsCount)) {
						if ($cookieProductsCount[$product->id] - 1 >= 0) {
							$cookieProductsCount[$product->id] -= 1;
						}
						if ($cookieProductsCount[$product->id] > $product->stock) {
							$cookieProductsCount[$product->id] = $product->stock;
						}
						$cookieProducts = [];
						foreach ($cookieProductsCount as $productId => $productQuantity) {
							for ($i = 1; $i <= $productQuantity; $i++) {
								$cookieProducts[] = $productId;
							}
						}
						$cookieProductsCount = array_count_values($cookieProducts);
						if (array_key_exists($product->id, $cookieProductsCount)) {
							$quantity = $cookieProductsCount[$product->id];
						}
					}
				}
			}
		}
		Cookie::queue('pr_c', implode(',', $cookieProducts), 60 * 24 * 14);

		return response()->json([
			'status' => 1,
			'cart' => count($cookieProducts),
			'quantity' => $quantity,
		], Response::HTTP_OK);
	}


	public function clear()
	{
		Cookie::queue('pr_c', '', 60 * 24 * 14);

		return redirect()->back();
	}
}
