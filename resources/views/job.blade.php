@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
            <script>
                $(document).ready(function () {
                    toastr.success(`{!! Session::get('message') !!}`);
                });
            </script>
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
                            <div class="d-flex p-2 bg-white my-1 rounded">
                                <input type="checkbox" value="{{$todo->description}}" onchange="this.form.submit()" {{ $todo->completed ? 'checked' : ''}}>
                                <p class="my-0 mx-2 {{ $todo->completed ? 'text-decoration-line-through' : '' }}">{{$todo->description}}</p>
                                <input type="hidden" name="todo_id" value="{{$todo->id}}">
                            </div>
                    </form>
                    @endforeach

                    <form action="{{ route("addtodo", $job_id) }}" method="POST">
                        @csrf
                        <div class="input-group my-3">
                            <input type="text" class="form-control" placeholder="Add a task..." name="todo_description">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary rounded add-task-button" type="submit">Add</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-6">
                    <h2>File</h2>
                    <div class="upload-form-wrapper">
                        <x-file-upload :job="$job_details"></x-file-upload>
                    </div>
                    <x-files-list :files="$files"></x-files-list>
                </div>
            </div>
        </div>

        <x-edit-job-modal :job="$job_details"></x-edit-job-modal>
    </div>
@endsection
