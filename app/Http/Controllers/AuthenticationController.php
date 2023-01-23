<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        //dd($input);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
            //dd(auth()->user()->type);
            if (auth()->user()->level >= 9) {
                return redirect()->route('dashboard.index');
            }
        } else {
            return back()->withErrors([
                'password' => 'Wrong username or password',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
