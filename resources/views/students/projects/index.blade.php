@extends('layouts.master')
@section('title', 'Quản lý bài tập lớn')
@section('custom-css')
    @include('components.css.datatables')
@endsection
@section('active-student', 'active')
@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h1 style="font-size: 1.5rem" class="card-title">Danh sách bài tập lớn</h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('student.projects.form-create') }}" class="btn btn-primary">Tạo đồ án</a>
                        </div>
                    </div>
                    <table id="projects-list" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên đồ án</th>
                                <th>Tên môn học</th>
                                <th>Mô tả</th>
                                <th>Giáo viên hướng dẫn</th>
                                <th>Ngày nộp</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($projects))
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->subject }}</td>
                                        <td>{{ $project->description }}</td>
                                        <td>{{ $project->teacher->name }}</td>
                                        <td>{{ $project->created_at }}</td>
                                        <td>
                                            <a href="{{ route('student.project.detail', ['project' => $project->id]) }}" class="btn btn-info">
                                                Chi tiết
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên đồ án</th>
                                <th>Tên môn học</th>
                                <th>Mô tả</th>
                                <th>Giáo viên hướng dẫn</th>
                                <th>Ngày nộp</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
@section('custom-script')
    @include('components.js.datatables')
@endsection
@section('my-script')
    <script>
        $(function() {
            //   $("#example1").DataTable({
            //     "responsive": true, "lengthChange": false, "autoWidth": false,
            //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#projects-list').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
