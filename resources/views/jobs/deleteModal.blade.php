<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteJobModal" tabindex="-1" aria-labelledby="deleteJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJobModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this job?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="job_id" id="jobIdInput">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
