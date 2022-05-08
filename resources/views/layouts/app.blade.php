<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="/css/main.css">

    <!-- Font awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    {{--  Toaster.js  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Job Application Tracker</title>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-md navbar-dark border-bottom shadow-sm bg-white">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
          <a class="navbar-brand" href="{{ route("home") }}">
              <img src="{{url('/assets/images/job-track-logo.svg')}}" class="logo">
          </a>
            <ul class="navbar-nav d-flex">
                <div class="d-flex">
                    <li class="nav-item active list-unstyled">
                      <a class="nav-link active text-black" href="{{ route("home") }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item active mx-3 list-unstyled">
                      <a class="nav-link active text-black" href="{{ route("dashboard") }}"><i class="fas fa-columns"></i> Dashboard</a>
                    </li>
                    <li class="nav-item active mx-3 list-unstyled">
                      <a class="nav-link active text-black" href="{{ route("files") }}"><i class="fas fa-file-pdf"></i> Files</a>
                    </li>
                    <li class="nav-item active mx-3 list-unstyled">
                        <a class="nav-link active text-black" href="{{ route("calendar") }}"><i class="fas fa-calendar"></i> Calendar</a>
                    </li>
                </div>
            </ul>
              <ul class="my-0">
              {{-- Only show add button for logged in users --}}
              @auth
              <div class="d-flex">
                  <li class="nav-item list-unstyled">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user mx-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <form action="{{ route("logout") }}" method="post">
                                @csrf
                                <li><button type="submit" class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i> Logout</button></li>
                            </form>
                        </ul>
                      </div>
                  </li>
              </div>
              @endauth
              </ul>


              {{-- Only show links if user is a guest (has not logged in) --}}
              @guest
              <div class="d-flex">
                  <li class="nav-item list-unstyled">
                    <a class="btn border-blue-custom mx-2" href="{{ route("login") }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                  </li>
                  <li class="nav-item list-unstyled">
                    <a class="btn bg-blue-custom text-white" href="{{ route("register") }}"><i class="fas fa-user-plus"></i> Register</a>
                  </li>
              </div>
              @endguest
            </ul>
          </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    {{--  Toaster.js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script src="/js/main.js"></script>
</body>
</html>
