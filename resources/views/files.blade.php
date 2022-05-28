@extends("layouts.app")

@section("content")
    <div class="py-3">

        <div class="border-bottom">
            <h1>Files</h1>
            <div class="upload-form-wrapper">
                <form class="pt-2 pb-4 d-flex flex-column" action="{{ route("uploadfile") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        @error("file_name")
                        <div class="text-danger mb-2">
                            {{ $message }}
                        </div>
                        @enderror("file_name")
                        <input type="text" name="file_name" placeholder="File name" class="form-control">
                    </div>
                    <div class="image-upload-wrap">
                        <input class="file-upload-input" type='file' name="file" onchange="readURL(this);" accept="image/*,.pdf, .doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                        <div class="drag-text">
                            <h3 class="my-3">Drop your file here, or <span class="text-primary">browse</span></h3>
                            <p class="text-muted">Supports PDF, DOC, DOCX</p>
                        </div>
                      </div>
                      <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="" />
                        <div class="image-title-wrap">
                          <button type="button" onclick="removeUpload()" class="btn btn-danger">Remove <span class="image-title">Uploaded Image</span></button>
                        </div>
                      </div>
                    <div>
                        @error("file")
                            <div class="text-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="submit" value="Upload" class="btn bg-blue-custom mt-4 text-white">

                    </div>
                </form>
            </div>
        </div>

        <div class="all-files py-4">
            @if (!$files->isEmpty())
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">File</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($files as $file)
                        <tr>
                            <td class="">{{ $file->file }}</td>
                            <td class="d-flex justify-content-end">
                                <a class="btn btn-outline-success" href="{{ url("/files/view", $file->id) }}">View</a>
                                <a class="btn btn-outline-primary mx-2" href="{{ url("/files/download", $file->file) }}">Download</a>
                                <form action="/files/delete/{{$file->id}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              @else
              <p>No files have been uploaded.</p>
              @endif
        </div>
    </div>
@endsection
