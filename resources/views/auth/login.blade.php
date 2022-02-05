@extends("layouts.app")

@section('content')
    <div>
        <div class="d-flex justify-content-center align-items-center py-5 row">
            @if (session("status"))
                <div class="">
                    {{ session("status") }}
                </div>
            @endif

            <div class="col-5">
                <form action="{{ route("login") }}" method="post" class="login-form">
                    @csrf
    
                    <div class="mb-4">
                        <label for="email" class="my-2">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') border-danger @enderror" value="{{ old('email') }}">
                        @error("email")
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label for="password" class="my-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') border-danger @enderror">
                        @error("password")
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="form-check-label">
                            <label for="remember">Remember me</label>
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection