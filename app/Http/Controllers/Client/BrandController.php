<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Config;
use Database\Seeders\ConfigSeeder;
use Illuminate\Http\Request;

class BrandController extends Controller
{
	public function show($slug)
	{
		$configs = Config::orderBy('id','desc')->get();

		$brand = Brand::where('slug', $slug)->firstOrFail();

		$products = $brand->products()->paginate(30);

		return view('client.brand.show')->with([
			'brand' => $brand,
			'products' => $products,
			'config' => $config,
		]);
	}
}
