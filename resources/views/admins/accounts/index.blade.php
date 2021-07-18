@extends('layouts.master')
@section('custom-css')
    @include('components.css.datatables')
@endsection
@section('active-admin', 'active')
@section('contents')
    @include('components.const')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 style="font-size: 1.5rem" class="card-title">Danh sách tài khoản</h1>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('accounts.create') }}" class="btn btn-primary">Tạo tài khoản</a>
                        </div>
                    </div>
                    <table id="projects-list" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Loại tài khoản</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($accounts))
                                @foreach ($accounts as $account)
                                    @php
                                        $accType = 'Sinh viên';
                                        switch ($account->accountable_type) {
                                            case ACCOUNT_TYPE_ADMIN:
                                                $accType = 'Admin';
                                                break;
                                            case ACCOUNT_TYPE_TEACHER:
                                                $accType = 'Giáo viên';
                                                break;
                                            default:
                                                $accType = 'Sinh viên';
                                                break;
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $account->id }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->accountable->name }}</td>
                                        <td>{{ $account->phone_number }}</td>
                                        <td>{{ $accType }}</td>
                                        <td>{{ $account->created_at }}</td>
                                        <td>{{ $account->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('accounts.show', ['account' => $account->id]) }}" class="btn btn-info">Chi tiết</a>
                                            <a href="{{ route('accounts.edit', ['account' => $account->id]) }}" class="btn btn-warning">Sửa</a>
                                            <a href="{{ route('accounts.destroy', ['account' => $account->id]) }}" class="btn btn-danger">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Loại tài khoản</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
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
