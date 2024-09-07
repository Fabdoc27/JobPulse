<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function companyRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'company',
            ]);

            $user->companyDetails()->create([
                'email' => $request->input('email'),
                'status' => 'inactive',
            ]);

            DB::commit();

            auth()->login($user);

            return redirect('dashboard')->with('success', 'Registration Successful');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Failed to register');
        }
    }

    public function candidateRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => 'candidate',
            ]);

            $candidateDetail = $user->candidateDetails()->create([
                'email' => $request->input('email'),
            ]);

            $candidateDetailId = $candidateDetail->id;

            $candidateDetail->educationHistories()->create([
                'candidate_id' => $candidateDetailId,
            ]);

            $candidateDetail->workExperiences()->create([
                'candidate_id' => $candidateDetailId,
            ]);

            DB::commit();

            auth()->login($user);

            return redirect('dashboard')->with('success', 'Registration Successful');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Failed to register');
        }
    }
}
