<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobCandidate;
use Illuminate\Http\Request;

class ApplicantController extends Controller {

    public function __construct() {
        $this->middleware( 'candidate' )->only( 'apply' );
    }

    public function apply( Request $request ) {
        $request->validate( [
            'job_id' => 'required|exists:jobs,id',
        ] );

        $candidateId = auth()->user()->candidateDetails->id;

        $jobCandidate = JobCandidate::create( [
            'job_id'       => $request->job_id,
            'candidate_id' => $candidateId,
            'status'       => 'applied',
        ] );

        if ( $jobCandidate ) {
            return redirect()->back()->with( 'success', 'Application submitted successfully.' );
        } else {
            return redirect()->back()->with( 'error', 'Failed to submit application.' );
        }
    }

    public function selection( Request $request ) {
        $candidateId = $request->input( 'candidate_id' );
        $jobId       = $request->input( 'job_id' );

        $job = Job::findOrFail( $jobId );

        $jobCandidate = $job->candidates()->where( 'candidate_id', $candidateId )->first();

        if ( !$jobCandidate ) {
            return redirect()->back()->with( 'error', 'Invalid job candidate.' );
        }

        $job->candidates()->updateExistingPivot(
            $candidateId, ['status' => $request->has( 'select' ) ? 'selected' : 'rejected']
        );

        return redirect()->back()->with( 'success', 'Candidate status updated successfully.' );
    }

}