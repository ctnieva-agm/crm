<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('home.login');
    }

    public function store(Request $request)
    {

        $user = User::where('username', $request->username)
                    ->where('password', $request->password)
                    ->first();
        if ($user) {
            Auth::login($user);
            return Auth::user();
            return redirect()->intended('/');
        } else {
            return 123;
        }
    }
}
