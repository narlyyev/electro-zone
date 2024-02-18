<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
	protected $fillable = [
		'order_id',
		'product_id',
		'price',
		'quantity',
		'discount_percent',
		'total_price',
	];

	const UPDATED_AT = null;

	public function order()
	{
		return $this->belongsTo(Order::class);
	}


	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function updatePrice()
	{
		$this->total_price = round(($this->price * $this->quantity) * (1 - $this->discount_percent / 100), 1);
		$this->update();
	}

	public function scopeFilterQuery($query, $f_orders, $f_products, $f_locations, $f_statuses)
	{
		return $query
			->when($f_orders, function ($query) use ($f_orders) {
				return $query->whereIn('order_id', $f_orders);
			})
			->when($f_products, function ($query) use ($f_products) {
				return $query->whereIn('product_id', $f_products);
			})
			->whereHas('order', function ($query) use ($f_locations, $f_statuses) {
				$query->when($f_locations, function ($query) use ($f_locations) {
					return $query->whereIn('location_id', $f_locations);
				});
				$query->when($f_statuses, function ($query) use ($f_statuses) {
					return $query->whereIn('status', $f_statuses);
				});
			});
	}
}
