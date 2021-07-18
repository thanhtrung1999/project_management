@extends('layouts.master')
@section('title', 'Chi tiết đồ án')
@section('active-student', 'active')
@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h1 style="font-size: 1.5rem" class="card-title">Chi tiết</h1>
                </div>
                <div class="card-body col-md-12">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <td>{{ $project->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên đồ án</th>
                            <td>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th>Tên môn học</th>
                            <th>{{ $project->subject }}</th>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $project->description }}</td>
                        </tr>
                        <tr>
                            <th>Giáo viên hướng dẫn</th>
                            <td>{{ $project->teacher->name }}</td>
                        </tr>
                        <tr>
                            <th>File đồ án</th>
                            <td>
                                @if (!empty($project->documents))
                                    @foreach ($project->documents as $document)
                                        <div class="row mt-2 align-items-center">
                                            <div class="col-8">
                                                <span>{{ $document->name }}</span>
                                            </div>
                                            <div class="col-4">
                                                <form action="{{ route('student.document.delete', ['document' => $document->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa file này không?')">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ngày nộp</th>
                            <td>{{ $project->created_at }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('student.project.edit', ['project' => $project->id]) }}" class="btn btn-warning">Cập
                        nhật</a>
                </div>
            </div>
        </div>
    </div>
@endsection
