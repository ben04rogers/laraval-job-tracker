@extends("layouts.app")

@section('content')
    <div>
        <div class="d-flex justify-content-center align-items-center py-5 row">
            <div class="col-5">
                <h2 class="text-center">Register</h2>

                <form action="{{ route("register") }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="my-2">Name</label>
                        <input type="text" name="name" id="name" placeholder="Your name" class="form-control @error('name') border-danger @enderror" value="{{ old('name') }}">

                        @error("name")
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

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
                        <label for="password" class="my-2">Choose a password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') border-danger @enderror">
                        @error("password")
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="my-2">Repeat your password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" class="form-control @error('password_confirmation') border-danger @enderror">
                        @error("password_confirmation")
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn bg-blue-custom text-white w-100">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
