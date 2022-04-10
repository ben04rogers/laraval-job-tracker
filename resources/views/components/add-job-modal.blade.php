<!-- Add job modal popup -->
<div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-custom">
                <h5 class="modal-title text-white" id="addJobModalLabel">Add a Job</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route("dashboard") }}" method="POST" class="add-job-form">
                    @csrf
                    <input type="hidden" name="action" value="add_job">
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Company:</label>
                        <input class="form-control" type="text" name="company_name" maxlength="50" placeholder="Company Name" autofocus required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Position:</label>
                        <input class="form-control" type="text" name="position_title" maxlength="50" placeholder="Position Title"  required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Salary:</label>
                        <input class="form-control" type="number" name="salary" maxlength="50" placeholder="Salary" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Description:</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="7" required></textarea>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Post URL:</label>
                        <input class="form-control" name="post_url" placeholder="https://example.com" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Status:</label>
                        <select name="application_status" class="form-select">
                            <option value="Sent" selected>Sent</option>
                            <option value="Interviewing">Interviewing</option>
                            <option value="Offer">Offer</option>
                            <option value="Expired">Expired</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn bg-blue-custom text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
