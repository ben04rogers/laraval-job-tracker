@extends("layouts.app")

@section("content")
    <div class="row align-items-center py-5">
        <div class="col-md-6">
            <h2 class="mb-4">Oops! Page not found</h2>
            <div class="flex">
                <a href="/" class="btn btn-outline-primary">Take Me Home</a>
                <a href="/" class="btn bg-blue-custom text-white">Go Back</a>
            </div>

        </div>

        <div class="col-md-6">
            <img class="img-fluid" src="/img/404.svg">
        </div>
  </div>
@endsection
