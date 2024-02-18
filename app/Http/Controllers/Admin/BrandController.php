<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:brands');
	}

	public function index()
	{
		return view('admin.brands.index');
	}

	public function create()
	{
		return view('admin.brands.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:50|unique:brands,name',
			// 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:48|dimensions:width=220,height=180',
		]);

		$brand = Brand::create([
			'name' => $request->name,
		]);
		if ($request->has('image')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/brands', $request->image, $name);
			$brand->image = $name;
			$brand->update();
		}

		return redirect()->route('admin.brands.index')
			->with([
				'success' => 'Brend ' . '<b>' . $brand->name . '</b>' . ' döredildi'
			]);
	}

	public function edit($id)
	{
		$brand = Brand::findOrFail($id);

		return view('admin.brands.edit')
			->with([
				'brand' => $brand
			]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:50',
			// 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:48|dimensions:width=200,height=200',
		]);

		$brand = Brand::findOrFail($id);
		$brand->name = $request->name;
		$brand->save();

		if ($request->has('image')) {
			if ($brand->image) {
				Storage::delete('public/img/brands/' . $brand->image);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/brands/', $request->image, $name);
			$brand->image = $name;
		}
		$brand->update();

		return redirect()->route('admin.brands.index')
			->with([
				'success' => 'Brend ' . '<b>' . $brand->name . '</b>' . ' üýtgedildi'
			]);
	}

	public function destroy($id)
	{
		$brand = Brand::findOrFail($id);
		if ($brand->products()->count() > 0) {
			return redirect()->route('admin.brands.index')
				->with([
					'error' => '<b>' . $brand->name . '</b>' . ' brendiň ' . $brand->products()->count() . ' sany' . ' harydy bar'
				]);
		}
		if ($brand->image) {
			Storage::delete('public/img/brands/' . $brand->image);
		}
		$brand->delete();

		return redirect()->route('admin.brands.index')
			->with([
				'success' => 'Brend ' . '<b>' . $brand->name . '</b>' . ' pozuldy'
			]);
	}

	public function deleteImageFromEdit($id)
	{
		$brand = Brand::findOrFail($id);

		if ($brand->image) {
			Storage::delete('public/img/brands/' . $brand->image);
			$brand->image = null;
			$brand->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}



	public function api(Request $request)
	{
		$columns = array(
			0 => 'id',
			1 => 'image',
			2 => 'name',
			6 => 'products_count',
		);

		$totalData = Brand::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (!$request->input('search.value')) {
			$rs = Brand::withCount('products')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Brand::count();
		} else {
			$search = $request->input('search.value');
			$rs = Brand::orWhere('id', 'like', "%{$search}%")
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('slug', 'like', "%{$search}%")
				->withCount('products')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Brand::orWhere('id', 'like', "%{$search}%")
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('slug', 'like', "%{$search}%")
				->count();
		}

		$data = array();
		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['image'] = $r->image
					? '<img src="' . asset('storage/img/brands/' . $r->image) . '" alt="" class="img-fluid d-block mx-auto" style="width:120px">'
					: '<img src="' . asset('storage/img/brands/brand.jpg') . '" alt="" class="img-fluid d-block mx-auto" style="width:120px">';
				$nestedData['name'] = $r->name . ' <a href="' . route('brand.show', $r->slug) . '" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"></i></a>';
				$nestedData['products_count'] = '<a href="' . route('admin.products.index', ['brand' => $r->id]) . '" class="fs-5 text-decoration-none ' . ($r->products_count > 0 ? '' : 'd-none') . '">' . $r->products_count . ' <i class="bi-box-arrow-up-right"></i></a>';
				$nestedData['action'] = '<div class="text-center"><a href="' . route('admin.brands.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a></div>'
					. '<form action="' . route('admin.brands.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
					. '<button type="submit" class="btn btn-dark btn-sm my-1 d-block mx-auto"><i class="bi-trash"></i></button></form>';
				$data[] = $nestedData;
			}
		}

		$json_data = array(
			'draw' => intval($request->input('draw')),
			'recordsTotal' => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data' => $data
		);

		echo json_encode($json_data);
	}
}
