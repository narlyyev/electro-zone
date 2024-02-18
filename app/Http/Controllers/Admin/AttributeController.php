<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:attributes');
	}


	public function index()
	{
		return view('admin.attributes.index');
	}

	public function create()
	{
		return view('admin.attributes.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'name_ru' => 'nullable|string|max:255',
			'name_en' => 'nullable|string|max:255',
			'sort_order' => 'required|integer|min:1'
		]);

		$attribute = Attribute::create([
			'name' => $request->name,
			'name_ru' => $request->name_ru ?? $request->name,
			'name_en' => $request->name_en ?? $request->name,
			'sort_order' => $request->sort_order,
		]);

		return redirect()->route('admin.attributes.index')
			->with([
				'success' => 'Aýratynlyk ' . '<b>' . $attribute->name . '</b>' . ' döredildi'
			]);
	}

	public function edit($id)
	{
		$attribute = Attribute::findOrFail($id);
		return view('admin.attributes.edit')
			->with([
				'attribute' => $attribute
			]);
	}

	public function update(Request $request, $id)
	{

		$request->validate([
			'name' => 'required|string|max:255',
			'name_ru' => 'nullable|string|max:255',
			'name_en' => 'nullable|string|max:255',
			'sort_order' => 'required|integer|min:1',
		]);

		$attribute = Attribute::findOrFail($id);
		$attribute->update([
			'name' => $request->name,
			'name_ru' => $request->name_ru ?? $request->name,
			'name_en' => $request->name_en ?? $request->name,
			'sort_order' => $request->sort_order,
		]);

		return redirect()->route('admin.attributes.index')
			->with([
				'success' => 'Aýratynlyk ' . '<b>' . $attribute->name . '</b>' . ' üýtgedildi'
			]);
	}

	public function destroy($id)
	{
		$attribute = Attribute::withCount('attributeValues')
			->findOrFail($id);

		if ($attribute->attributeValues()->count() > 0) {
			return redirect()->back()
				->with([
					'error' => 'Aýratynlykda ' . $attribute->attribute_values_count . ' sany bahasy bar'
				]);
		}
		$attribute->delete();

		return redirect()->route('admin.attributes.index')
			->with([
				'success' => 'Aýratynlyk üstünlikli pozuldy'
			]);
	}


	public function up(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$attribute = Attribute::findOrFail($request->id);
		if ($attribute->sort_order < 999) {
			$attribute->sort_order += 1;
		}
		$attribute->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $attribute->sort_order,
		], Response::HTTP_OK);
	}


	public function down(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$attribute = Attribute::findOrFail($request->id);
		if ($attribute->sort_order > 1) {
			$attribute->sort_order -= 1;
		}
		$attribute->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $attribute->sort_order,
		], Response::HTTP_OK);
	}

	public function api(Request $request)
	{
		$columns = array(
			0 => 'id',
			1 => 'sort_order',
			2 => 'name',
			3 => 'attribute_values_count',
		);

		$totalData = Attribute::count();
		$limit = request()->input('length');
		$start = request()->input('start');
		$order = $columns[request()->input('order.0.column')];
		$dir = request()->input('order.0.dir');

		if (!$request->input('search.value')) {
			$rs = Attribute::withCount('attributeValues')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Attribute::count();
		} else {
			$search = $request->input('search.value');
			$rs = Attribute::orWhere('id', 'ilike', "%{$search}%")
				->orWhere('name', 'ilike', "%{$search}%")
				->orWhere('name_ru', 'ilike', "%{$search}%")
				->withCount('attributeValues')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Attribute::where('id', 'ilike', "%{$search}%")
				->orWhere('name', 'ilike', "%{$search}%")
				->orWhere('name_ru', 'ilike', "%{$search}%")
				->count();
		}
		$data = array();

		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['sort_order'] = '<div class="text-center">'
					. '<button class="btn btn-light btn-sm btn-up" value="' . $r->id . '"><i class="bi-plus-lg"></i></button>'
					. '<div class="fw-semibold my-1">' . $r->sort_order . '</div>'
					. '<button class="btn btn-light btn-sm btn-down" value="' . $r->id . '"><i class="bi-dash-lg"></i></button>'
					. '</div>';
				$nestedData['name'] = '<div class="mb-1">' . $r->name . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->name_ru . '</div>';
				$nestedData['attribute_values_count'] = '<a href="' . route('admin.attribute_values.index', ['attribute' => $r->id]) . '" class="fs-5 text-decoration-none ' . ($r->attribute_values_count > 0 ? '' : 'd-none') . '">' . $r->attribute_values_count . ' <i class="bi-box-arrow-up-right"></i></a>';
				$nestedData['action'] = '<a href="' . route('admin.attributes.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.attributes.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
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
