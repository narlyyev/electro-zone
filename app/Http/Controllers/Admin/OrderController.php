<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:orders');
	}

	public function index(Request $request)
	{
		$request->validate([
			'locations' => 'nullable|array',
			'locations.*' => 'nullable|integer|min:1',
			'statuses' => 'nullable|array',
			'statuses.*' => 'nullable|integer|between:0,4',
		]);
		$f_locations = $request->locations ?: [];
		$f_statuses = $request->statuses ?: [0, 1, 2];

		$locations = Location::orderBy('name')
			->get();
		$statuses = [
			0 => 'Garaşylýar',
			1 => 'Kabul edildi',
			2 => 'Dowam edýär',
			3 => 'Tamamlandy',
			4 => 'Ýatytyldy',
		];

		return view('admin.orders.index')
			->with([
				'locations' => $locations,
				'statuses' => $statuses,
				'f_locations' => $f_locations,
				'f_statuses' => $f_statuses,
			]);
	}

	public function edit($id)
	{
		$product = Order::findOrFail($id);
		$locations = Location::orderBy('sort_order')
			->orderBy('name')
			->get();
		$statuses = [
			0 => 'Garaşylýar',
			1 => 'Kabul edildi',
			2 => 'Dowam edýär',
			3 => 'Tamamlandy',
			4 => 'Ýatytyldy',
		];

		return view('admin.orders.edit')
			->with([
				'product' => $product,
				'locations' => $locations,
				'statuses' => $statuses,
			]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'location' => 'required|integer|min:1',
			'name' => 'required|string|max:50',
			'phone' => 'required|integer|between:60000000,65999999',
			'address' => 'required|string|between:5,255',
			'note' => 'nullable|string|max:255',
			'status' => 'required|integer|between:0,4',
		]);

		$order = Order::findOrFail($id);

		if ($order->location_id != $request->location) {
			$order->location_id = $request->location;
		}

		if ($order->customer_name != $request->name) {
			$order->customer_name = $request->name;
		}

		if ($order->customer_phone != $request->phone) {
			$order->customer_phone = $request->phone;
		}

		if ($order->customer_address != $request->address) {
			$order->customer_address = $request->address;
		}

		if ($order->customer_note != $request->note) {
			$order->customer_note = $request->note;
		}

		if ($order->status != $request->status) {
			$statuses = [
				0 => 'Garaşylýar',
				1 => 'Kabul edildi',
				2 => 'Dowam edýär',
				3 => 'Tamamlandy',
				4 => 'Ýatytyldy',
			];
			$order->status = $request->status;
		}

		$order->update();

		return to_route('admin.orders.index')
			->with([
				'success' => trans('app.order') . ' ' . trans('app.updated') . '!',
			]);
	}

	public function destroy($id)
	{
		$product = Order::findOrFail($id);
		$product->delete();

		return to_route('admin.orders.index')
			->with([
				'success' => 'Sargyt' . ' ' . 'pozuldy' . '!',
			]);
	}

	public function api(Request $request)
	{
		$request->validate([
			'locations' => 'nullable|array',
			'locations.*' => 'nullable|integer|min:1',
			'statuses' => 'nullable|array',
			'statuses.*' => 'nullable|integer|between:0,4',
		]);
		$f_locations = $request->locations ?: [];
		$f_statuses = $request->statuses ?: [];

		$columns = array(
			0 => 'id',
			1 => 'code',
			2 => 'customer_name',
			3 => 'products_price',
			4 => 'total_price',
			5 => 'status',
			6 => 'created_at',
		);

		$totalData = Order::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

		if (!$request->input('search.value')) {
			$rs = Order::filterQuery($f_locations, $f_statuses)
				->with('location', 'orderProducts.product')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Order::filterQuery($f_locations, $f_statuses)
				->count();
		} else {
			$search = $request->input('search.value');
			$rs = Order::filterQuery($f_locations, $f_statuses)
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'LIKE', "%{$search}%");
					$query->orWhere('code', 'LIKE', "%{$search}%");
					$query->orWhere('customer_name', 'LIKE', "%{$search}%");
					$query->orWhere('customer_phone', 'LIKE', "%{$search}%");
					$query->orWhere('customer_address', 'LIKE', "%{$search}%");
					$query->orWhere('customer_note', 'LIKE', "%{$search}%");
				})
				->with('location', 'orderProducts.product')
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->orderBy('id', 'desc')
				->get();
			$totalFiltered = Order::filterQuery($f_locations, $f_statuses)
				->where(function ($query) use ($search) {
					$query->orWhere('id', 'LIKE', "%{$search}%");
					$query->orWhere('code', 'LIKE', "%{$search}%");
					$query->orWhere('customer_name', 'LIKE', "%{$search}%");
					$query->orWhere('customer_phone', 'LIKE', "%{$search}%");
					$query->orWhere('customer_address', 'LIKE', "%{$search}%");
					$query->orWhere('customer_note', 'LIKE', "%{$search}%");
				})
				->count();
		}
		$data = array();
		if ($rs) {
			foreach ($rs as $r) {
				$nestedData['id'] = $r->id;
				$nestedData['code'] = '<div class="font-monospace text-danger fw-semibold mb-1">' . $r->code . '</div>'
					. '<div><i class="bi-' . $r->platformIcon() . ' text-secondary"></i> ' . $r->platform() . '</div>';
				$nestedData['customer_name'] = '<div class="mb-1"><i class="bi-person-circle text-secondary"></i> ' . $r->customer_name . '</div>'
					. '<div class="mb-1"><i class="bi-telephone-fill text-success"></i> ' . $r->customer_phone . '</div>'
					. '<div class="mb-1"><i class="bi-geo-alt-fill text-secondary"></i> ' . $r->location->getName() . ', ' . $r->customer_address . '</div>'
					. (isset($r->customer_note) ? '<div class="fw-semibold"> <i class="bi-sticky-fill text-warning"></i> ' . $r->customer_note . '</div>' : '');
				$orderProducts = [];
				foreach ($r->orderProducts as $orderProduct) {
					$orderProducts[] = '<div class="row align-items-center g-2">'
						. '<div class="col-2">'
						. ($orderProduct->product->image
							? '<img src="' . Storage::url('img/sm/' . $orderProduct->product->image) . '" alt="" class="img-fluid">'
							: '<img src="' . asset('img/product.jpg') . '" alt="" class="img-fluid">')
						. '</div>'
						. '<div class="col"><div class="mb-1">' . $orderProduct->product->getName() . '</div><div class="font-monospace text-danger">' . $orderProduct->product->barcode . '</div>' . '</div>'
						. '<div class="col-1 fs-3 text-center">' . $orderProduct->quantity . '</div>'
						. '<div class="col-3 fs-5 text-center">' . number_format((float)$orderProduct->total_price, 1, '.', ' ') . ' <small>tmt</small></div>'
						. '<div class="col-auto"><a href="' . route('admin.orderProducts.edit', $orderProduct->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a></div>'
						. '</div>';
				}
				$nestedData['products_price'] = '<div>' . implode('<div class="border-top my-1"></div>', $orderProducts) . '</div>';
				$nestedData['total_price'] = '<div class="fs-5"><i class="bi-cart"></i> ' . number_format((float)$r->products_price, 1, '.', ' ') . ' <small>tmt</small></div>'
					. '<div class="fs-5"><i class="bi-truck"></i> ' . number_format((float)$r->delivery_fee, 1, '.', ' ') . ' <small>tmt</small></div>'
					. '<div class="fs-5 text-danger">' . number_format((float)$r->total_price, 1, '.', ' ') . ' <small>tmt</small></div>';
				$nestedData['status'] = '<div class="badge text-bg-' . $r->statusColor() . '">' . $r->status() . '</div>';
				$nestedData['created_at'] = $r->created_at->format('Y-m-d H:i:s');
				$nestedData['action'] = '<a href="' . route('admin.orders.edit', $r->id) . '" class="btn btn-success btn-sm my-1"><i class="bi-pencil"></i></a>'
					. '<form action="' . route('admin.orders.destroy', $r->id) . '" method="post">' . csrf_field() . method_field('DELETE')
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
