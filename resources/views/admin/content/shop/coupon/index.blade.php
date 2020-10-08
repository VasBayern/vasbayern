@extends('admin.layouts.app')
@section('title')
Mã giảm giá
@endsection

@section('content')

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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
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
                                    <th>Mã</th>
                                    <th>Loại</th>
                                    <th>Giá trị</th>
                                    <th>% giảm</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($coupons as $coupon)
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->type }}</td>
                                <td>{{ number_format($coupon->value) }} VNĐ</td>
                                <td>{{ $coupon->percent_off }}%</td>
                                <td>
                                    <a href="#myModal" class="btn btn-primary" title="Sửa" data-toggle="modal" data-target="#modal-default-{{ $coupon->id }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#myModal{{$coupon->id}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                </tr>
                                <?php $stt++; ?>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/coupon') }}" method="post" enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mã giảm giá</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul style="margin-bottom:0px">
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="form-control" id="name" placeholder="Vui lòng nhập mã">
                    </div>
                    <div class="form-group">
                        <label for="type">Loại</label>
                        <select name="type" class="form-control" id="type">
                            <option value="percent">Percent</option>
                            <option value="price">Price</option>
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
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal Edit -->
@foreach($coupons as $coupon)
<div class="modal fade" id="modal-default-{{ $coupon->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/coupon/'.$coupon->id) }}" method="post" enctype="multipart/form-data" id="quickForm">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sửa mã : {{ $coupon->code }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul style="margin-bottom:0px">
                                @foreach ($errors->all() as $error)
                                <li style="list-style: none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="code" value="{{ $coupon->code }}" class="form-control" id="name" placeholder="Vui lòng nhập mã">
                    </div>
                    <div class="form-group">
                        <label for="type">Loại</label>
                        <select name="type" class="form-control custom-select" id="type">
                            <option value="percent" <?php echo ($coupon->type == 'percent') ? 'selected' : '' ?>>Percent</option>
                            <option value="price" <?php echo ($coupon->type == 'price') ? 'selected' : '' ?>>Price</option>
                        </select>
                    </div>
                    <div class="form-group value" style="display: none">
                        <label for="value">Giảm giá</label>
                        <input type="number" name="value" value="{{ $coupon->value }}" class="form-control" id="value" placeholder="Giảm theo giá" min="0">
                    </div>
                    <div class="form-group percent_off" style="display: none">
                        <label for="percent_off">Giảm %</label>
                        <input type="number" name="percent_off" value="{{ $coupon->percent_off }}" class="form-control" id="percent_off" placeholder="Giảm theo %" min="0" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Delete -->
<div id="myModal{{$coupon->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-exclamation"></i>
                </div>
                <h4 class="modal-title w-100">Bạn có muốn xóa?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Lưu ý : Hành động này không thể hoàn tác</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form name="brand" action="{{ url('admin/coupon/'.$coupon->id) }}" method="post" class="form-horizontal">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

<!-- Jquery -->
@include('admin.partials.index-jquery');
<script>
    $(document).ready(function() {
        var value = $('#type').val();
        if (value == 'percent') {
            $('.percent_off').show();
            $('.value').hide();
        } else if (value == 'price') {
            $('.value').show();
            $('.percent_off').hide();
        };
        $('#type').on('change', function() {
            var value = $(this).val();
            if (value == 'percent') {
                $('.percent_off').show();
                $('.value').hide();
                $('#value').val(0);
            } else if (value == 'price') {
                $('.value').show();
                $('.percent_off').hide();
                $('#percent_off').val(0);
            };
        })
    })
</script>