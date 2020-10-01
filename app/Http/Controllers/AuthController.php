<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

final class AuthController
{
    public function login()
    {
        $randomUser = User::all()->random();
        return view('login-form', ['randomUser' => $randomUser]);
    }


    public function loginCheck()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'email' => 'email|required|min:10|max:40',
                'password' => 'required|min:6|max:70',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors());
        }

        $credentials = [
            'email' => request()->get('email'),
            'password' => request()->get('password'),
        ];

        $remember = request()->get('remember') === 'on';

        if (!Auth::attempt($credentials, $remember)) {
            return redirect()
                ->route('login')
                ->withErrors(['email or password' => 'Invalid email or password!']);
        }

        return redirect()
            ->route('home')
            ->with('successful login', 'You have logged in successfully!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('home');
    }
}

