<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:products');
	}

	public function index(Request $request)
	{
		$request->validate([
			'category' => 'nullable|integer|min:0',
			'categories.*' => 'nullable|integer|min:1',
			'brand' => 'nullable|integer|min:0',
			'brands.*' => 'nullable|integer|min:1',
		]);


		$brands = Brand::orderBy('name')
			->get();
		$f_category = $request->category ?: null;
		$f_brand = $request->brand ?: null;
		$f_hasDiscount = $request->has('hasDiscount') ? $request->hasDiscount : null;
		$f_hasStock = $request->has('hasStock') ? $request->hasStock : null;

		return view('admin.products.index')
			->with([
				'f_category' => $f_category,
				'f_brand' => $f_brand,
				'f_hasDiscount' => $f_hasDiscount,
				'f_hasStock' => $f_hasStock,
				'brands' => $brands,
			]);
	}

	public function create()
	{
		$categories = Category::doesntHave('children')
			->with('parent')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		$distinctColors = Product::distinct('color_id')->pluck('color_id');

		$colors = AttributeValue::whereIn('id', $distinctColors)->get();

		$brands = Brand::orderBy('name')
			->get();


		return view('admin.products.create')
			->with([
				'categories' => $categories,
				'brands' => $brands,
				'colors' => $colors,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'category_id' => 'required|exists:categories,id',
			'brand_id' => 'required|exists:brands,id',
			'color_id' => 'required',
			'group_code' => 'required|string|max:10',
			'name' => 'required|string|max:255|unique:products,name',
			'name_ru' => 'nullable|string|max:255|unique:products,name_ru',
			'name_en' => 'nullable|string|max:255|unique:products,name_en',
			'description' => 'required|string',
			'description_ru' => 'nullable|string',
			'description_en' => 'nullable|string',
			'barcode' => 'nullable|string|max:255|unique:products,barcode',
			'price' => 'required|numeric|min:0',
			'stock' => 'required|integer|min:0',
			'image' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
			'is_active' => 'nullable|boolean',
			'is_recommended' => 'nullable|boolean',
		]);

		$product = Product::create([
			'category_id' => $request->category_id,
			'brand_id' => $request->brand_id,
			'color_id' => $request->color_id,
			'group_code' => $request->group_code,
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'description' => $request->description,
			'description_ru' => $request->description_ru,
			'description_en' => $request->description_en,
			'barcode' => $request->barcode,
			'price' => round($request->price, 1),
			'stock' => $request->stock,
			'is_active' => $request->has('is_active') ? 1 : 0,
			'is_recommended' => $request->has('is_recommended') ? 1 : 0,
		]);

		if ($request->has('image')) {
			// generate name
			$name = str()->random(15) . '.jpg';
			// save normal
			Storage::putFileAs('public/products', $request->image, $name);
			// save small

			$imageSm = Image::make($request->image);
			$imageSm->resize(200, 261, function ($constraint) {
				$constraint->aspectRatio();
			});
			$imageSm = (string)$imageSm->encode('jpg', 90);
			Storage::put('public/products/sm/' . $name, $imageSm);
			// update obj
			$product->image = $name;
			$product->update();
		}

		return to_route('admin.products.index')
			->with([
				'success' => 'Product' . ' ' . 'added' . '!',
			]);
	}

	public function edit(Request $request, $id)
	{
		$product = Product::with('category', 'brand', 'attributeValues')
			->findOrFail($id);

		$categories = Category::with('attributes')
			->doesntHave('children')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		$distinctColors = Product::distinct('color_id')->pluck('color_id');

		$colors = AttributeValue::whereIn('id', $distinctColors)->get();

		$brands = Brand::orderBy('slug')
			->get();

		$attributes = Attribute::with('attributeValues')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('admin.products.edit')
			->with([
				'product' => $product,
				'categories' => $categories,
				'brands' => $brands,
				'attributes' => $attributes,
				'colors' => $colors,
			]);
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'nullable|string|max:255',
			'name_ru' => 'nullable|string|max:255',
			'name_en' => 'nullable|string|max:255',
			'color_id' => 'required',
			'group_code' => 'nullable|string|max:10',
			'description' => 'nullable|string',
			'description_ru' => 'nullable|string',
			'description_en' => 'nullable|string',
			'barcode' => 'nullable|string|max:255|unique:products,barcode,' . $id,
			'price' => 'nullable|numeric',
			'stock' => 'nullable|integer',
			'discount_percent' => 'nullable|numeric|between:0,100',
			'discount_start' => 'nullable|date',
			'discount_end' => 'nullable|date',
			'image' => 'nullable|image',
			'is_active' => 'nullable|boolean',
			'is_recommended' => 'nullable|boolean',
			'attribute_values' => 'nullable|array',
			'attribute_values.*' => 'nullable|integer|min:0',
		]);

		$attributeValues = $request->has('attribute_values')
			? array_values(array_filter($request->attribute_values, function ($i) {
				return ($i != 0);
			}))
			: [];

		$product = Product::findOrFail($id);
		$product->category_id = $request->category_id;
		$product->brand_id = $request->brand_id;
		$product->color_id = $request->color_id;
		$product->group_code = $request->group_code;
		$product->name = $request->name;
		$product->name_ru = $request->name_ru;
		$product->name_en = $request->name_en;
		$product->description = $request->description;
		$product->description_ru = $request->description_ru;
		$product->description_en = $request->description_en;
		$product->barcode = $request->barcode;
		$product->price = round($request->price, 1);
		$product->stock = $request->stock;
		$product->discount_percent = $request->discount_percent;
		$product->discount_start = Carbon::parse($request->discount_start);
		$product->discount_end = Carbon::parse($request->discount_end);
		$product->is_active = $request->has('is_active') ? 1 : 0;
		$product->is_recommended = $request->has('is_recommended') ? 1 : 0;
		$product->update();
		if ($request->has('image')) {
			if ($product->image) {
				Storage::delete('public/products/' . $product->image);
				Storage::delete('public/products/sm/' . $product->image);
			}
			// generate name
			$name = str()->random(15) . '.jpg';
			// save normal
			Storage::putFileAs('public/products', $request->image, $name);
			// save small
			$imageSm = Image::make($request->image);
			$imageSm->resize(200, 261, function ($constraint) {
				$constraint->aspectRatio();
			});
			$imageSm = (string)$imageSm->encode('jpg', 90);
			Storage::put('public/products/sm/' . $name, $imageSm);
			// update obj
			$product->image = $name;
			$product->update();
		}

		$product->attributeValues()->sync($attributeValues);

		return to_route('admin.products.index')
			->with([
				'success' => 'Product' . ' ' . 'updated' . '!',
			]);
	}

	public function destroy($id)
	{
		$product = Product::withCount('orderProducts')
			->findOrFail($id);
		if ($product->order_products_count > 0) {
			return redirect()->back()
				->with([
					'error' => 'Error! ' . 'Count of ordered products: ' . $product->order_products_count,
				]);
		}
		if ($product->image) {
			Storage::delete('public/products/' . $product->image);
			Storage::delete('public/products/sm/' . $product->image);
		}
		$product->delete();

		return to_route('admin.products.index')
			->with([
				'Product deleted!'
			]);
	}

	public function active(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$product = Product::findOrFail($request->id);
		$product->is_active = $product->is_active ? 0 : 1;
		$product->save();

		return response()->json([
			'status' => '1',
			'is_active' => $product->is_active,
		], Response::HTTP_OK);
	}


	public function recommended(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$product = Product::findOrFail($request->id);
		$product->is_recommended = $product->is_recommended ? 0 : 1;
		$product->save();

		return response()->json([
			'status' => 1,
			'is_recommended' => $product->is_recommended,
		]);
	}

	public function up(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$product = Product::findOrFail($request->id);
		$product->stock += 1;
		$product->update();

		return response()->json([
			'status' => '1',
			'stock' => $product->stock,
		], Response::HTTP_OK);
	}


	public function down(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$product = Product::findOrFail($request->id);
		if ($product->stock > 0) {
			$product->stock -= 1;
		}
		$product->update();

		return response()->json([
			'status' => '1',
			'stock' => $product->stock,
		], Response::HTTP_OK);
	}

	public function api(Request $request)
	{
		$request->validate([
			'category' => 'nullable|integer|min:0',
			'brand' => 'nullable|integer|min:0',
		]);

		$f_category = $request->category ?: null;
		$f_brand = $request->brand ?: null;
		$f_hasDiscount = $request->has('hasDiscount') ? $request->hasDiscount : null;
		$f_hasStock = $request->has('hasStock') ? $request->hasStock : null;

		$columns = array(
			0 => 'id',
			1 => 'image',
			2 => 'attributes',
			3 => 'name',
			4 => 'barcode',
			5 => 'price',
			6 => 'stock',
			7 => 'is_active',
			8 => 'is_recommended',
			9 => 'sold',
			10 => 'viewed',
		);

		$totalData = Product::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (!$request->input('search.value')) {
			$rs = Product::filterQuery($f_category, $f_brand, $f_hasDiscount, $f_hasStock)
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Product::filterQuery($f_category, $f_brand, $f_hasDiscount, $f_hasStock)
				->count();
		} else {
			$search = $request->input('search.value');
			$rs = Product::filterQuery($f_category, $f_brand, $f_hasDiscount, $f_hasStock)
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'like', "%{$search}%");
					$query->orWhere('name', 'like', "%{$search}%");
					$query->orWhere('name_ru', 'like', "%{$search}%");
					$query->orWhere('slug', 'like', "%{$search}%");
					$query->orWhere('barcode', 'like', "%{$search}%");
				})
				->with('category', 'brand', 'attributeValues')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Product::filterQuery($f_category, $f_brand, $f_hasDiscount, $f_hasStock)
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'like', "%{$search}%");
					$query->orWhere('name', 'like', "%{$search}%");
					$query->orWhere('name_ru', 'like', "%{$search}%");
					$query->orWhere('slug', 'like', "%{$search}%");
					$query->orWhere('barcode', 'like', "%{$search}%");
				})
				->count();
		}
		$data = array();
		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['image'] = $r->image
					? (file_exists(public_path('storage/products/sm/' . $r->image))
						? '<img src="' . asset('storage/products/sm/' . $r->image) . '" alt="' . $r->name . '" class="w-100" style="border-radius: 8px;">'
						: '<img src="' . asset($r->image) . '" alt="' . $r->name . '" class="w-100" style="border-radius: 8px;">'
					)
					: '<img src="' . asset('img/product.png') . '" alt="' . $r->name . '" class="w-100" style="border-radius: 8px;">';

				$nestedData['attributes'] = '<div class="border-bottom text-danger pb-2">' . optional($r->category)->name . '</div>'
					. '<div class="border-bottom text-primary py-2">' . optional($r->brand)->name . '</div>'
					. '<div class="border-bottom text-dark py-2">' . optional($r->color)->name . '</div>'
					. '<div class="border-bottom pt-2 text-success">' . optional($r->attributeValues)->implode('name', ', ') . '</div>'
					. '<div class="text-black py-2">' . $r->group_code . '</div>';
				$nestedData['name'] = '<div class="mb-1">' . $r->name . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->name_ru . '</div>';
				$nestedData['barcode'] = $r->barcode
					? '<div class="d-flex align-items-center">' . '<div><i class="bi-upc h4 pe-2"></i></div>' . '<div>' . $r->barcode . '</div>' . '</div>'
					: '';
				$nestedData['price'] = '<div class="fs-5">' . number_format((float)$r->price, 1, '.', ' ') . ' <small>tmt</small></div>'
					. ($r->hasDiscount() ? '<div class="fs-4 text-danger">' . number_format((float)$r->discountPrice(), 1, '.', ' ') . ' <small>tmt</small></div>' : '');
				$nestedData['stock'] = '<div class="text-center">'
					. '<button class="btn btn-light btn-sm btn-up" value="' . $r->id . '"><i class="bi-plus-lg"></i></button>'
					. '<div class="fs-5 fw-semibold my-1">' . $r->stock . '</div>'
					. '<button class="btn btn-light btn-sm btn-down" value="' . $r->id . '"><i class="bi-dash-lg"></i></button>'
					. '</div>';
				$nestedData['is_active'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-is_active" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->is_active ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . 'Aktiw' . '</label>'
					. '</div>';
				$nestedData['is_recommended'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-is_recommended" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->is_recommended ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . 'Hödürlenýär' . '</label>'
					. '</div>';
				$nestedData['sold'] = $r->sold;
				$nestedData['viewed'] = $r->viewed;
				$nestedData['action'] = '<a href="' . route('admin.products.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.products.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
					. '<button type="submit" class="btn btn-dark btn-sm my-1"><i class="bi-trash"></i></button></form>';
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			'draw' => intval($request->input('draw')),
			'recordsTotal' => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data' => $data,
		);
		echo json_encode($json_data);
	}
}
