<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\IpAddress;
use App\Models\Location;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserAgent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use function Laravel\Prompts\error;

class OrderController extends Controller
{
	public function index()
	{
		$locations = Location::orderBy('name')
			->get();
		return view('client.app.order')
			->with([
				'locations' => $locations,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'location' => 'required|integer|min:1',
			'name' => 'required|string|max:50',
			'phone' => 'required|integer|between:60000000,65999999',
			'address' => 'required|string|between:5,255',
			'note' => 'nullable|string|max:255',
			'payment' => 'nullable|integer|between:0,1', // 0 => cash, 1 => terminalf
		]);

		$location = Location::find($request->location);
		if (!$location) {
			return response()->json([
				'status' => 0,
				'message' => 'Location not found',
			], Response::HTTP_NOT_FOUND);
		}


		$cookieProductsCount = [];
		$cartProducts = [];
		$productsPrice = 0;

		if (Cookie::has('pr_c') && Cookie::get('pr_c') !== '') {
			$cookieProducts = explode(',', Cookie::get('pr_c'));
			$cookieProductsCount = array_count_values($cookieProducts);
		}

		// Check if there are items in the cart
		if (count($cookieProductsCount) === 0) {
			return redirect()->route('cart')
				->with('error', 'Your cart is empty. Please add items to your cart before placing an order.');
		}



		$order = new Order();
		$order->location_id = $location->id;
		$order->code = Str::random(10);
		$order->customer_name = $request->name;
		$order->customer_phone = $request->phone;
		$order->customer_address = $request->address;
		$order->customer_note = $request->note;
		$order->delivery_fee = $location->delivery_fee;
		$order->save();

		// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

		$cookieProductsCount = [];
		$cartProducts = [];
		$productsPrice = 0;
		if (Cookie::has('pr_c')) {
			if (Cookie::get('pr_c') != '') {
				$cookieProducts = explode(',', Cookie::get('pr_c'));
				$cookieProductsCount = array_count_values($cookieProducts);
			}
		}

		if (count($cookieProductsCount) > 0) {
			$products = Product::whereIn('id', array_keys($cookieProductsCount))
				->where('stock', '>', 0)
//				->whereNotNull('image')
				->get(['id', 'name', 'slug', 'image', 'price', 'stock', 'discount_percent', 'discount_start', 'discount_end', 'sold', 'created_at']);

			foreach ($products as $product) {
				if ($product->stock >= $cookieProductsCount[$product->id]) {
					$quantity = $cookieProductsCount[$product->id];
					$cartProducts[] = ['product' => $product, 'quantity' => $quantity, 'updated' => 0];
				} else {
					$quantity = $product->stock;
					$cartProducts[] = ['product' => $product, 'quantity' => $quantity, 1];
				}

				if ($quantity < 1) {
					continue;
				}

				$op = new OrderProduct();
				$op->order_id = $order->id;
				$op->product_id = $product->id;
				$op->price = round($product->price, 1);
				$op->quantity = $quantity;
				$op->discount_percent = $product->discountPercent();
				$op->total_price = round($product->price * (1 - $product->discountPercent() / 100) * $quantity, 1);
				$op->save();


				$productsPrice += $op->total_price;

				$product->stock -= $quantity;
				$product->sold += $quantity;
				$product->update();
			}
		}

		Cookie::queue('pr_c', '', 60 * 24 * 14);

		$order->code = Carbon::today()->format('ymd') . sprintf("%'04d", $order->id);
		$order->products_price = round($productsPrice, 1);
		$order->total_price = round($productsPrice + $order->delivery_fee, 1);
		$order->update();

		return to_route('home')
			->with([
				'success' => 'Order is accepted thanks for your order',
			]);
	}
}
