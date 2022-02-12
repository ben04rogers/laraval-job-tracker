@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-primary mb-2">{{ Session::get('message') }}</p>
        @endif

        <div class="top-grid my-5">
            <div class="row gx-4">
                <div class="col">
                    <div class="bg-white border d-flex flex-column align-items-center justify-content-center p-3 rounded">
                        <h5 class="text-muted">Sent Applications</h5>
                        <h1 class="fw-bold">
                            {{ $sent_jobs }}
                        </h1>
                    </div>    
                </div>
                <div class="col">
                    <div class="bg-white border d-flex flex-column align-items-center justify-content-center p-3 rounded">
                        <h5 class="text-muted">Interviewing</h5>
                        <h1 class="fw-bold">
                            {{ $interviewing_jobs }}
                        </h1>
                    </div> 
                </div>
                <div class="col">
                    <div class="bg-white border d-flex flex-column align-items-center justify-content-center p-3 rounded">
                        <h5 class="text-muted">Offers</h5>
                        <h1 class="fw-bold">
                            {{ $offer_jobs }}
                        </h1>
                    </div> 
                </div>
            </div>
        </div>

        <div class="current-applications">
            <div class="d-flex justify-content-between my-3">
                <h3><i class="fas fa-briefcase text-success"></i></i><span class="mx-3">Current Applications</span></h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobModal">
                    Add Job
                </button>
            </div>

            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company</th>
                    <th scope="col">Position Title</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        @if ($job->status !== "Expired")
                            <tr class="clickable-row" ?>
                                <th scope="row">{{ $job->id }}</th>
                                <td>{{ $job->company_name }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td>${{ number_format($job->salary, 0 , '.' , ',') }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($job->date_applied))->diffForHumans() }}</td>
                                <td><div class="alert py-0 px-2 m-0 job-status status-{{ Str::lower($job->status) }}">{{ $job->status }}</div></td>
                                <td class="d-flex">
                                    <a href="{{ route("job", $job->id) }}" class="mx-2"><i class="fas fa-eye"></i></a>
                                    <form action="/delete/job/{{$job->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger job-delete-btn" style="border:none;" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </i></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="current-applications">
            <div class="d-flex justify-content-between mt-5 mb-3">
                <h3><i class="fas fa-times text-danger"></i></i><span class="mx-3">Expired Applications</span></h3>
            </div>

            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Company</th>
                    <th scope="col">Position Title</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        @if ($job->status === "Expired")
                            <tr class="clickable-row" ?>
                                <th scope="row">{{ $job->id }}</th>
                                <td>{{ $job->company_name }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td>${{ $job->salary }}</td>
                                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($job->date_applied))->diffForHumans() }}</td>
                                <td><div class="alert py-0 px-2 m-0 job-status status-{{ Str::lower($job->status) }}">{{ $job->status }}</div></td>
                                <td class="d-flex">
                                    <a href="{{ route("job", $job->id) }}" class="mx-2"><i class="fas fa-eye"></i></a>
                                    <form action="/delete/job/{{$job->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger" style="border:none;" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </i></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add job modal popup -->
        <div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addJobModalLabel">Add a Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route("dashboard") }}" method="POST" class="add-job-form">
                    @csrf
                    <input type="hidden" name="action" value="add_job">
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Company:</label>
                        <input type="text" name="company_name" maxlength="50" placeholder="Company Name" autofocus required>
                    </div>
        
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Position:</label>
                        <input type="text" name="position_title" maxlength="50" placeholder="Position Title"  required>
                    </div>
        
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Salary:</label>
                        <input type="number" name="salary" maxlength="50" placeholder="Salary" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="7" required></textarea>
                    </div>
        
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Post URL:</label>
                        <input type="url" name="post_url" placeholder="https://example.com" required>
                    </div>
        
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Status:</label>
                        <select name="application_status">
                            <option value="Sent" selected>Sent</option>
                            <option value="Interviewing">Interviewing</option>
                            <option value="Offer">Offer</option>
                            <option value="Expired">Expired</option>
                        </select>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection