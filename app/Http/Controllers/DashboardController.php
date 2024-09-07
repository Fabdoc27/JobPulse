<?php

namespace App\Http\Controllers;

use App\Models\CandidateDetail;
use App\Models\CompanyDetail;
use App\Models\Job;
use App\Models\Plugin;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data = [];

        if ($user->role === 'owner') {
            $data['activeCompanies'] = CompanyDetail::where('status', 'active')->count();
            $data['inactiveCompanies'] = CompanyDetail::where('status', 'inactive')->count();
            $data['totalJobs'] = Job::count();
            $data['plugins'] = Plugin::all();
        } elseif ($user->role === 'company') {
            $companyId = $user->companyDetails->id;
            $data['jobsPosted'] = Job::where('company_id', $companyId)->count();
            $data['plugins'] = Plugin::all();
        } elseif ($user->role === 'candidate') {
            $candidate = CandidateDetail::where('user_id', $user->id)->first();

            if ($candidate) {
                $data['jobsApplied'] = $candidate->jobs()->count();
            } else {
                $data['jobsApplied'] = 0;
            }
        }

        return view('pages.dashboard', compact('user', 'data'));
    }
}
