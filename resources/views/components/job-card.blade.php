@props(['job'])
<a href="{{ route("job", $job->id) }}" class="job-card text-decoration-none">
    <div class="rounded border bg-white shadow-sm">
        <div class="p-3">
            <div class="d-flex justify-content-between">
                <h4 class="text-dark">{{ $job->company_name }}</h4>
                <p class="alert py-1 px-2 {{ $job->status == "Expired" ? 'alert-danger' : 'alert-success' }}">{{ $job->status }}</p>
            </div>
            <div class="d-flex">
                <p class="text-muted my-1">Position: </p>
                <p class="mx-3 my-1 text-dark">{{ $job->job_title }}</p>
            </div>

            <div class="d-flex">
                <p class="text-muted my-1">Salary: </p>
                <p class="mx-3 my-1 text-dark">${{ number_format($job->salary, 0 , '.' , ',') }}</p>
            </div>

            <div class="d-flex">
                <p class="text-muted my-1">Type: </p>
                <p class="mx-3 my-1 text-dark">{{ $job->contract_type }}</p>
            </div>
        </div>
    </div>
</a>
