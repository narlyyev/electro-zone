<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:categories');
	}

	private function generateBranchPath($parentId)
	{
		if ($parentId) {
			$parent = Category::findOrFail($parentId);
			// If the parent has a branch, append the parent's branch, otherwise, start a new branch
			return $parent->branch;
		}
		return '/';
	}

	public function index()
	{
		return view('admin.categories.index');
	}

	public function create()
	{
		$categories = Category::whereNull('parent_id')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		$attributes = Attribute::with('attributeValues')
			->where('name', '!=', 'Reňk')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('admin.categories.create')
			->with([
				'categories' => $categories,
				'attributes' => $attributes,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'parent_id' => 'nullable|integer|min:0',
			'name' => 'required|string|max:50|unique:categories,name',
			'name_ru' => 'nullable|string|max:50',
			'name_en' => 'nullable|string|max:50',
			'sort_order' => 'required|integer|min:1',
			'is_active' => 'nullable|boolean',
			'attributes' => 'nullable|array',
			'attributes.*' => 'nullable|integer|min:0',
		]);

		$attributes = $request->has('attributes')
			? array_values(array_filter($request->input('attributes'), function ($i) {
				return ($i != 0);
			}))
			: [];

		$category = Category::create([
			'parent_id' => $request->parent_id,
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'sort_order' => $request->sort_order,
			'is_home' => $request->is_home ? 1 : 0,
			'is_active' => $request->has('is_active') ? 1 : 0,
			'branch' => '/',
		]);

		// Set branch based on parent-child relationships
		$category->branch = $this->generateBranchPath($category->parent_id) . $category->id . '/';
		$category->save();

		if ($request->has('small_image')) {
			$name = str()->random(10) . '.' . $request->file('small_image')->getClientOriginalExtension();
			Storage::putFileAs('public/img/categories/small_images', $request->small_image, $name);
			$category->small_image = $name;
		}
		$category->update();

		if ($request->has('big_image')) {
			$name = str()->random(10) . '.' . $request->file('big_image')->getClientOriginalExtension();
			Storage::putFileAs('public/img/categories/big_images', $request->big_image, $name);
			$category->big_image = $name;
		}
		$category->update();

		$category->attributes()->sync($attributes);

		return redirect()->route('admin.categories.index')
			->with([
				'success' => 'Kategoriýa ' . '<b>' . $category->name . '</b>' . ' döredildi'
			]);
	}


	public function edit($id)
	{
		$category = Category::findOrFail($id);
		$categories = Category::whereNull('parent_id')
			->orderBy('sort_order')
			->orderBy('slug')
			->get();

		$attributes = Attribute::orderBy('sort_order')
			->where('name', '!=', 'Reňk')
			->orderBy('name')
			->get();

		return view('admin.categories.edit')
			->with([
				'category' => $category,
				'categories' => $categories,
				'attributes' => $attributes,
			]);
	}

	public function update(Request $request, $id)
	{
		$category = Category::findOrFail($id);

		$request->validate([
			'parent_id' => 'nullable|integer|min:0',
			'name' => 'nullable|string|max:50|unique:categories,name,' . $request->id,
			'name_ru' => 'nullable|string|max:50',
			'name_en' => 'nullable|string|max:50',
			'sort_order' => 'nullable|integer|min:1',
			'is_active' => 'nullable|boolean',
			'attributes' => 'nullable|array',
			'attributes.*' => 'nullable|integer|min:0',
		]);

		$attributes = $request->has('attributes')
			? array_values(array_filter($request->input('attributes'), function ($i) {
				return ($i != 0);
			}))
			: [];

		$category->update([
			'parent_id' => $request->parent_id,
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'name_en' => $request->name_en,
			'sort_order' => $request->sort_order,
			'is_home' => $request->is_home ? 1 : 0,
			'is_active' => $request->is_active ? 1 : 0,
			'branch' => $request->branch = '/',
		]);
		// Set branch based on parent-child relationships
		$category->branch = $this->generateBranchPath($category->parent_id) . $category->id . '/';
		$category->save();

		if ($request->has('small_image')) {
			if ($category->small_image) {
				Storage::delete('public/img/categories/small_images/' . $category->small_image);
			}
			$name = str()->random(10) . '.' . $request->file('small_image')->getClientOriginalExtension();
			Storage::putFileAs('public/img/categories/small_images', $request->small_image, $name);
			$category->small_image = $name;
		}
		$category->update();

		if ($request->has('big_image')) {
			if ($category->big_image) {
				Storage::delete('public/img/categories/big_images/' . $category->big_image);
			}
			$name = str()->random(10) . '.' . $request->file('big_image')->getClientOriginalExtension();
			Storage::putFileAs('public/img/categories/big_images', $request->big_image, $name);
			$category->big_image = $name;
		}
		$category->update();

		$category->attributes()->sync($attributes);


		return redirect()->route('admin.categories.index')
			->with([
				'success' => 'Kategoriýa ' . '<b>' . $category->name . '</b>' . ' üýtgedildi'
			]);
	}

	public function destroy($id)
	{
		$category = Category::withCount('products')
			->findOrFail($id);


		if ($category->products->count() > 0) {
			return redirect()->route('admin.categories.index')
				->with([
					'error' => '<b>' . $category->name . '</b>' . ' kategoriýaň ' . $category->products->count() . ' harytlary bar'
				]);
		}

		if ($category->small_image) {
			Storage::delete('public/img/categories/small_images/' . $category->small_image);
		}
		if ($category->big_image) {
			Storage::delete('public/img/categories/big_images/' . $category->big_image);
		}
		$category->delete();

		return redirect()->route('admin.categories.index')
			->with([
				'success' => 'Kategoriýa ' . '<b>' . $category->name . '</b>' . ' pozuldy'
			]);
	}


	public function active(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:0',
		]);

		$category = Category::findOrFail($request->id);
		$category->is_active = $category->is_active ? 0 : 1;
		$category->save();

		return response()->json([
			'status' => '1',
			'is_active' => $category->is_active,
		], Response::HTTP_OK);
	}


	public function home(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$obj = Category::findOrFail($request->id);
		$obj->is_home = $obj->is_home ? 0 : 1;
		$obj->update();

		return response()->json([
			'status' => 1,
			'home' => $obj->is_home,
		], Response::HTTP_OK);
	}

	public function mostUsed(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$obj = Category::findOrFail($request->id);
		$obj->most_used = $obj->most_used ? 0 : 1;
		$obj->update();

		return response()->json([
			'status' => 1,
			'most_used' => $obj->most_used,
		], Response::HTTP_OK);
	}

	public function up(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$obj = Category::findOrFail($request->id);
		if ($obj->sort_order < 999) {
			$obj->sort_order += 1;
		}
		$obj->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $obj->sort_order,
		], Response::HTTP_OK);
	}

	public function down(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$obj = Category::findOrFail($request->id);
		if ($obj->sort_order > 1) {
			$obj->sort_order -= 1;
		}
		$obj->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $obj->sort_order,
		], Response::HTTP_OK);
	}

	public function deleteImageSmallImageFromEdit($id)
	{
		$category = Category::findOrFail($id);

		if ($category->small_image) {
			Storage::delete('public/img/categories/small_images/' . $category->small_image);
			$category->small_image = null;
			$category->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}

	public function deleteImageBigImageFromEdit($id)
	{
		$category = Category::findOrFail($id);

		if ($category->big_image) {
			Storage::delete('public/img/categories/big_images/' . $category->big_image);
			$category->big_image = null;
			$category->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}


	public function api(Request $request)
	{
		$columns = array(
			0 => 'id',
			1 => 'parent_id',
			2 => 'sort_order',
			3 => 'name',
			4 => 'is_home',
			5 => 'most_used',
			6 => 'is_active',
			7 => 'products_count',
			8 => 'attributes',
			9 => 'small_image',
			10 => 'big_image'
		);

		$totalData = Category::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (!request()->input('search.value')) {
			$rs = Category::with('parent')
				->with('attributes')
				->withCount('products')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Category::count();
		} else {
			$search = request()->input('search.value');
			$rs = Category::orWhere('id', 'LIKE', "%{$search}%")
				->orWhere('name', 'LIKE', "%{$search}%")
				->orWhere('name_ru', 'LIKE', "%{$search}%")
				->orWhere('sort_order', 'LIKE', "%{$search}%")
				->orWhere('is_home', 'LIKE', "%{$search}%")
				->orWhere('slug', 'LIKE', "%{$search}%")
				->with('parent')
				->withCount('products')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Category::orWhere('id', 'LIKE', "%{$search}%")
				->orWhere('name', 'LIKE', "%{$search}%")
				->orWhere('name_ru', 'LIKE', "%{$search}%")
				->orWhere('slug', 'LIKE', "%{$search}%")
				->count();
		}

		$data = array();
		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['parent_id'] = '<div class="mb-1">' . ($r->parent ? $r->parent->name : '') . '</div>';
				if ($r->parent) {
					$nestedData['parent_id'] .= '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->parent->name_ru . '</div>';
				}
				$nestedData['sort_order'] = '<div class="text-center">'
					. '<button class="btn btn-light btn-sm btn-up" value="' . $r->id . '"><i class="bi-plus-lg"></i></button>'
					. '<div class="fw-semibold my-1">' . $r->sort_order . '</div>'
					. '<button class="btn btn-light btn-sm btn-down" value="' . $r->id . '"><i class="bi-dash-lg"></i></button>'
					. '</div>';
				$nestedData['name'] = '<div class="mb-1">' . $r->name . '<a href="' . route('category.show', $r->slug) . '" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right ps-2"></i></a>' . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->name_ru . '</div>';
				$nestedData['is_home'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-home" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->is_home ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . '</label>'
					. '</div>';
				$nestedData['most_used'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-most_used" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->most_used ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . '</label>'
					. '</div>';
				$nestedData['is_active'] = '<div class="form-check form-switch">'
					. '<input class="form-check-input check-is_active" type="checkbox" role="switch" value="' . $r->id . '" id="check' . $r->id . '" ' . ($r->is_active ? 'checked' : '') . '>'
					. '<label class="form-check-label" for="check' . $r->id . '">' . '</label>'
					. '</div>';
				$nestedData['products_count'] = '<a href="' . route('admin.products.index', ['category' => $r->id]) . '" class="fs-5 text-decoration-none ' . ($r->products_count > 0 ? '' : 'd-none') . '">' . $r->products_count . ' <i class="bi-box-arrow-up-right"></i></a>';
				$nestedData['attributes'] =
					'<div style="font-size: 10px!important; font-weight: 600;" class="' . ($r->attributes->isNotEmpty() ? 'text-bg-warning p-2 rounded-3 mb-1 me-2' : '') . '">' .
					($r->attributes->pluck('name')->implode(', ') ?: '') . '</div>';
				if ($r->attributes->isNotEmpty()) {
					$nestedData['attributes'] .=
						'<div style="font-size: 10px!important; font-weight: 600;" class="' . ($r->attributes->isNotEmpty() ? 'text-bg-warning p-2 rounded-3 mb-1 me-2' : '') . '"><span class="font-monospace text-primary">RU</span> ' .
						($r->attributes->pluck('name_ru')->implode(', ') ?: '') . '</div>';
				}
				$nestedData['small_image'] = $r->small_image
					? '<img src="' . asset('storage/img/categories/small_images/' . $r->small_image) . '" alt="" class="img-fluid d-block mx-auto" style="width:120px">'
					: '<img src="' . asset('storage/img/brands/brand.jpg') . '" alt="" class="img-fluid d-block mx-auto" style="width:60px">';
				$nestedData['big_image'] = $r->big_image
					? '<img src="' . asset('storage/img/categories/big_images/' . $r->big_image) . '" alt="" class="img-fluid d-block mx-auto" style="width:120px">'
					: '<img src="' . asset('storage/img/brands/brand.jpg') . '" alt="" class="img-fluid d-block mx-auto" style="width:60px">';
				$nestedData['action'] = '<a href="' . route('admin.categories.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.categories.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
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
