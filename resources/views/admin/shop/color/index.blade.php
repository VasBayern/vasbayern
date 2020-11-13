@extends('admin.layouts.app')
@section('title')
Màu sắc
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Màu sắc</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Màu sắc</li>
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
                        <div class="col-lg-1">
                            <button type="button" class="btn btn-primary add-modal" data-toggle="modal" data-target="#modal-default-add">
                                Thêm
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tên</th>
                                    <th>Mã màu</th>
                                    <th>Màu</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $color)
                                <tr class="tr-{{ $color->id }}">
                                    <th scope="row">{{ $color->id }}</th>
                                    <td class="th-name">{{ $color->name }}</td>
                                    <td class="th-color">{{ $color->color }}</td>
                                    <td>
                                        <p class="th-bg-color" style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:{{ $color->color }}"></p>
                                    </td>
                                    <td>
                                        <a href="{{ url('api/admin/colors/'.$color->id) }}" class="btn btn-primary edit-modal" data-name="{{ $color->name }}" data-color="{{ $color->color }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/colors/'.$color->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
<!-- Modal Add -->
<div class="modal fade" id="modal-default-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm màu </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="color">Mã màu</label>
                        <input type="text" name="color" value="{{ old('color') }}" class="form-control" id="color" placeholder="Vui lòng nhập màu" maxlength="7">
                    </div>
                    <div class="form-group">
                        <label for="color">Màu</label>
                        <p style="width: 80px; height: 50px;  position:relative">
                            <span id="bg-color" style="width: 30px; height: 30px; position:absolute; top: 8px; left: 20px; border:1px solid #ebebeb;"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary store-item" href="{{ url('api/admin/colors') }}">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal Edit -->
<div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data" id="quickFormEdit">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="color">Mã Màu</label>
                        <input type="text" name="color" value="" class="form-control" id="color" placeholder="Vui lòng nhập màu" maxlength="7">
                    </div>
                    <div class="form-group">
                        <label for="color">Màu</label>
                        <p style="width: 80px; height: 50px;  position:relative">
                            <span id="bg-color" style="width: 30px; height: 30px; position:absolute; top: 8px; left: 20px; border:1px solid #ebebeb;"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary update-item">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/color.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');
