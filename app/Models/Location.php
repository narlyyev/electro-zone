<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
		'name',
		'name_ru',
		'delivery_fee',
		'sort_order',
	];

	public $timestamps = false;


	public function orders()
	{
		return $this->hasMany(Order::class);
	}


	public function getName()
	{
		$locale = app()->getLocale();
		switch ($locale) {
			case 'tm':
				return $this->name;
				break;
			case 'ru':
				return $this->name_ru ?: $this->name;
				break;
			default:
				return $this->name;
		}
	}

}
