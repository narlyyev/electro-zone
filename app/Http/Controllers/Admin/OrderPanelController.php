<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderPanelController extends Controller
{
    public function index()
	{
		$daysByOrder = Order::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("COUNT(id) as count, DATE(created_at) as day")
			->groupBy('day')
			->orderBy('day')
			->get();

		$monthsByOrder = Order::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("COUNT(id) as count, MONTH(created_at) as month")
			->groupBy('month')
			->orderBy('month')
			->get();

		$daysByPrice = Order::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(total_price) as count, DATE(created_at) as day")
			->groupBy('day')
			->orderBy('day')
			->get();

		$monthsByPrice = Order::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(total_price) as count, MONTH(created_at) as month")
			->groupBy('month')
			->orderBy('month')
			->get();

		return view('admin.orderPanel.index')
			->with([
				'daysByOrder' => $daysByOrder,
				'monthsByOrder' => $monthsByOrder,
				'daysByPrice' => $daysByPrice,
				'monthsByPrice' => $monthsByPrice,
			]);
	}
}
