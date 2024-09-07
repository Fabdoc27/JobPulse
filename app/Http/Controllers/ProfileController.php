<?php

namespace App\Http\Controllers;

use App\Models\CandidateDetail;
use App\Models\CompanyDetail;
use App\Models\EducationHistory;
use App\Models\OwnerDetail;
use App\Models\User;
use App\Models\WorkExperience;
use App\Rules\MatchCurrentPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function userProfile(Request $request)
    {
        $userId = $request->user()->id;
        $user = User::findOrFail($userId);

        return view('pages.profileDetails', compact('user'));
    }

    public function ownerProfileUpdate(Request $request)
    {
        $userId = $request->user_id;

        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'current_password' => ['nullable', new MatchCurrentPassword],
            'new_password' => ['nullable', 'min:4'],
            'confirm_password' => ['nullable', 'same:new_password'],
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $user = User::find($userId);
            $oldEmail = $user->email;

            $user->update([
                'email' => $request->filled('email') ? $request->email : $user->email,
                'password' => $request->filled('new_password') ? Hash::make($request->new_password) : $user->password,
            ]);

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $fileNameToStore = 'owner-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();

                $oldFilePath = $user->ownerDetails->img_url ?? null;

                if ($oldFilePath && File::exists(public_path('uploads/'.$oldFilePath))) {
                    File::delete(public_path('uploads/'.$oldFilePath));
                }

                $image->move(public_path('uploads'), $fileNameToStore);

                OwnerDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'img_url' => $fileNameToStore ?? null,
                    ]
                );
            } else {
                OwnerDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                    ]
                );
            }

            // for receiving email from visitors
            if ($oldEmail !== $user->email) {
                $envFilePath = base_path('.env');
                $envContents = file_get_contents($envFilePath);

                $envContents = preg_replace(
                    '/^OWNER_EMAIL=(.*)/m',
                    'OWNER_EMAIL='.$user->email,
                    $envContents
                );

                file_put_contents($envFilePath, $envContents);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update profile');
        }
    }

    public function companyProfileUpdate(Request $request)
    {
        $userId = $request->user_id;

        $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'current_password' => ['nullable', new MatchCurrentPassword],
            'new_password' => ['nullable', 'min:4'],
            'confirm_password' => ['nullable', 'same:new_password'],
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $user = User::find($userId);

            $user->update([
                'password' => $request->filled('new_password') ? Hash::make($request->new_password) : $user->password,
            ]);

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $fileNameToStore = 'company-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();

                $oldFilePath = $user->companyDetails->img_url ?? null;

                if ($oldFilePath && File::exists(public_path('uploads/'.$oldFilePath))) {
                    File::delete(public_path('uploads/'.$oldFilePath));
                }

                $image->move(public_path('uploads'), $fileNameToStore);

                CompanyDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'img_url' => $fileNameToStore ?? null,
                    ]
                );
            } else {
                CompanyDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                    ]
                );
            }

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update profile');
        }
    }

    public function candidateProfileUpdate(Request $request)
    {
        $userId = $request->user()->id;

        $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'current_password' => ['nullable', new MatchCurrentPassword],
            'new_password' => ['nullable', 'min:4'],
            'confirm_password' => ['nullable', 'same:new_password'],
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'degree.*' => 'nullable|string',
            'institution.*' => 'nullable|string',
            'score.*' => 'nullable|string',
            'start_date.*' => 'nullable|date',
            'end_date.*' => 'nullable|date',
            'work_start_date.*' => 'nullable|date',
            'work_end_date.*' => 'nullable|date',
            'title.*' => 'nullable|string',
            'company.*' => 'nullable|string',
            'skills' => 'nullable|string',
            'current_salary' => 'nullable|numeric',
            'expected_salary' => 'nullable|numeric',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($userId);

            $user->update([
                'password' => $request->filled('new_password') ? Hash::make($request->new_password) : $user->password,
            ]);

            $skillsString = trim($request->input('skills'));
            $skillsArray = array_map('trim', explode(',', $skillsString));

            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $fileNameToStore = 'candidate-'.md5(uniqid()).time().'.'.$image->getClientOriginalExtension();

                $oldFilePath = $user->candidateDetails->img_url ?? null;

                if ($oldFilePath && File::exists(public_path('uploads/'.$oldFilePath))) {
                    File::delete(public_path('uploads/'.$oldFilePath));
                }

                $image->move(public_path('uploads'), $fileNameToStore);

                CandidateDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'img_url' => $fileNameToStore ?? null,
                        'skills' => $skillsArray,
                        'current_salary' => $request->current_salary,
                        'expected_salary' => $request->expected_salary,
                    ]
                );
            } else {
                CandidateDetail::updateOrCreate(
                    ['user_id' => $userId],
                    [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'skills' => $skillsArray,
                        'current_salary' => $request->current_salary,
                        'expected_salary' => $request->expected_salary,
                    ]
                );
            }

            // education
            $this->educationHistories($request, $user);

            // work experience
            $this->workExperiences($request, $user);

            DB::commit();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function educationHistories($request, $user)
    {
        if ($request->filled('degree')) {
            foreach ($request->degree as $key => $degree) {
                if (! empty($degree)) {
                    $educationId = $request->education_id[$key] ?? null;
                    EducationHistory::updateOrCreate(
                        ['id' => $educationId],
                        [
                            'candidate_id' => $user->candidateDetails->id,
                            'degree' => $degree,
                            'institution' => $request->institution[$key] ?? null,
                            'score' => $request->score[$key] ?? null,
                            'start_date' => $request->start_date[$key] ?? null,
                            'end_date' => $request->end_date[$key] ?? null,
                        ]
                    );
                } else {
                    $educationId = $request->education_id[$key] ?? null;
                    if ($educationId) {
                        EducationHistory::find($educationId)->delete();
                    }
                }
            }
        }
    }

    private function workExperiences($request, $user)
    {
        if ($request->filled('title')) {
            foreach ($request->title as $key => $title) {
                $workExperienceId = $request->work_experience_id[$key] ?? null;
                if (! empty($title)) {
                    WorkExperience::updateOrCreate(
                        ['id' => $workExperienceId],
                        [
                            'candidate_id' => $user->candidateDetails->id,
                            'job_title' => $title,
                            'company' => $request->company[$key],
                            'start_date' => $request->work_start_date[$key],
                            'end_date' => $request->work_end_date[$key],
                        ]
                    );
                } elseif ($workExperienceId) {
                    WorkExperience::find($workExperienceId)->delete();
                }
            }
        }
    }
}
