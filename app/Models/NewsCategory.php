<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
	protected $fillable = [
		'name',
		'name_ru',
		'name_en',
		'slug',
		'is_active',
	];

	public $timestamps = false;

	protected $casts = [
		'created_at' => 'datetime',
	];

	protected static function booted()
	{
		static::creating(function ($newsCategory) {
			$newsCategory->slug = str($newsCategory->name)->slug('-');
		});

		static::updating(function ($newsCategory) {
			$newsCategory->slug = str($newsCategory->name)->slug('-');
		});
	}

	public function news()
	{
		return $this->hasMany(News::class);
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
}
