<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

	public function productsPanel(User $user)
	{
		return in_array(1, $user->permissions ?: []);
	}

	public function ordersPanel(User $user)
	{
		return in_array(2, $user->permissions ?: []);
	}

	public function visitorsPanel(User $user)
	{
		return in_array(3, $user->permissions ?: []);
	}

	public function adminPanel(User $user)
	{
		return in_array(4, $user->permissions ?: []);
	}

	public function orders(User $user)
	{
		return in_array(5, $user->permissions ?: []);
	}

	public function contacts(User $user)
	{
		return in_array(6, $user->permissions ?: []);
	}

	public function products(User $user)
	{
		return in_array(7, $user->permissions ?: []);
	}

	public function categories(User $user)
	{
		return in_array(8, $user->permissions ?: []);
	}

	public function brands(User $user)
	{
		return in_array(9, $user->permissions ?: []);
	}

	public function attributes(User $user)
	{
		return in_array(10, $user->permissions ?: []);
	}

	public function sliders(User $user)
	{
		return in_array(11, $user->permissions ?: []);
	}

	public function locations(User $user)
	{
		return in_array(12, $user->permissions ?: []);
	}

	public function users(User $user)
	{
		return in_array(13, $user->permissions ?: []);
	}

	public function ipAddresses(User $user)
	{
		return in_array(14, $user->permissions ?: []);
	}

	public function userAgents(User $user)
	{
		return in_array(15, $user->permissions ?: []);
	}

	public function authAttempts(User $user)
	{
		return in_array(16, $user->permissions ?: []);
	}

	public function visitors(User $user)
	{
		return in_array(17, $user->permissions ?: []);
	}

	public function attributeValues(User $user)
	{
		return in_array(18, $user->permissions ?: []);
	}

	public function banners(User $user)
	{
		return in_array(19, $user->permissions ?: []);
	}

	public function newsCategories(User $user)
	{
		return in_array(20, $user->permissions ?: []);
	}

	public function news(User $user)
	{
		return in_array(21, $user->permissions ?: []);
	}

	public function colors(User $user)
	{
		return in_array(22, $user->permissions ?: []);
	}
}
