<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class IndexController extends Controller
{
    public function index (){
        return view("index");
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'name'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'email wrong: The provided credentials do not match our records.',
            'name' => 'Name wrong: The provided credentials do not match our records.',
            'password' => 'Password wrong: The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function home()
    {
        return view('home');
    }
}
