@extends("layouts.app")

@section("content")
    <div class="py-3">
        <h1>{{ $data->file }}</h1>

        <div style="position:relative;padding-top:100%;">
            <iframe src="/assets/{{$data->file}}" frameborder="0" allowfullscreen
              style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
          </div>
    </div>
@endsection