<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="previewModalLabel">Preview Profile</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <img src="{{ $user->candidateDetails && $user->candidateDetails->img_url ? asset('uploads/' . $user->candidateDetails->img_url) : asset('assets/images/users/user-dummy-img.jpg') }}"
                                class="rounded" style="max-width: 150px" alt="candidate_image">
                        </div>
                        <div class="mb-3">
                            <h6>Name</h6>
                            <p>{{ $user->candidateDetails->name ?? '' }}</p>
                        </div>
                        <div class="mb-3">
                            <h6>Email</h6>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <h6>Phone</h6>
                            <p>{{ $user->candidateDetails->phone ?? '' }}</p>
                        </div>
                        <div class="mb-3">
                            <h6>Address</h6>
                            <p>{{ $user->candidateDetails->address ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <h6 class="mt-3">Education History</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Degree</th>
                                <th>Institution</th>
                                <th>Score</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->candidateDetails->educationHistories ?? [] as $educationHistory)
                                <tr>
                                    <td>{{ $educationHistory->degree ?? '' }}</td>
                                    <td>{{ $educationHistory->institution ?? '' }}</td>
                                    <td>{{ $educationHistory->score ?? '' }}</td>
                                    <td>{{ $educationHistory->start_date ?? '' }}</td>
                                    <td>{{ $educationHistory->end_date ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h6 class="mt-3">Work Experience</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->candidateDetails->workExperiences ?? [] as $workExperience)
                                <tr>
                                    <td>{{ $workExperience->job_title ?? '' }}</td>
                                    <td>{{ $workExperience->company ?? '' }}</td>
                                    <td>{{ $workExperience->start_date ?? '' }}</td>
                                    <td>{{ $workExperience->end_date ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h6 class="mt-3">Skills</h6>
                <div class="mb-3">
                    @foreach ($user->candidateDetails->skills ?? [] as $skill)
                        <span class="badge bg-primary fs-12 me-1">{{ ucwords($skill) }}</span>
                    @endforeach
                </div>

                <div class="d-flex gap-5">
                    <div class="mb-3">
                        <h6>Current Salary</h6>
                        <p>{{ $user->candidateDetails->current_salary ?? '' }}</p>
                    </div>

                    <div class="mb-3">
                        <h6>Expected Salary</h6>
                        <p>{{ $user->candidateDetails->expected_salary ?? '' }}</p>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
