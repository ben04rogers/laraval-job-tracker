@extends("layouts.app")

@section("content")
    <div class="py-3">
        <h1>Documents</h1>
        <p>No documents have been uploaded</p>
        <form action="{{ route("files") }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <input type="submit" value="Submit">
        </form>
    </div>
@endsection