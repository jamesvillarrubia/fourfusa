<?php

namespace App;


use Illuminate\Contracts\Auth\Guard as Authenticator;
use App\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;


class AuthenticateUser {

	private $users;

	private $socialite;

	private $auth;

	public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
	{

		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;

	}


	//Driver is the site
	//$hasCode is the boolean test
	//$listener is 
	public function execute($driver, $hasCode, $listener)
	{
	

		if ( ! $hasCode )
		{ 
			return $this->getAuthorizationFirst('github');

		}

		$user = $this->users->findByUsernameOrCreate($this->getGithubUser());

		$this->auth->login($user, true);

		return $listener->userHasLoggedIn($user);

	}

	private function getAuthorizationFirst($driver)
	{

		return $this->socialite->driver($driver)->redirect();

	}

	private function getGithubUser()
	{

		return $this->socialite->driver('github')->user();

	}


}