<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductPanelController extends Controller
{
    public function index()
	{
		$daysByPrice = OrderProduct::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(total_price) as count, DATE(created_at) as day")
			->groupBy('day')
			->orderBy('day')
			->get();

		$monthsByPrice = OrderProduct::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(total_price) as count, MONTH(created_at) as month")
			->groupBy('month')
			->orderBy('month')
			->get();

		$daysByQuantity = OrderProduct::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(quantity) as count, DATE(created_at) as day")
			->groupBy('day')
			->orderBy('day')
			->get();

		$monthsByQuantity = OrderProduct::where('created_at', '>', Carbon::now()->firstOfMonth()->subYear())
			->selectRaw("SUM(quantity) as count, MONTH(created_at) as month")
			->groupBy('month')
			->orderBy('month')
			->get();

		$monthsByViewed = ProductView::where('date', '>', Carbon::today()->firstOfMonth()->subYear())
			->selectRaw("SUM(viewed) as count, MONTH(date) as month")
			->groupBy('month')
			->orderBy('month')
			->get();

		$daysByViewed = ProductView::where('date', '>', Carbon::today()->firstOfMonth()->subYear())
			->selectRaw("SUM(viewed) as count, DATE(date) as day")
			->groupBy('day')
			->orderBy('day')
			->get();

















		return view('admin.productPanel.index')->with([
			'daysByViewed' => $daysByViewed,
			'monthsByViewed' => $monthsByViewed,
			'monthsByQuantity' => $monthsByQuantity,
			'daysByQuantity' => $daysByQuantity,
			'monthsByPrice' => $monthsByPrice,
			'daysByPrice' => $daysByPrice,
		]);
	}
}
