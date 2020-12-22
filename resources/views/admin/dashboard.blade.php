@extends('admin.layouts.app')
@section('title')
Admin
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Trang chủ</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item active">Thống kê</li>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="form-group col-sm-2">
        <label>Ngày bắt đầu:</label>
        <div class="input-group date" id="startDate" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input" data-target="#startDate" />
          <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group col-sm-2">
        <label>Ngày kết thúc:</label>
        <div class="input-group date" id="endDate" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input" data-target="#endDate" />
          <div class="input-group-append" data-target="#endDate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group col-sm-2">
        <label>Khoảng thời gian : </label>
        <select class="form-control">
          <option>Ngày</option>
          <option>Tuần</option>
          <option>Tháng</option>
          <option>Năm</option>
        </select>
      </div>
      <div class="form-group col-sm-2">
        <label style="display:none">Tìm kiếm</label>
        <div class="input-group">
          <button type="submit" class="btn btn-info">Sign in</button>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-info">
          <span class="info-box-icon"><i class="fas fa-funnel-dollar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Doanh thu</span>
            <span class="info-box-number total-revenue"></span>

            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description progress-revenue">
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-success">
          <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Đơn hàng</span>
            <span class="info-box-number total-order"></span>

            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description progress-order">
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-warning">
          <span class="info-box-icon"><i class="fas fa-shopping-bag" style="color: #fff;"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Sản phẩm đã bán</span>
            <span class="info-box-number total-product"></span>

            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description progress-product">
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-danger">
          <span class="info-box-icon"><i class="ion ion-person-add"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Đăng ký mới</span>
            <span class="info-box-number total-user"></span>

            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description progress-user">
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection
@include('admin.partials.index-jquery');
@section('footer-content')
<script defer src="{{asset('api/admin/index.js')}}"></script>
@endsection