@extends('layouts.master')
@section('title', 'Chỉnh sửa đồ án')
@section('custom-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <!-- the fileinput plugin styling CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('active-student', 'active')
@section('contents')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 style="font-size: 1.5rem" class="card-title">Chỉnh sửa đồ án</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('student.project.update', ['project' => $project->id]) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        @if ($errors->any())
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="alert alert-danger">
                                            <ul class="nav flex-column">
                                                @foreach ($errors->all() as $error)
                                                    <li class="nav-item">{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Tên đồ án</label>
                                <input type="name" class="form-control" name="name" id="name" value="{{ old('name') ?: $project->name }}"
                                    placeholder="Nhập tên đồ án">
                            </div>
                            <div class="form-group">
                                <label for="subject">Tên môn học</label>
                                <input type="subject" class="form-control" name="subject" id="subject"
                                    value="{{ old('subject') ?: $project->subject }}" placeholder="Nhập tên môn học">
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Nhập mô tả">{{ old('description') ?: $project->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="teacher-id">Giáo viên hướng dẫn</label>
                                <select name="teacher_id" id="teacher-id" class="form-control select2" style="width: 100%;">
                                    @if (!empty($teachers))
                                        @foreach ($teachers as $teacher)
                                            <option {{ ($project->teacher_id == $teacher->id ) ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="documents">Thêm file mới</label>
                                <div>
                                    <div class="file-loading">
                                        <input type="file" multiple id="documents" name="documents[]"
                                            data-show-upload="false">
                                        <label class="custom-file-label" for="documents">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- Bootstrap Fileinput -->
    {{-- <script src="{{ asset('js/bootstrap-fileinput/plugins/piexif.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js"
        type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
                        This must be loaded before fileinput.min.js -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js"
        type="text/javascript"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
    {{-- <script src="{{ asset('js/bootstrap-fileinput/fileinput.min.js') }}"></script> --}}
@endsection
@section('my-script')
    <script src="{{ asset('js/project.js') }}"></script>
@endsection
