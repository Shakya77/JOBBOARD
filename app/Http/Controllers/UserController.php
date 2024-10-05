<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    const jobSeek = 'seeker';
    const jobPoster = 'employer';
    public function createSeeker()
    {
        return view('user.seeker-register');
    }


    public function createEmployer()
    {
        return view('user.emplyer-register');
    }

    public function storeSeeker(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password),
            'user_type' => self::jobSeek
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();
        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage', 'Account Created');
    }

    public function storeEmployer(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password),
            'user_type' => self::jobPoster,
            'user_trial' => now()->addWeek(),
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage', 'Account Created');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('error', 'Credientals dosent match');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
