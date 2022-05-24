@extends("layouts.app")

@section('content')
    <div>
        <div class="d-flex justify-content-center align-items-center py-5 row auth-container">
            <div class="auth-form-container border rounded p-4 bg-white">
                @if (session("status"))
                    <div class="alert alert-danger">
                        {{ session("status") }}
                    </div>
                @endif
                <h2 class="text-center mb-4">Account Details</h2>
                    <div class="d-flex align-items-center">
                        <label for="">Name:</label>
                        <input type="text" value="{{  Auth::user()->name }}" class="form-control my-3 mx-3" disabled>
                    </div>

                    <div class="d-flex align-items-center">
                        <label for="">Email:</label>
                        <input type="text" value="{{  Auth::user()->email }}" class="form-control my-3 mx-3" disabled>
                    </div>

            </div>
        </div>
    </div>
@endsection
