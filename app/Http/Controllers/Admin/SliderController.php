<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:sliders');
	}

	public function index()
	{
		$sliders = Slider::get();

		return view('admin.sliders.index')
			->with([
				'sliders' => $sliders,
			]);
	}

	public function create()
	{
		return view('admin.sliders.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'image' => 'required|image',
			'image_ru' => 'required|image',
			'mobile_image' => 'nullable|image',
			'mobile_image_ru' => 'nullable|image',
			'start_date' => 'nullable|date',
			'end_date' => 'nullable|date',
		]);

		$slider = Slider::create([
			'start_date' => $request->start_date ? $request->start_date : Carbon::now(),
			'end_date' => $request->end_date ? $request->end_date : Carbon::now()->addYears(5),
			'image' => '',
			'mobile_image' => '',
		]);
		if($request->has('image')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/image/', $request->image, $name);
			$slider->image = $name;
			$slider->update();
		}
		if($request->has('image_ru')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/image_ru/', $request->image_ru, $name);
			$slider->image_ru = $name;
			$slider->update();
		}

		if($request->has('mobile_image')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/mobile_image/', $request->mobile_image, $name);
			$slider->mobile_image = $name;
			$slider->update();
		}
		if($request->has('mobile_image_ru')) {
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/mobile_image_ru/', $request->mobile_image_ru, $name);
			$slider->mobile_image_ru = $name;
			$slider->update();
		}

		return redirect()->route('admin.sliders.index')
			->with([
				'success' => 'Slaýder üstünlikli döredildi',
			]);
	}

	public function edit($id)
	{
		$slider = Slider::findOrFail($id);

		return view('admin.sliders.edit')
			->with([
				'slider' => $slider,
			]);
	}


	public function update(Request $request, $id)
	{
		$request->validate([
			'image' => 'nullable|image',
			'image_ru' => 'nullable|image',
			'mobile_image' => 'nullable|image',
			'mobile_image_ru' => 'nullable|image',
			'start_date' => 'nullable|date',
			'end_date' => 'nullable|date',
		]);

		$slider = Slider::findOrFail($id);
		$slider->start_date = $request->start_date ? $request->start_date : Carbon::now();
		$slider->end_date = $request->end_date ? $request->end_date : Carbon::now()->addYears(5);

		if($request->has('image')) {
			if($slider->image) {
				Storage::delete('public/img/sliders/image/' . $slider->image);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/image', $request->image, $name);
			$slider->image = $name;
		}
		$slider->update();

		if($request->has('image_ru')) {
			if($slider->image_ru) {
				Storage::delete('public/img/sliders/image_ru/' . $slider->image_ru);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/image_ru', $request->image_ru, $name);
			$slider->image_ru = $name;
		}
		$slider->update();

		if($request->has('mobile_image')) {
			if($slider->mobile_image) {
				Storage::delete('public/img/sliders/mobile_image/' . $slider->mobile_image);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/mobile_image/', $request->mobile_image, $name);
			$slider->mobile_image = $name;
		}
		$slider->update();

		if($request->has('mobile_image_ru')) {
			if($slider->mobile_image_ru) {
				Storage::delete('public/img/sliders/mobile_image_ru/' . $slider->mobile_image_ru);
			}
			$name = str()->random(10) . '.png';
			Storage::putFileAs('public/img/sliders/mobile_image_ru/', $request->mobile_image_ru, $name);
			$slider->mobile_image_ru = $name;
		}
		$slider->update();

		return redirect()->route('admin.sliders.index')
			->with([
				'success' => 'Slaýder üstünlikli üýtgedildi',
			]);
	}

	public function destroy($id)
	{
		$slider = Slider::findOrFail($id);

		if($slider->image) {
			Storage::delete('public/img/sliders/image/' . $slider->image);
		}

		if($slider->image_ru) {
			Storage::delete('public/img/sliders/image_ru/' . $slider->image_ru);
		}

		$slider->delete();

		return redirect()->route('admin.sliders.index')
			->with([
				'success' => 'Slaýder üstünlikli pozuldy',
			]);
	}

	public function deleteImageTmFromEdit($id)
	{
		$slider = Slider::findOrFail($id);

		if ($slider->image) {
			Storage::delete('public/img/sliders/image/' . $slider->image);
			$slider->image = null;
			$slider->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}

	public function deleteImageRuFromEdit($id)
	{
		$slider = Slider::findOrFail($id);

		if ($slider->image_ru) {
			Storage::delete('public/img/sliders/image_ru/' . $slider->image_ru);
			$slider->image_ru = null;
			$slider->save();

			return response()->json(['success' => true]);
		}

		return response()->json(['success' => false]);
	}
}
