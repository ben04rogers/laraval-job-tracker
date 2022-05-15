@props(['job'])
<div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-custom">
                <h5 class="modal-title text-white" id="editJobModalLabel">Edit Job Details</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route("updatejob", $job->id) }}" method="POST" class="add-job-form">
                    @csrf
                    @method('put')

                    <input type="hidden" name="action" value="add_job">
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Company:</label>
                        <input class="form-control" type="text" name="company_name" maxlength="50" placeholder="Company Name" value="{{ $job->company_name }}" autofocus required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Position:</label>
                        <input class="form-control" type="text" name="position_title" maxlength="50" placeholder="Position Title" value="{{ $job->job_title }}" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Salary:</label>
                        <input class="form-control" type="number" name="salary" maxlength="50" placeholder="Salary" value="{{ $job->salary }}" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Description:</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="7" required>{{ $job->description }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Post URL:</label>
                        <input class="form-control" type="url" name="post_url" placeholder="https://example.com" value="{{ $job->post_url }}" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Status:</label>
                        <select name="application_status" class="form-select">
                            <option value="Sent" {{ ($job->status) == 'Sent' ? 'selected' : '' }}>Sent</option>
                            <option value="Interviewing" {{ ($job->status) == 'Interviewing' ? 'selected' : '' }}>Interviewing</option>
                            <option value="Offer" {{ ($job->status) == 'Offer' ? 'selected' : '' }}>Offer</option>
                            <option value="Expired" {{ ($job->status) == 'Expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn bg-blue-custom text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
