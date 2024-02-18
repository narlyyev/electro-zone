<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	protected $fillable = ['logo', 'hex_code', 'phone_1', 'phone_2', 'address'];

	public $timestamps = false;
}
