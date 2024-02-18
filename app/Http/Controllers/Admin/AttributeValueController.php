<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeValueController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:attribute_values');
	}


	public function index(Request $request)
	{
		$request->validate([
			'attribute' => 'nullable|integer|min:0',
		]);
		$f_attribute = $request->attribute ?: 0;

		return view('admin.attribute_values.index')
			->with([
				'f_attribute' => $f_attribute,
			]);
	}


	public function create()
	{
		$attributes = Attribute::orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('admin.attribute_values.create')
			->with([
				'attributes' => $attributes,
			]);
	}


	public function store(Request $request)
	{
		$request->validate([
			'attribute_id' => 'required|integer|min:1',
			'name' => 'required|string|max:50',
			'name_ru' => 'nullable|string|max:50',
			'name_en' => 'nullable|string|max:50',
			'sort_order' => 'required|integer|min:1',
		]);

		$attributeValue = new AttributeValue();
		$attributeValue->attribute_id = $request->attribute_id;
		$attributeValue->name = $request->name;
		$attributeValue->name_ru = $request->name_ru ?: null;
		$attributeValue->name_en = $request->name_en ?: null;
		$attributeValue->sort_order = $request->sort_order;
		$attributeValue->save();

		return to_route('admin.attribute_values.index')
			->with([
				'success' => 'Baha ' . '<b>' . $attributeValue->name . '</b>' . ' döredildi',
			]);
	}


	public function edit($id)
	{
		$attributeValue = AttributeValue::findOrFail($id);

		$attributes = Attribute::orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('admin.attribute_values.edit')
			->with([
				'attributeValue' => $attributeValue,
				'attributes' => $attributes,
			]);
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:50',
			'name_ru' => 'nullable|string|max:50',
			'name_en' => 'nullable|string|max:50',
			'sort_order' => 'required|integer|min:1',
		]);

		$attributeValue = AttributeValue::findOrFail($id);
		$attributeValue->attribute_id = $request->attribute_id;
		$attributeValue->name = $request->name;
		$attributeValue->name_ru = $request->name_ru ?: null;
		$attributeValue->name_en = $request->name_en ?: null;
		$attributeValue->sort_order = $request->sort_order;
		$attributeValue->update();

		return to_route('admin.attribute_values.index')
			->with([
				'success' => 'Baha ' . '<b>' . $attributeValue->name . '</b>' . ' üýtgedildi',
			]);
	}


	public function destroy($id)
	{
		$attributeValue = AttributeValue::findOrFail($id);
		$attributeValue->delete();

		return to_route('admin.attribute_values.index')
			->with([
				'success' => 'Baha ' . '<b>' . $attributeValue->name . '</b>' . ' pozuldy',
			]);
	}


	public function up(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$attributeValue = AttributeValue::findOrFail($request->id);
		if ($attributeValue->sort_order < 999) {
			$attributeValue->sort_order += 1;
		}
		$attributeValue->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $attributeValue->sort_order,
		], Response::HTTP_OK);
	}


	public function down(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$attributeValue = AttributeValue::findOrFail($request->id);
		if ($attributeValue->sort_order > 1) {
			$attributeValue->sort_order -= 1;
		}
		$attributeValue->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $attributeValue->sort_order,
		], Response::HTTP_OK);
	}


	public function api(Request $request)
	{
		$request->validate([
			'attribute' => 'nullable|integer|min:0',
		]);
		$f_attribute = $request->attribute ?: 0;

		$columns = array(
			0 => 'id',
			1 => 'sort_order',
			2 => 'attribute_id',
			3 => 'name',
		);

		$totalData = AttributeValue::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (!$request->input('search.value')) {
			$rs = AttributeValue::when($f_attribute, function ($query) use ($f_attribute) {
				return $query->where('attribute_id', $f_attribute);
			})
				->with('attribute')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = AttributeValue::when($f_attribute, function ($query) use ($f_attribute) {
				return $query->where('attribute_id', $f_attribute);
			})
				->count();
		} else {
			$search = $request->input('search.value');
			$rs = AttributeValue::when($f_attribute, function ($query) use ($f_attribute) {
				return $query->where('attribute_id', $f_attribute);
			})
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'LIKE', "%{$search}%");
					$query->orWhere('name', 'LIKE', "%{$search}%");
					$query->orWhere('name_ru', 'LIKE', "%{$search}%");
				})
				->with('attribute')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = AttributeValue::when($f_attribute, function ($query) use ($f_attribute) {
				return $query->where('attribute_id', $f_attribute);
			})
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'LIKE', "%{$search}%");
					$query->orWhere('name', 'LIKE', "%{$search}%");
					$query->orWhere('name_ru', 'LIKE', "%{$search}%");
				})
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
				$nestedData['attribute_id'] = '<div class="mb-1">' . $r->attribute->name . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->attribute->name_ru . '</div>';
				$nestedData['name'] = '<div class="mb-1">' . $r->name . '</div>'
					. '<div class="mb-1"><span class="font-monospace text-primary">RU</span> ' . $r->name_ru . '</div>';
				$nestedData['action'] = '<a href="' . route('admin.attribute_values.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.attribute_values.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
					. '<button type="submit" class="btn btn-dark btn-sm my-1"><i class="bi-trash"></i></button></form>';
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
