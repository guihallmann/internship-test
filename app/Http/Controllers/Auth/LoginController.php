<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create() {
        return Inertia::render('Auth/Login');
    }

    public function store(LoginUserRequest $request): RedirectResponse
    {
        $userDataValidation = $request->validated();
 
        if (Auth::attempt($userDataValidation)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/person/all');
        }
 
        return back()->withErrors([
            'email' => 'Credenciais incorretas',
        ])->onlyInput('email');
    }

    public function destroy() {
        Auth::logout();
        return redirect()->route('login');
    }
}
