<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:orders');
	}

	public function edit($id)
	{
		$obj = OrderProduct::with('order')
			->findOrFail($id);
		if ($obj->order->editable()) {
			return view('admin.orderProduct.edit')
				->with([
					'obj' => $obj,
				]);
		} else {
			return redirect()->back()
				->with([
					'error' => 'Order is not editable',
				]);
		}
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'price' => 'required|numeric|min:0',
			'quantity' => 'required|integer|min:0',
			'discount_percent' => 'required|numeric|between:0,100',
		]);

		$obj = OrderProduct::with('order')
			->findOrFail($id);

		if ($obj->order->editable()) {
			$obj->price = $request->price;
			$obj->quantity = $request->quantity;
			$obj->discount_percent = $request->discount_percent;
			$obj->update();

			$obj->updatePrice();
			$obj->order->updatePrice();

			return redirect()->route('admin.orders.index')
				->with([
					'success' => 'Order: Product updated',
				]);
		} else {
			return redirect()->back()
				->with([
					'error' => 'Order is not editable',
				]);
		}
	}
}
