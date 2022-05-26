<?php

namespace App\Http\Middleware;

use Core\Auth;

class Authentication
{
    public function Run()
    {
        if (!Auth::check()) return redirect('auth.login');
    }
}
