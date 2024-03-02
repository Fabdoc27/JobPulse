@extends('layout.master')

@section('title')
    <title>Job Pulse | Update Profile</title>
@endsection

@section('sidebar')
    @include('components.leftSidebar')
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('error') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p class="text-center m-0">{{ session('success') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    {{-- owner --}}
    @if ($user->role === 'owner')
        <form action="{{ route('owner.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="preview">
                        <img id="featuredImageDisplay" class="my-3 d-block rounded"
                            src="{{ $user->ownerDetails && $user->ownerDetails->img_url ? asset('uploads/' . $user->ownerDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                            style="max-width: 120px" alt="Preview Image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="img" id="featuredImage">
                        @error('img')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $user->ownerDetails->name ?? '') }}">
                        @error('name')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                        @error('new_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('password_confirmation')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone"
                            value="{{ old('phone', $user->ownerDetails->phone ?? '') }}">
                        @error('phone')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address"
                            value="{{ old('address', $user->ownerDetails->address ?? '') }}">
                        @error('address')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    @endif

    {{-- company --}}
    @if ($user->role === 'company')
        <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="preview">
                        <img id="featuredImageDisplay" class="my-3 d-block rounded"
                            src="{{ $user->companyDetails && $user->companyDetails->img_url ? asset('uploads/' . $user->companyDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                            style="max-width: 120px" alt="Preview Image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company Logo</label>
                        <input type="file" class="form-control" name="img" id="featuredImage">
                        @error('img')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $user->companyDetails->name ?? '') }}">
                        @error('name')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled readonly>
                        @error('email')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                        @error('new_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('password_confirmation')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone"
                            value="{{ old('phone', $user->companyDetails->phone ?? '') }}">
                        @error('phone')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address"
                            value="{{ old('address', $user->companyDetails->address ?? '') }}">
                        @error('address')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    @endif

    {{-- candidate --}}
    @if ($user->role === 'candidate')
        <form action="{{ route('candidate.update') }}" method="POST" enctype="multipart/form-data"
            class="card shadow-lg p-5">
            @csrf

            <div class="d-flex justify-content-between">
                <h3 class="m-3">Basic Info</h3>
                <button type="button" class="btn btn-primary w-auto mt-3 d-inline-block" data-bs-toggle="modal"
                    data-bs-target="#previewModal">Preview Profile</button>
            </div>

            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <div class="preview">
                        <img id="featuredImageDisplay" class="my-3 d-block rounded"
                            src="{{ $user->candidateDetails && $user->candidateDetails->img_url ? asset('uploads/' . $user->candidateDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                            style="max-width: 120px" alt="Preview Image">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="img" id="featuredImage">
                        @error('img')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $user->candidateDetails->name ?? '') }}">
                        @error('name')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled readonly>
                        @error('email')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="new_password">
                        @error('new_password')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                        @error('password_confirmation')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone"
                            value="{{ old('phone', $user->candidateDetails->phone ?? '') }}">
                        @error('phone')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address"
                            value="{{ old('address', $user->candidateDetails->address ?? '') }}">
                        @error('address')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>


            <h3 class="my-5">Education</h3>
            <div id="educationContainer">
                <div class="row d-flex justify-content-center align-items-center">

                    @if ($user->candidateDetails->educationHistories->count() > 0)
                        @foreach ($user->candidateDetails->educationHistories as $educationHistory)
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Degree</label>
                                    <input type="text" class="form-control" name="degree[]"
                                        value="{{ $educationHistory->degree ?? '' }}">
                                    @error('degree')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Institution</label>
                                    <input type="text" class="form-control" name="institution[]"
                                        value="{{ $educationHistory->institution ?? '' }}">
                                    @error('institution')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Score</label>
                                    <input type="text" class="form-control" name="score[]"
                                        value="{{ $educationHistory->score ?? '' }}">
                                    @error('score')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date[]"
                                        value="{{ $educationHistory->start_date ?? '' }}">
                                    @error('start_date')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date[]"
                                        value="{{ $educationHistory->end_date ?? '' }}">
                                    @error('end_date')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Degree</label>
                            <input type="text" class="form-control" name="degree[]">
                            @error('degree')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Institution</label>
                            <input type="text" class="form-control" name="institution[]">
                            @error('institution')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Score</label>
                            <input type="text" class="form-control" name="score[]">
                            @error('score')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date[]">
                            @error('start_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date[]">
                            @error('end_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <button type="button" class="btn btn-primary d-inline-block" onclick="addEducationField()"
                style="max-width: 160px">Add
                Education
            </button>


            <h3 class="my-5">Work Experience</h3>
            <div id="experienceContainer">
                <div class="row d-flex justify-content-center align-items-center">
                    @if ($user->candidateDetails->workExperiences->count() > 0)
                        @foreach ($user->candidateDetails->workExperiences as $workExperience)
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Job Title</label>
                                    <input type="text" class="form-control" name="title[]"
                                        value="{{ $workExperience->job_title ?? '' }}">
                                    @error('title')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" name="company[]"
                                        value="{{ $workExperience->company ?? '' }}">
                                    @error('company')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date[]"
                                        value="{{ $workExperience->start_date ?? '' }}">
                                    @error('start_date')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date[]"
                                        value="{{ $workExperience->end_date ?? '' }}">
                                    @error('end_date')
                                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="title[]">
                            @error('title')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control" name="company[]">
                            @error('company')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date[]">
                            @error('start_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date[]">
                            @error('end_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <button type="button" class="btn btn-primary d-inline-block" onclick="addExperienceField()"
                style="max-width: 160px">Add Experience</button>


            <h3 class="mt-5 mb-3">Skills</h3>
            <div class="row">
                <label class="form-label">Your Skills (add skills by comma )</label>
                <div class="d-flex flex-wrap gap-3" id="skills-container">
                    <div class="mb-3 w-50">
                        <input type="text" name="skills" class="form-control"
                            value="{{ old('skills', $user->candidateDetails->skills ? join(', ', $user->candidateDetails->skills) : '') }}">
                    </div>
                    @error('skills')
                        <p class="text-danger text-center mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <h3 class="mt-5 mb-3">Salary</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Current Salary</label>
                        <input type="number" class="form-control" name="current_salary"
                            value="{{ old('current_salary', $user->candidateDetails->current_salary ?? '') }}">
                        @error('current_salary')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Expected Salary</label>
                        <input type="number" class="form-control" name="expected_salary"
                            value="{{ old('expected_salary', $user->candidateDetails->expected_salary ?? '') }}">
                        @error('expected_salary')
                            <p class="text-danger text-center mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-auto mt-3 ms-3">Update Profile</button>
            </div>
            @include('pages.candidatePreview')
        </form>

    @endif


    <script>
        document.getElementById("featuredImage").addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                document.querySelector("#featuredImageDisplay").src = reader.result;
                featuredImageDisplay.classList.remove("hidden");
            });
            reader.readAsDataURL(this.files[0]);
        });


        function addEducationField() {
            var newRow = document.createElement('div');
            newRow.className = 'row d-flex justify-content-center align-items-center';


            newRow.innerHTML = `
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Degree</label>
                        <input type="text" class="form-control" name="degree[]">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Institution</label>
                        <input type="text" class="form-control" name="institution[]">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Score</label>
                        <input type="text" class="form-control" name="score[]">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date[]">
                    </div>
                </div>
            `;


            document.getElementById('educationContainer').appendChild(newRow);
        }

        function addExperienceField() {
            var newRow = document.createElement('div');
            newRow.className = 'row d-flex justify-content-center align-items-center';


            newRow.innerHTML = `
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="title[]">
                            @error('title')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control" name="company[]">
                            @error('company')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Start Date</label>
                            <input type="date" class="form-control" name="start_date[]">
                            @error('start_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control" name="end_date[]">
                            @error('end_date')
                                <p class="text-danger text-center mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
            `;


            document.getElementById('experienceContainer').appendChild(newRow);
        }
    </script>
@endsection
