@extends('admin.layouts.app')
@section('title')
Đăng ký nhận bản tin
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Đăng ký nhận bản tin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đăng ký</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="tr-{{ $user->id }}">
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ url('api/admin/newsletters/'.$user->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.modal -->
@endsection

<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');