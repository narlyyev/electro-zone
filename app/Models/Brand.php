<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'name',
		'slug',
		'image',
	];

	protected static function booted()
	{
		static::creating(function ($obj) {
			$obj->slug = Str::slug($obj->name, '-');
		});
	}

	public function products()
	{
		return $this->hasMany(Product::class);
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
