<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public $fillable = [
		'location_id',
		'code',
		'customer_name',
		'customer_phone',
		'customer_address',
		'customer_note',
		'products_price',
		'delivery_fee',
		'total_price',
		'status'
	];

	protected $casts = [
		'created_at' => 'datetime',
	];

	const UPDATED_AT = null;

	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function orderProducts()
	{
		return $this->hasMany(OrderProduct::class);
	}

	public function status()
	{
		return [
			'Garaşylýar',
			'Kabul edildi',
			'Dowam edýär',
			'Tamamlandy',
			'Ýatytyldy',
		][$this->status];
	}

	public function statusColor()
	{
		return ['warning', 'light', 'info', 'success', 'danger'][$this->status];
	}


	public function editable()
	{
		if ($this->status > 1) {
			return false;
		} else {
			return true;
		}
	}


	public function updatePrice()
	{
		$productsPrice = 0;
		foreach ($this->orderProducts as $product) {
			$productsPrice += $product->total_price;
		}
		$this->products_price = $productsPrice;
		$this->total_price = round($productsPrice + $this->location->delivery_fee, 1);
		$this->update();
	}

	public function platform()
	{
		return ['Web', 'Android', 'iOS'][$this->platform];
	}

	public function platformIcon()
	{
		return ['browser-chrome', 'android2', 'apple'][$this->platform];
	}


	public function scopeFilterQuery($query, $f_locations, $f_statuses)
	{
		return $query
			->when($f_locations, function ($query) use ($f_locations) {
				return $query->whereIn('location_id', $f_locations);
			})
			->when($f_statuses, function ($query) use ($f_statuses) {
				return $query->whereIn('status', $f_statuses);
			});
	}

}
