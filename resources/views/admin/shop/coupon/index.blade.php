@extends('admin.layouts.app')
@section('title')
Mã giảm giá
@endsection
@section('content')
<script src="{{asset('api/admin/coupon.js')}}"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mã giảm giá</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Mã giảm giá</li>
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
                                    <th style="width: 30px">Id</th>
                                    <th>Mã</th>
                                    <th>Loại</th>
                                    <th>Giá trị</th>
                                    <th>% giảm</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr class="tr-{{ $coupon->id }}">
                                    <th scope="row">{{ $coupon->id }}</th>
                                    <td>{{ $coupon->code }}</td>
                                    <td>
                                        <?php echo $coupon->type == 1 ?  "Giảm %" : "Giảm giá" ?>
                                    </td>
                                    <td>{{ number_format($coupon->value) }} VNĐ</td>
                                    <td>{{ $coupon->percent_off }}%</td>
                                    <td>
                                        <a href="{{ url('api/admin/coupons/'.$coupon->id) }}" class="btn btn-primary edit-modal" data-name="{{ $coupon->code }}" data-type="{{ $coupon->type }}" data-value="{{ $coupon->value }}" data-percent="{{ $coupon->percent_off }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/coupons/'.$coupon->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
            <form action="" id="quickForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mã giảm giá</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="name" placeholder="Vui lòng nhập mã">
                    </div>
                    <div class="form-group">
                        <label for="type">Loại</label>
                        <select name="type" class="form-control custom-select" id="type">
                            <option value="1">Percent</option>
                            <option value="2">Price</option>
                        </select>
                    </div>
                    <div class="form-group value" style="display: none">
                        <label for="value">Giảm giá</label>
                        <input type="number" name="value" value="{{ old('value') }}" class="form-control" id="value" placeholder="Giảm theo giá" min="0" required>
                    </div>
                    <div class="form-group percent_off" style="display: none">
                        <label for="percent_off">Giảm %</label>
                        <input type="number" name="percent_off" value="{{ old('percent_off') }}" required class="form-control" id="percent_off" placeholder="Giảm theo %" min="0" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary store-item" href="{{ url('api/admin/coupons') }}">Lưu</button>
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
            <form action="" id="quickFormEdit">
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
                        <input type="text" name="code" value="" class="form-control" id="name" placeholder="Vui lòng nhập mã">
                    </div>
                    <div class="form-group">
                        <label for="type">Loại</label>
                        <select name="type" class="form-control custom-select" id="type">
                            <option value="1">Percent</option>
                            <option value="2">Price</option>
                        </select>
                    </div>
                    <div class="form-group value" style="display: none">
                        <label for="value">Giảm giá</label>
                        <input type="number" name="value" value="" class="form-control" id="value" placeholder="Giảm theo giá" min="0">
                    </div>
                    <div class="form-group percent_off" style="display: none">
                        <label for="percent_off">Giảm %</label>
                        <input type="number" name="percent_off" value="" class="form-control" id="percent_off" placeholder="Giảm theo %" min="0" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}">
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
<script defer src="{{asset('api/admin/common/api.js')}}"></script>
<script defer src="{{asset('api/admin/coupon.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');