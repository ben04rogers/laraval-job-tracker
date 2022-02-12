@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-info mb-2">{{ Session::get('message') }}</p>
        @endif

        {{-- <div>
            <a href="{{ url()->previous() }}" class="text-decoration-none"><i class="fas fa-arrow-circle-left"></i> Back</a>
        </div> --}}

        <div class="border-bottom">
            <div class="w-100 pb-2 d-flex justify-content-between mt-3">
                <h2 class="fw-bold">{{ $job_details->company_name }} - {{ $job_details->job_title }}</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editJobModal">
                   Edit
                </button>
            </div>
    
            <div class="d-flex">
                <p><i class="fas fa-money-bill-alt"></i><span class="text-muted mx-1"> ${{  number_format($job_details->salary, 0 , '.' , ',') }}</span></p>
                <p class="mx-4"><i class="fas fa-calendar-day"></i><span class="text-muted mx-1"> {{ \Carbon\Carbon::createFromTimestamp(strtotime($job_details->date_applied))->diffForHumans() }}</span></p>
                <p><i class="fas fa-info-circle"></i> <span class="text-muted mx-1">{{ $job_details->status }}</span></p>        
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
                </div>
            </div>
        </div>
    </div>
@endsection