@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-primary mb-2">{{ Session::get('message') }}</p>
        @endif
        <div class="mt-4 bg-white rounded p-5">
            <div class="row align-items-center">
              <div class="col-md-7">
                <h1>Manage Your Job Applications</h1>
                <p>JobTrack helps you keep track of all your job applications in one place.</p>
                @guest
                <a class="btn bg-blue-custom text-white" href="{{ route("register") }}" role="button">Sign Up</a>
                @endguest

                @auth
                <a class="btn btn-primary" href="{{ route("dashboard") }}" role="button">Dashboard</a>
                @endauth
            </div>

              <div class="col-md-5">
                <img class="img-fluid" src="/img/home.svg">
              </div>
            </div>
        </div>

        <!-- Icons Grid -->
        <section class="features-icons text-center mt-2 py-5">
            <div class="container">
            <div class="row">
                <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-white p-5 rounded border">
                    <i class="fas fa-thumbtack h1"></i>
                    <h3 class="fw-bold">Track Jobs</h3>
                    <p class="lead mb-0">Track job applications and monitor their status</p>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-white p-5 rounded border rounded">
                    <i class="fas fa-file-pdf h1"></i>
                    <h3 class="fw-bold">Store Files</h3>
                    <p class="lead mb-0">Manage resumes, cover letters and other files for each job</p>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="features-icons-item mx-auto mb-0 mb-lg-3 bg-white p-5 rounded border rounded">
                    <i class="fas fa-address-book h1"></i>
                    <h3 class="fw-bold">Add Contacts</h3>
                    <p class="lead mb-0">Add recruiter contact information for each job</p>
                </div>
                </div>
            </div>
            </div>
        </section>
    </div>
@endsection
