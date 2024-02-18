<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('can:users');
	}

	public function index()
	{
		$users = User::orderBy('id', 'desc')
			->get();

		return view('admin.users.index')
			->with([
				'users' => $users,
				'permissions' => $this->getPermissions(),
			]);
	}

	public function create()
	{
		$users = User::orderBy('id', 'desc')
			->get();

		return view('admin.users.create')
			->with([
				'permissions' => $this->getPermissions(),
				'moreUsers' => $users,
			]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'permissions' => ['nullable', 'array'],
			'permissions.*' => ['nullable', 'integer', 'min:1'],
			'name' => ['required', 'string', 'max:255'],
			'role' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'integer', 'between:60000000, 65999999', Rule::unique('users', 'phone')],
		]);

		$user = User::create([
			'permissions' => $request->permissions ?: [],
			'name' => $request->name,
			'role' => $request->role,
			'phone' => $request->phone,
			'password' => '',
		]);

		if ($request->has('image')) {
			$name = str()->random(10) . 'png';
			Storage::putFileAs('public/img/users', $request->image, $name);
			$user->image = $name;
			$user->update();
		}

		return redirect()->route('admin.users.index')
			->with([
				'success' => 'Ullanyjy ' . '<b>' . $user->name . '</b>' . ' döredildi'
			]);
	}

	public function edit($id)
	{
		$user = User::findOrFail($id);
		return view('admin.users.edit')
			->with([
				'user' => $user,
				'permissions' => $this->getPermissions(),
			]);
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);
		$request->validate([
			'permissions' => ['nullable', 'array'],
			'permissions.*' => ['nullable', 'integer', 'min:1'],
			'name' => ['required', 'string', 'max:255'],
			'role' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'integer', 'between:60000000, 65999999'],
		]);

		$user->update([
			'permissions' => $request->permissions ?: [],
			'name' => $request->name,
			'role' => $request->role,
			'phone' => $request->phone,
		]);

		if ($request->hasFile('image')) {
			if ($user->image) {
				Storage::delete('public/img/users/' . $user->image);
			}
			$name = str()->random(10) . '.' . 'png';
			$request->file('image')->storeAs('public/img/users', $name);
			$user->image = $name;
		}
		$user->save();

		return to_route('admin.users.index')
			->with([
				'success' => 'Ullanyjy ' . '<b>' . $user->name . '</b>' . ' üýtgedildi',
				'user' => $user,
			]);
	}

	public function destroy($id)
	{
		$user = User::findOrFail($id);
		if ($user->id == 1 || auth()->user()->id == $user->id || $user->role == 'admin' || $user->role == 'superadmin') {
			return to_route('admin.users.index')
				->with([
					'error' => 'Siz bu ullanyjyny pozup bileňzok!'
				]);
		}
		if ($user->image) {
			Storage::delete('public/img/users/' . $user->image);
		}
		$user->delete();

		return to_route('admin.users.index')
			->with([
				'success' => 'Ullanyjy ' . '<b>' . $user->name . '</b>' . ' pozuldy',
				'user' => $user,
			]);
	}

	public function password($id)
	{
		$user = User::findOrFail($id);
		$newPassword = 'media' . rand(100, 999);
		$user->password = bcrypt($newPassword);
		$user->update();

		return redirect()->route('admin.users.index')
			->with([
				'success' => '<b>' . strtoupper($user->name) . '</b>' . ' ullanyjyň täze açarsözi: ' . '<b>' . $newPassword . '</b>',
				'user' => $user,
			]);
	}

	protected function getPermissions()
	{
		return [
			['id' => 1, 'name' => trans('productPanel')],
			['id' => 2, 'name' => trans('ordersPanel')],
			['id' => 3, 'name' => trans('visitorsPanel')],
			['id' => 4, 'name' => trans('adminPanel')],
			['id' => 5, 'name' => trans('orders')],
			['id' => 6, 'name' => trans('contacts')],
			['id' => 7, 'name' => trans('products')],
			['id' => 8, 'name' => trans('categories')],
			['id' => 9, 'name' => trans('brands')],
			['id' => 10, 'name' => trans('attributes')],
			['id' => 11, 'name' => trans('sliders')],
			['id' => 12, 'name' => trans('locations')],
			['id' => 13, 'name' => trans('users')],
			['id' => 14, 'name' => trans('ipAddresses')],
			['id' => 15, 'name' => trans('userAgents')],
			['id' => 16, 'name' => trans('authAttempts')],
			['id' => 17, 'name' => trans('visitors')],
			['id' => 18, 'name' => trans('attributeValues')],
			['id' => 19, 'name' => trans('banners')],
			['id' => 20, 'name' => trans('news_categories')],
			['id' => 21, 'name' => trans('news')],
			['id' => 22, 'name' => trans('config')],
		];
	}
}
