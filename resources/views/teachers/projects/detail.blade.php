@extends('layouts.master')
@section('title', 'Chi tiết đồ án')
@section('active-teacher', 'active')
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
                            <th>Tên sinh viên</th>
                            <td>{{ $project->student->name }}</td>
                        </tr>
                        <tr>
                            <th>Tên đồ án</th>
                            <td>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th>Tên môn học</th>
                            <td>{{ $project->subject }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $project->description }}</td>
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
                                                <a href="{{ route('teacher.document.download', ['document' => $document->id]) }}" class="btn btn-primary">Download</a>
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
            </div>
        </div>
    </div>
@endsection
