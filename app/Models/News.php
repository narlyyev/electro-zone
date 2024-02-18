<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	protected $fillable = [
		'name',
		'name_ru',
		'name_en',
		'description',
		'description_ru',
		'description_en',
		'image',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo(NewsCategory::class);
	}

	protected static function booted()
	{
		static::creating(function ($news) {
			$news->slug = str($news->name)->slug('-');
		});

		static::updating(function ($news) {
			$news->slug = str($news->name)->slug('-');
		});
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
			case 'en':
				return $this->name_en ?: $this->name;
				break;
			default:
				return $this->name;
		}
	}

	public function getDescription()
	{
		$locale = app()->getLocale();
		switch ($locale) {
			case 'tm':
				return $this->description;
				break;
			case 'ru':
				return $this->description_ru ?: $this->description;
				break;
			case 'en':
				return $this->description_en ?: $this->description;
				break;
			default:
				return $this->description;
		}
	}
}
