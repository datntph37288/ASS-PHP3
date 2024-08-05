<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function showFormLogin()
    {
        return view('clients.auth.login');
    }
    public function handleLogin()
    {

        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            /**
             * @var User $user
             */
            $user = Auth::user();
            if($user->isAdmin()){
                return redirect()->route('admins.dashboard');
            }
            return redirect()->route('member.dashboard');

        }

        return back()
        ->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])
        ->onlyInput('email');
    }
    public function showFormRegister()
    {
        return view('clients.auth.register');
    }
    public function handleRegister()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::query()->create($data);

        Auth::login($user);

        request()->session()->regenerate();

        return redirect()->route('member.dashboard');
    }
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
