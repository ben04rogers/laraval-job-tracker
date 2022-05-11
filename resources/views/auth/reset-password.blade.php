@extends("layouts.app")

@section('content')
    <div>
        <div class="d-flex justify-content-center align-items-center py-5 row auth-container">
            <div class="col-5 border rounded p-4 bg-white">
                @if (session("status"))
                    <div class="alert alert-danger">
                        {{ session("status") }}
                    </div>
                @endif
                <h2 class="text-center">Reset Password</h2>
                <form action="{{ route("password.update") }}" method="post" class="login-form">
                    @csrf

                    <input type="hidden" value="{{ $token }}" name="token" id="token">

                    <div class="mb-4">
                        <label for="email" class="my-2">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control shadow-sm @error('email') border-danger @enderror" value="{{ old('email') }}">
                        @error("email")
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="my-2">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control shadow-sm @error('password') border-danger @enderror">
                        @error("password")
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="my-2">Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password" class="form-control shadow-sm @error('password') border-danger @enderror">
                        @error("password")
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn bg-blue-custom text-white w-100">Reset Password</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
