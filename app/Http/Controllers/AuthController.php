<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AuthenticateUser;
use Auth;
use Session;

class AuthController extends Controller
{
 
    public function login(AuthenticateUser $authenticateUser, Request $request)
    {


		$hasCode = $request->has('code');
        return $authenticateUser->execute($hasCode, $this);

    }

    public function logout()
    {

		Auth::logout();
		//sleep(1);

    	//finally logged out!!!!
   		//Auth::logout();
		Session::flush();
		return redirect()->to('/');

    }

    public function userHasLoggedIn($user)
    {

        return redirect('/');

    }


}
