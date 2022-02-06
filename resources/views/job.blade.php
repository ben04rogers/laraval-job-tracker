@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-info mb-2">{{ Session::get('message') }}</p>
        @endif

        <div class="w-100 border-bottom pb-2 d-flex justify-content-between my-4">
            <h3>{{ $job_details->company_name }} - {{ $job_details->job_title }}</h3>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#editJobModal">
               Edit
            </button>
        </div>

        <div class="my-4">
            <p><i class="fas fa-money-bill-alt"></i><span class="fw-bold"> Salary:</span> {{ $job_details->salary }}</p>
            <p><i class="fas fa-calendar-day"></i><span class="fw-bold"> Date Applied:</span> {{ $job_details->date_applied }}</p>
            <p><i class="fas fa-info-circle"></i><span class="fw-bold"> Status:</span> {{ $job_details->status }}</p>        
        </div>
    </div>
@endsection