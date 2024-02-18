<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:users');
	}

	public function index()
	{
		$config = Config::first();

		return view('admin.config.index', compact('config'));
	}

	public function edit($id)
	{
		$config = Config::findOrFail($id);

		return view('admin.config.index')
			->with([
				'config' => $config,
			]);
	}

	public function update(Request $request, $id)
	{
		$config = Config::findOrFail($id);

		$data = $request->validate([
			'logo' => 'nullable|image',
			'hex_code' => 'required|string|max:100',
			'phone_1' => 'required|string',
			'phone_2' => 'required|string',
			'address' => 'required|string',
		]);

		if ($request->hasFile('logo')) {
			$logo = $request->file('logo');
			if ($config->logo) {
				$previousLogoPath = public_path('img/' . $config->logo);
				if (file_exists($previousLogoPath)) {
					unlink($previousLogoPath);
				}
			}
			$name = Str::random(10) . '.' . $logo->getClientOriginalExtension();
			$logo->move(public_path('img/'), $name);
			$data['logo'] = $name;
		}
		$config->update($data);
		return redirect()->route('admin.config.index')->with([
			'success' => 'Config updated successfully',
		]);
	}
}
