<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AuthenticateUser;

class AuthController extends Controller
{
 
    public function login(AuthenticateUser $authenticateUser, Request $request)
    {

        return $authenticateUser->execute($request->has('code'), $this);

        //return \Socialite::with('github')->redirect();

    }

    public function userHasLoggedIn($user)
    {

        return redirect('/');

    }


}
