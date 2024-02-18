<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:banners');
	}

	public function index()
	{
		$banners = Banner::orderBy('id', 'desc')
			->get();

		return view('admin.banners.index')
			->with([
				'banners' => $banners,
			]);
	}

	public function create()
	{
		return view('admin.banners.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'image' => 'required|image',
			'image_ru' => 'nullable|image',
			'start_date' => 'nullable|date',
			'end_date' => 'nullable|date',
		]);

		$banner = Banner::create([
			// start today and end after 5 years if it has no end date
			'start_date' => $request->start_date ? $request->start_date : Carbon::now(),
			'end_date' => $request->end_date ? $request->end_date : Carbon::now()->addYears(5),
			'image' => '',
		]);
		if($request->has('image')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/banners/image', $request->image, $name);
			$banner->image = $name;
			$banner->update();
		}

		if($request->has('image_ru')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/banners/image_ru', $request->image_ru, $name);
			$banner->image_ru = $name;
			$banner->update();
		}

		return redirect()->route('admin.banners.index')
			->with([
				'success' => 'Banner created successfully',
			]);
	}

	public function edit($id)
	{
		$banner = Banner::findOrFail($id);

		return view('admin.banners.edit')
			->with([
				'banner' => $banner,
			]);
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			'image' => 'nullable|image',
			'image_ru' => 'nullable|image',
			'start_date' => 'nullable|date',
			'end_date' => 'nullable|date',
		]);

		$banner = Banner::findOrFail($id);
		$banner->start_date = $request->start_date ? $request->start_date : Carbon::now();
		$banner->end_date = $request->end_date ? $request->end_date : Carbon::now()->addYears(5);

		if($request->has('image')) {
			if($banner->image) {
				Storage::delete('public/img/banners/image/' . $banner->image);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/banners/image', $request->image, $name);
			$banner->image = $name;
		}
		$banner->update();

		if($request->has('image_ru')) {
			if($banner->image_ru) {
				Storage::delete('public/img/banners/image_ru/' . $banner->image_ru);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/banners/image_ru', $request->image_ru, $name);
			$banner->image_ru = $name;
		}
		$banner->update();

		return redirect()->route('admin.banners.index')
			->with([
				'success' => 'Banner updated successfully',
			]);
	}

	public function destroy($id)
	{
		$banner = Banner::findOrFail($id);
		if($banner->image) {
			Storage::delete('public/img/banners/image/' . $banner->image);
		}
		$banner->delete();

		if($banner->image_ru) {
			Storage::delete('public/img/banners/image_ru/' . $banner->image_ru);
		}
		$banner->delete();

		return redirect()->route('admin.banners.index')
			->with([
				'success' => 'Banner deleted successfully',
			]);
	}

	public function deleteImageTmFromEdit($id)
	{
		$slider = Banner::findOrFail($id);

		if ($slider->image) {
			Storage::delete('public/img/banners/image/' . $slider->image);
			$slider->image = null;
			$slider->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}

	public function deleteImageRuFromEdit($id)
	{
		$slider = Banner::findOrFail($id);

		if ($slider->image_ru) {
			Storage::delete('public/img/banners/image_ru/' . $slider->image_ru);
			$slider->image_ru = null;
			$slider->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}
}
