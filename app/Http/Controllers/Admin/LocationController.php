<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:locations');
	}

	public function index()
	{

		$locations = Location::withCount('orders')
			->orderBy('sort_order')
			->orderBy('name')
			->get();

		return view('admin.locations.index')
			->with([
				'locations' => $locations,
			]);
	}

	public function create()
	{
		$locations = Location::orderBy('name')
			->get();
		return view('admin.locations.create')
			->with([
				'locations' => $locations,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'name_ru' => 'nullable|string|max:255',
			'delivery_fee' => 'required|numeric|min:1',
			'sort_order' => 'required|integer|min:1',
		]);

		$location = Location::create([
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'delivery_fee' => round($request->delivery_fee, 1),
			'sort_order' => $request->sort_order,
		]);

		return redirect()->route('admin.locations.index')
			->with([
				'success' => '<b>' . $location->name . '</b>' . ' şäher döredildi!'
			]);
	}


	public function edit($id)
	{
		$location = Location::findOrFail($id);

		return view('admin.locations.edit')
			->with([
				'location' => $location,
			]);
	}


	public function update(Request $request, $id)
	{
		$location = Location::findOrFail($id);

		$request->validate([
			'name' => 'required|string|max:255',
			'name_ru' => 'nullable|string|max:255',
		]);

		$location->update([
			'name' => $request->name,
			'name_ru' => $request->name_ru,
			'delivery_fee' => round($request->delivery_fee, 1),
			'sort_order' => $request->sort_order,
		]);

		return redirect()->route('admin.locations.index')
			->with([
				'success' => '<b>' . $location->name . '</b>' . ' şäher üýtgedildi!'
			]);
	}

	public function destroy($id)
	{
		$location = Location::findOrFail($id);
		if ($location->id == 1 or $location->orders->count() > 0) {
			return redirect()->route('admin.locations.index')
				->with([
					'error' => "<b>$location->name</b> pozup bolanok"
				]);
		}
		$location->delete();

		return redirect()->route('admin.locations.index')
			->with([
				'success' => "The location <b>$location->name</b> has been successfully deleted!"
			]);
	}

	public function up(Request $request)
	{
		$request->validate([
			'id' => 'required|integer|min:1',
		]);

		$obj = Location::findOrFail($request->id);
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

		$obj = Location::findOrFail($request->id);
		if ($obj->sort_order > 1) {
			$obj->sort_order -= 1;
		}
		$obj->update();

		return response()->json([
			'status' => 1,
			'sort_order' => $obj->sort_order,
		], Response::HTTP_OK);
	}
}
