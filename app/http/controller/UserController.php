<?php

namespace App\Http\Controller;

use App\Model\Users;
use Core\Auth;
use Core\Http\Request;
use Core\Utils\Hash;

class UserController
{
    public function create()
    {
        return view('auth.signup');
    }

    public function store()
    {
        $credentials = Request::validate([
            'name' => ['string', 'min:4'],
            'email' => ['string', 'email'],
            'password' => ['string', 'min:4'],
        ]);
        
        if(!$credentials) return redirect('auth.login', ['error' => 'Username, password or email is invalid!']);
        if($credentials['password'] != Request::post('confirmpassword')) return redirect('auth.create', ['error' => 'Password confirmation should same as password!']);
        
        $credentials['password'] = Hash::make($credentials['password']);

        if(Users::create($credentials)) {
            $credentials['password'] = Request::post('confirmpassword');
            if (Auth::attempt($credentials)) return redirect('todo.index');
        }
        
        return redirect('auth.create', ['error' => 'Fatal Error']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth()
    {
        $credentials = Request::validate([
            'name' => ['string', 'min:4'],
            'password' => ['string', 'min:4'],
        ]);

        if(!$credentials) return redirect('auth.login', ['error' => 'Username or password is invalid!']);

        if(Auth::attempt($credentials)) return redirect('todo.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('auth.login');
    }
}
