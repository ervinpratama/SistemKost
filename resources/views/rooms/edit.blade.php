@extends('layouts.master')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm text-dark"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a>
        </li>
        <li class="breadcrumb-item text-sm text-dark"><a class="opacity-5 text-dark" href="javascript:;">Manajemen
                Kamar</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Kamar</li>
    </ol>
    <h6 class="font-weight-bolder mb-0">Edit Kamar</h6>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Kamar</h5>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="form-label">Nama Kamar <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}" placeholder="eg. Kamar 01"
                                    required onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label>Tipe Kamar</label>
                            <select id="choices-type" name="room_type_id" class="form-control" required>
                                <option selected disabled>Pilih Tipe Kamar</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $room->room_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 mb-4">
                        <div class="col-12">
                            <label for="description" class="form-label">Deskripsi</label>
                            <p class="form-text text-muted text-xs ms-1 d-inline">
                                (optional)
                            </p>
                            <div id="editor-description" class="h-50">
                                {!! $room->description !!}
                            </div>
                            <textarea name="description" id="description" style="display: none"></textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <label for="images" class="form-label">Foto Kamar</label>
                            <div class="form-control dropzone" id="file-dropzone"
                                style="padding: 20px; background-color: #fff"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('rooms.index') }}" class="btn btn-light m-0">Cancel</a>
                        <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/plugins/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/quill.min.js') }}"></script>
    <script>
        if (document.getElementById('editor-description')) {
            var quill = new Quill('#editor-description', {
                theme: 'snow' // Specify theme in configuration
            });
        };

        if (document.getElementById('choices-type')) {
            var tags = document.getElementById('choices-type');
            const examples = new Choices(tags, {
                searchEnabled: true,
                searchPlaceholderValue: 'Search...',
                shouldSort: false,
            });
        };

        Dropzone.options.fileDropzone = {
            url: '{{ route('file.store') }}',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 8,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            removedfile: function (file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('file.remove') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name
                    },
                    success: function (data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function (file, response) {
                console.log(file);
            },
        }

        $("#form").on("submit", function () {
            $("#description").val(quill.container.firstChild.innerHTML);
        });

    </script>
@endpush
