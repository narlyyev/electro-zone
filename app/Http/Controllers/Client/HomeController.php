<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Config;
use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
	public function index()
	{
		$config = Config::first();

		$sliders = Slider::orderBy('id', 'desc')
			->get();

		$categories = Category::whereNull('parent_id')
			->with('children')
			->inRandomOrder()
			->get();

		$discountProducts = Product::where('discount_percent', '>', 0)
			->where('discount_end', '>=', Carbon::now())
			->where('stock', '>', 0)
			->inRandomOrder()
			->take(8)
			->get(['id', 'name', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price']);


		$recommendedProducts = Product::where('is_recommended', 1)
			->where('stock', '>', 0)
			->inRandomOrder()
			->take(8)
			->get(['id', 'name', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price']);

		$mostSoldProducts = Product::where('sold', '>', 5)
			->where('stock', '>', 0)
			->inRandomOrder()
			->take(8)
			->get(['id', 'name', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price']);

		$newProducts = Product::where('created_at', '<=', Carbon::now()->subMonths(2))
			->where('stock', '>', 0)
			->inRandomOrder()
			->take(8)
			->get(['id', 'name', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price']);

		$colProducts = Product::where('is_active', 1)
			->where('stock', '>', 0)
			->orderBy('id', 'desc')
			->take(5)
			->get(['id', 'name', 'description', 'description_ru', 'slug', 'stock', 'image', 'discount_percent', 'discount_start', 'discount_end', 'price', 'created_at']);

		$banners = Banner::orderBy('id', 'desc')
			->get();

		$news = News::with('category')
			->inRandomOrder()
			->get();

		$brands = Brand::inRandomOrder()
			->get();

		return view('client.home.index')
			->with([
				'sliders' => $sliders,
				'categories' => $categories,
				'discountProducts' => $discountProducts,
				'recommendedProducts' => $recommendedProducts,
				'mostSoldProducts' => $mostSoldProducts,
				'newProducts' => $newProducts,
				'colProducts' => $colProducts,
				'banners' => $banners,
				'news' => $news,
				'brands' => $brands,
				'config' => $config,
			]);
	}

	public function search(Request $request)
	{
		$request->validate([
			'q' => 'nullable|string|max:255',
		]);

		$q = $request->q ?: null;

		$products = Product::when($q, function ($query, $q) {
			return $query->where(function ($query) use ($q) {
				$query->orWhere('name', 'like', '%' . $q . '%');
				$query->orWhere('name_ru', 'like', '%' . $q . '%');
				$query->orWhere('slug', 'like', '%' . $q . '%');
				$query->orWhere('barcode', 'like', '%' . $q . '%');

				// Search in related models (category and brand)
				$query->orWhereHas('brand', function ($brandQuery) use ($q) {
					$brandQuery->where('name', 'like', '%' . $q . '%');
				});

				$query->orWhereHas('category', function ($categoryQuery) use ($q) {
					$categoryQuery->where('name', 'like', '%' . $q . '%')
						->orWhere('name_ru', 'like', '%' . $q . '%');
				});
			});
		})
			->inRandomOrder()
			->paginate(10);

		$products = $products->appends([
			'q' => $q,
		]);

		return response()->json([
			'products' => $products,
			'q' => $q,
			'status' => 1,
		], Response::HTTP_OK);
	}

	public function language($locale)
	{
		switch ($locale) {
			case 'tm':
				session()->put('locale', 'tm');
				return redirect()->back();
				break;
			case 'ru':
				session()->put('locale', 'ru');
				return redirect()->back();
				break;
			case 'en':
				session()->put('locale', 'en');
				return redirect()->back();
				break;
			default:
				return redirect()->back();
		}
	}
}
