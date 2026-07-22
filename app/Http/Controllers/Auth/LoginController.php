<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        return view('pages.auth.login', [
            'loginError' => session('login_error'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
}
