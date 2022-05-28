@props(['files'])
<div class="all-files py-4">
    @if (!$files->isEmpty())
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Files</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
                <tr>
                    <td class="">{{ $file->file }}</td>
                    <td class="d-flex justify-content-end">
                        <a class="btn btn-outline-success mx-2" href="{{ url("/files/view", $file->id) }}">View</a>
                        <a class="btn btn-outline-primary" href="{{ url("/files/download", $file->file) }}">Download</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No files have been uploaded.</p>
    @endif
</div>
