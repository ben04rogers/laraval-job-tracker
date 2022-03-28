@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-info mb-2">{{ Session::get('message') }}</p>
        @endif

        <div class="border-bottom">
            <div class="w-100 pb-2 d-flex justify-content-between mt-3">
                <h2 class="fw-bold">{{ $job_details->company_name }} - {{ $job_details->job_title }}</h2>
                <button type="button" class="btn bg-blue-custom text-white" data-bs-toggle="modal" data-bs-target="#editJobModal">
                   Edit
                </button>
            </div>

            <div class="d-flex">
                <p><i class="fas fa-money-bill-alt"></i><span class="text-muted mx-1"> ${{  number_format($job_details->salary, 0 , '.' , ',') }}</span></p>
                <p class="mx-4"><i class="fas fa-calendar-day"></i><span class="text-muted mx-1"> {{ \Carbon\Carbon::createFromTimestamp(strtotime($job_details->date_applied))->diffForHumans() }}</span></p>
                <p><i class="fas fa-info-circle"></i> <span class="text-muted mx-1">{{ $job_details->status }}</span></p>
                <p class="mx-4"><i class="fa fa-briefcase"></i> <span class="text-muted mx-1">{{ $job_details->contract_type }}</span></p>
                <a href="{{ $job_details->post_url }}" target="_blank" class="text-decoration-none">
                    <p><i class="fas fa-link text-primary"></i> <span class="mx-1">View Post</span></p>
                </a>
            </div>
        </div>

        <div class="my-4">
            <div class="row">
                <div class="col-6">
                    <h3>Job Description</h3>
                    <div class="p-4 bg-white rounded description-output">
                        @if(empty($job_details->description))
                            <p class="m-0">No description added</p>
                        @else
                            <p class="text-left job-description">
                                {{ $job_details->description }}
                            </p>
                        @endif
                    </div>

                    <h3 class="mt-5">Check List</h3>
                    @foreach ($todos as $todo)
                    <form action="{{ route("updatetodo") }}" method="POST" class="d-flex flex-column">
                        @csrf
                        @method('put')
                            <div>
                                <input type="checkbox" value="{{$todo->description}}" onchange="this.form.submit()" {{ $todo->completed ? 'checked' : ''}}> {{$todo->description}}
                                <input type="hidden" name="todo_id" value="{{$todo->id}}">
                            </div>
                    </form>
                    @endforeach

                    <form action="{{ route("addtodo", $job_id) }}" method="POST">
                        @csrf
                        <div class="input-group my-3">
                            <input type="text" class="form-control" placeholder="Add a task..." name="todo_description">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary rounded" type="submit">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-6">
                    <h1>Files</h1>
                    <div class="upload-form-wrapper">
                        <form class="pt-2 pb-4 d-flex flex-column" action="{{ route("uploadfile", $job_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div>
                                @error("file_name")
                                    <div class="text-danger mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror("file_name")
                                <input type="text" name="file_name" placeholder="File name" class="form-control">
                            </div>
                            <div class="image-upload-wrap">
                                <input class="file-upload-input" type='file' name="file" onchange="readURL(this);" accept="image/*,.pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                <div class="drag-text">
                                <h3>Add a file</h3>
                                </div>
                            </div>
                            <div class="file-upload-content">
                                <img class="file-upload-image" src="#" alt="" />
                                <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="btn btn-danger">Remove <span class="image-title">Uploaded Image</span></button>
                                </div>
                            </div>
                            <div>
                                @error("file")
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="submit" value="Upload" class="btn bg-blue-custom text-white mt-4">
                            </div>
                        </form>
                    </div>
                    <div class="all-files py-4">
                        @if (!$files->isEmpty())
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">File</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $file)
                                    <tr>
                                        <td class="">{{ $file->file }}</td>
                                        <td class="d-flex justify-content-end">
                                            <a class="btn btn-outline-success mx-2" href="{{ url("/files/view", $file->id) }}">View</a>
                                            <a class="btn btn-outline-primary" href="{{ url("/files/download", $file->file) }}">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          @else
                          <p>No files have been uploaded.</p>
                          @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit job modal popup -->
        <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-blue-custom">
                <h5 class="modal-title text-white" id="editJobModalLabel">Edit Job Details</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route("updatejob", $job_details->id) }}" method="POST" class="add-job-form">
                    @csrf
                    @method('put')

                    <input type="hidden" name="action" value="add_job">
                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Company:</label>
                        <input type="text" name="company_name" maxlength="50" placeholder="Company Name" value="{{ $job_details->company_name }}" autofocus required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Position:</label>
                        <input type="text" name="position_title" maxlength="50" placeholder="Position Title" value="{{ $job_details->job_title }}" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Salary:</label>
                        <input type="number" name="salary" maxlength="50" placeholder="Salary" value="{{ $job_details->salary }}" required>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="7" required>{{ $job_details->description }}</textarea>
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label class="mb-1">Post URL:</label>
                        <input type="url" name="post_url" placeholder="https://example.com" value="{{ $job_details->post_url }}" required>
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
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
