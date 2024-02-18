<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function show(Request $request, $slug)
	{
		$request->validate([
			'f_brands' => 'nullable|array',
			'f_brands.*' => 'nullable|integer|min:0|distinct',
			'c' => 'nullable|array',
			'c.*' => 'nullable|integer|min:0|distinct',
			'v' => 'nullable|array',
			'v.*' => 'nullable|array',
			'v.*.*' => 'nullable|integer|min:0|distinct',
			'color' => 'nullable|array',
			'color.*' => 'nullable|integer|min:0|distinct',
			'ordering' => 'nullable|string|in:' . implode(',', array_keys(config()->get('settings.ordering'))),
		]);

		$f_brands = $request->has('b') ? $request->b : [];
		$f_categories = $request->has('c') ? $request->c : [];
		$f_colors = $request->has('color') ? $request->color : [];
		$f_values = $request->has('v') ? $request->v : [];
		$f_order = $request->ordering;
		$ordering = $f_order ? config()->get('settings.ordering')[$f_order] : null;

		$category = Category::where('slug', $slug)
			->with([
				'attributes' => function ($query) {
					$query->where('name', '!=', 'reňk');
				}
			])
			->firstOrFail();

		$ids = Category::where('branch', 'like', "%{$category->branch}%")->pluck('id');

		$products = Product::whereIn('category_id', $ids)
			->where('is_active', 1)
			->where('stock', '>', 0)
			->when($f_brands, function ($query, $f_brands) {
				$query->whereIn('brand_id', $f_brands);
			})
			->when($f_categories, function ($query, $f_categories) {
				$query->wherein('category_id', $f_categories);
			})
			->when($f_values, function ($query, $f_values) {
				return $query->where(function ($query) use ($f_values) {
					foreach ($f_values as $f_value) {
						$query->whereHas('attributeValues', function ($query) use ($f_value) {
							$query->whereIn('id', $f_value);
						});
					}
				});
			})
			->when($f_colors, function ($query, $f_colors) {
				$query->whereIn('color_id', $f_colors);
			})
			->when($ordering, function ($query, $ordering) {
				return $query->orderBy($ordering[0], $ordering[1]);
			})
			->get();

		$brands = Brand::orderBy('id', 'desc')
			->get();

		$distinctColors = Product::distinct('color_id')->pluck('color_id');

		$colors = AttributeValue::whereIn('id', $distinctColors)->get();

		$config = Config::first();

		return view('client.category.show')->with([
			'category' => $category,
			'products' => $products,
			'productsCount' => $products->where('stock', '>', 0)->count(),
			'brands' => $brands,
			'f_brands' => collect($f_brands),
			'f_categories' => collect($f_categories),
			'f_colors' => collect($f_colors),
			'f_values' => collect($f_values),
			'f_order' => $f_order,
			'config' => $colors,
			'config' => $config,
			'colors' => $colors,
		]);
	}
}
