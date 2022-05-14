<nav class="navbar navbar-expand-md navbar-dark border-bottom shadow-sm bg-white py-0">
    <div class="container">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <a class="navbar-brand py-0" href="{{ route("home") }}">
                <img src="{{url('/assets/images/job-track-logo.svg')}}" class="logo">
            </a>
            <ul class="navbar-nav d-flex">
                <div class="d-flex">
                    <li class="nav-item mx-3 list-unstyled">
                        <a class="nav-link text-black py-3 {{ Request::path() ==  '/' ? 'active' : ''  }}" href="{{ route("home") }}"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item mx-3 list-unstyled">
                        <a class="nav-link text-black py-3 {{ Request::path() ==  'dashboard' ? 'active' : ''  }}" href="{{ route("dashboard") }}"><i class="fas fa-columns"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mx-3 list-unstyled">
                        <a class="nav-link text-black py-3 {{ Request::path() ==  'files' ? 'active' : ''  }}" href="{{ route("files") }}"><i class="fas fa-file-pdf"></i> Files</a>
                    </li>
                    <li class="nav-item mx-3 list-unstyled">
                        <a class="nav-link text-black py-3 {{ Request::path() ==  'calendar' ? 'active' : ''  }}" href="{{ route("calendar") }}"><i class="fas fa-calendar"></i> Calendar</a>
                    </li>
                </div>
            </ul>
            {{-- Only show add button for logged in users --}}
            @auth
                <ul class="my-0">
                    <div class="d-flex">
                        <li class="nav-item list-unstyled">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user mx-1"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <li>
                                        <a href="{{ route("account") }}" class="dropdown-item" type="button"><i class="fas fa-address-card"></i>  Account</a>
                                    </li>

                                    <form action="{{ route("logout") }}" method="post">
                                        @csrf
                                        <li><button type="submit" class="dropdown-item" type="button"><i class="fas fa-sign-out-alt"></i> Logout</button></li>
                                    </form>
                                </ul>
                            </div>
                        </li>
                    </div>
                </ul>
            @endauth


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
