<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        $jobs = Job::query();
        $jobCategories = ['developer', 'designer', 'digital marketer', 'UI/UX', 'cyber security', 'other'];

        if ($user->role === 'owner') {
            if ($request->has('category')) {
                $jobs->where('category', $request->category);
            }

            if ($request->has('search')) {
                $searchQuery = $request->search;
                $jobs->where('title', 'like', '%'.$searchQuery.'%');
            }

            if ($request->has('sort')) {
                if ($request->sort === 'active') {
                    $jobs->where('status', 'active');
                } elseif ($request->sort === 'inactive') {
                    $jobs->where('status', 'inactive');
                }
            }

            $jobs->latest();
        } elseif ($user->role === 'company') {
            $jobs->where('company_id', $user->companyDetails->id)->latest();
        } elseif ($user->role === 'candidate') {
            $jobs = $user->candidateDetails->jobs()->withPivot('status')->latest();
        }

        $jobs = $jobs->paginate(5);

        return view('jobs.index', compact('jobs', 'user', 'jobCategories'));
    }

    public function create(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        $jobCategories = ['developer', 'designer', 'digital marketer', 'UI/UX', 'cyber security', 'other'];

        return view('jobs.create', compact('user', 'jobCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'skills' => 'required|string',
            'salary' => 'required|numeric',
            'deadline' => 'required|date',
            'company_id' => 'required|exists:company_details,id',
        ]);

        $skillsString = trim($request->input('skills'));
        $skillsArray = array_map('trim', explode(',', $skillsString));

        Job::create([
            'company_id' => $request->input('company_id'),
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'skills' => $skillsArray,
            'salary' => $request->input('salary'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $job = Job::findOrFail($id);
        $jobCategories = ['developer', 'designer', 'digital marketer', 'UI/UX', 'cyber security', 'other'];

        return view('jobs.edit', compact('user', 'job', 'jobCategories'));
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $job = Job::findOrFail($id);

        return view('jobs.show', compact('user', 'job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'skills' => 'nullable|string',
            'salary' => 'nullable|numeric',
            'deadline' => 'nullable|date',
            'company_id' => 'nullable|exists:company_details,id',
        ]);

        $job = Job::findOrFail($id);

        if ($request->has('skills') && ! empty($request->input('skills'))) {
            $skillsString = trim($request->input('skills'));
            $skillsArray = array_map('trim', explode(',', $skillsString));
        } else {
            $skillsArray = $job->skills;
        }

        $job->update([
            'company_id' => $request->input('company_id'),
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'skills' => $skillsArray,
            'salary' => $request->input('salary'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'status' => 'required|string',
        ]);

        $jobId = $request->input('job_id');
        $status = $request->input('status');

        $job = Job::findOrFail($jobId);
        $job->update([
            'status' => $status,
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job status updated successfully.');
    }

    public function destroy(Request $request)
    {
        $jobId = $request->input('job_id');
        $job = Job::findOrFail($jobId);
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function showApplicants(Request $request, $id)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);
        $job = Job::findOrFail($id);
        $applicants = $job->candidates()->withPivot('status')->paginate(5);

        return view('jobs.applicants', compact('job', 'applicants', 'user'));
    }
}
