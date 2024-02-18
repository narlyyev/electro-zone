<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'attribute_id',
		'name',
		'name_ru',
		'name_en',
		'sort_order',
	];

	public function attribute()
	{
		return $this->belongsTo(Attribute::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_attribute_values');
	}

	public function productsColor()
	{
		return $this->hasMany(Product::class, 'color_id');
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
