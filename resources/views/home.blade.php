@extends("layouts.app")

@section("content")
    <div class="py-3">
        @if(Session::has('message'))
        <p class="alert alert-info mb-2">{{ Session::get('message') }}</p>
        @endif
        <div class="container mt-4 bg-light rounded p-5" style="">
            <div class="row align-items-center">
              <div class="col-md-7">
                <h1>Manage Your Job Applications</h1>
                <p>JobTrack helps you keep track of all your job applications in one place.</p>
                <a class="btn btn-primary" href="{{ route("register") }}" role="button">Sign Up</a>
              </div>
          
              <div class="col-md-5">
                <img class="img-fluid" src="/img/home.svg">
              </div>
            </div>
          </div>
    </div>
@endsection