<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'name',
		'name_ru',
		'name_en',
		'sort_order',
	];

	public function attributeValues()
	{
		return $this->hasMany(AttributeValue::class);
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'category_attributes');
	}

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_attribute_values');
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
