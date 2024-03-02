<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBlogModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this blog?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form id="deleteBlogForm" action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="blog_id" id="blogIdInput">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
