@props(['job'])
<form class="pt-2 pb-4 d-flex flex-column" action="{{ route("uploadfile", $job->id) }}" method="post" enctype="multipart/form-data">
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
        <input type="submit" value="Upload" class="btn bg-blue-custom text-white mt-4">
    </div>
</form>
