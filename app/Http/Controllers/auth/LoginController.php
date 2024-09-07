<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function ownerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Invalid Login Details');
        }

        $user = auth()->user();

        if ($user->role !== 'owner') {
            auth()->logout();

            return back()->with('error', 'You do not have permission to access this page');
        }

        return redirect()->route('dashboard')->with('success', 'Login Successful');
    }

    public function companyLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Invalid Login Details');
        }

        $user = auth()->user();

        if ($user->role !== 'company') {
            auth()->logout();

            return back()->with('error', 'You do not have permission to access this page');
        }

        return redirect()->route('dashboard')->with('success', 'Login Successful');
    }

    public function candidateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        if (! auth()->attempt($request->only('email', 'password'))) {
            return back()->with('error', 'Invalid Login Details');
        }

        $user = auth()->user();

        if ($user->role !== 'candidate') {
            auth()->logout();

            return back()->with('error', 'You do not have permission to access this page');
        }

        return redirect()->route('homepage')->with('success', 'Login Successful');
    }
}
