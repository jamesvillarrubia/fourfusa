<?php

namespace App\Repositories;

use App\User;

class UserRepository{

	public function findByUsernameOrCreate($userData)
	{

		$user = User::where('email', '=', $userData->email)->first();

		if( ! $user )
		{
			return User::firstOrCreate([

				'name'		=> $userData->name,
				'username'  => $userData->nickname,
				'email'		=> $userData->email,
				'avatar'	=> $userData->avatar,

			]);
		}

		return $user;

	}

}