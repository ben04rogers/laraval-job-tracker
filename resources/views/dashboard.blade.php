@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-primary mb-2">{{ Session::get('message') }}</p>
        @endif

        <div class="top-grid my-5">
            <div class="row gx-4">
                <div class="col">
                    <div class="bg-white d-flex flex-column px-4 py-3 rounded count-card count-sent">
                        <h1 class="fw-bold">
                            {{ $sent_jobs }}
                        </h1>
                        <h5 class="text-muted">Sent Applications</h5>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-white d-flex flex-column px-4 py-3 rounded count-card count-interviews">
                        <h1 class="fw-bold">
                            {{ $interviewing_jobs }}
                        </h1>
                        <h5 class="text-muted">Interviewing</h5>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-white d-flex flex-column px-4 py-3 rounded count-card count-offers">
                        <h1 class="fw-bold">
                            {{ $offer_jobs }}
                        </h1>
                        <h5 class="text-muted">Offers</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="current-applications">
            <div class="d-flex justify-content-between my-3">
                <h3><i class="fas fa-briefcase text-success"></i></i><span class="mx-3">Current Applications</span></h3>
                <button type="button" class="btn bg-blue-custom text-white" data-bs-toggle="modal" data-bs-target="#addJobModal">
                    Add Job
                </button>
            </div>

{{--            <table class="table table-striped">--}}
{{--                <thead class="table-blue-custom">--}}
{{--                    <tr>--}}
{{--                    <th scope="col">#</th>--}}
{{--                    <th scope="col">Company</th>--}}
{{--                    <th scope="col">Position Title</th>--}}
{{--                    <th scope="col">Salary</th>--}}
{{--                    <th scope="col">Date Applied</th>--}}
{{--                    <th scope="col">Status</th>--}}
{{--                    <th scope="col"></th>--}}

{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    @foreach ($jobs as $job)--}}
{{--                        @if ($job->status !== "Expired")--}}
{{--                            <tr class="clickable-row" ?>--}}
{{--                                <th scope="row">{{ $job->id }}</th>--}}
{{--                                <td>{{ $job->company_name }}</td>--}}
{{--                                <td>{{ $job->job_title }}</td>--}}
{{--                                <td>${{ number_format($job->salary, 0 , '.' , ',') }}</td>--}}
{{--                                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($job->date_applied))->diffForHumans() }}</td>--}}
{{--                                <td><div class="alert py-0 px-2 m-0 job-status status-{{ Str::lower($job->status) }}">{{ $job->status }}</div></td>--}}
{{--                                <td class="d-flex">--}}
{{--                                    <a href="{{ route("job", $job->id) }}" class="mx-2"><i class="fas fa-eye"></i></a>--}}
{{--                                    <form action="/delete/job/{{$job->id}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}
{{--                                        <button type="submit" class="text-danger job-delete-btn" style="border:none;" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>--}}
{{--                                    </form>--}}
{{--                                </i></td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}

            <div class="jobs-list-container d-flex">
                @foreach ($jobs as $job)
                    @if ($job->status !== "Expired")
                        <x-job-card :job="$job"></x-job-card>
                    @endif
                @endforeach
            </div>
        </div>

        @if ($expired_jobs > 0)
        <div class="expired-applications">
            <div class="d-flex justify-content-between mt-5 mb-3">
                <h3><i class="fas fa-times text-danger"></i><span class="mx-3">Expired Applications</span></h3>
            </div>
            <div class="jobs-list-container d-flex">
                @foreach ($jobs as $job)
                    @if ($job->status === "Expired")
                        <x-job-card :job="$job"></x-job-card>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <x-add-job-modal></x-add-job-modal>
    </div>
@endsection
