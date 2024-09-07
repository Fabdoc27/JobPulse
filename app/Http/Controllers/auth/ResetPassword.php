<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ResetPassword extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $email = $request->input('email');
        $otp = rand(1000, 9999);
        $count = User::where('email', '=', $email)->count();

        if ($count == 1) {
            Mail::to($email)->send(new OtpMail($otp));

            User::where('email', '=', $email)->update(['otp' => $otp]);

            return redirect()->route('verifyOtp', ['email' => $email])->with('success', '4 Digits Otp Code has been Send to your Email.');
        } else {
            return back()->with('error', 'Something Went Wrong.');
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|min:4',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');

        $user = User::where('email', '=', $email)->where('otp', '=', $otp)->first();

        if ($user) {
            $user->update(['otp' => '0']);

            return redirect()->route('newPassword', ['email' => $email])->with('success', 'OTP verification successful.');
        } else {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function newPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|confirmed|min:4',
            ]);

            $email = $request->input('email');
            $password = $request->input('password');

            User::where('email', '=', $email)->update(['password' => Hash::make($password)]);

            if (auth()->attempt($request->only('email', 'password'))) {
                return redirect()->route('dashboard')->with('success', 'Password Reset Successful.');
            } else {
                return back()->with('error', 'Authentication failed. Please try again.');
            }
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
