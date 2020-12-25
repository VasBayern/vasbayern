@extends('admin.layouts.app')
@section('title')
Admin
@endsection
@section('content')
<style>
  .tab-pane {
    min-height: 250px;
    height: 400px;
    max-height: 400px;
    width: 100%;
  }

  .table-chart {
    min-height: 250px;
    height: 400px;
    max-height: 400px;
    width: 100%;
  }

  .tab-content.hidden {
    display: none;
  }
</style>
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
          <input type="text" class="form-control datetimepicker-input start-date" data-target="#startDate" />
          <div class="input-group-append" data-target="#startDate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
      <div class="form-group col-sm-2">
        <label>Ngày kết thúc:</label>
        <div class="input-group date" id="endDate" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input end-date" data-target="#endDate" />
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
        <div class="input-group">
          <button type="submit" class="btn btn-danger filterChart" style="margin-top:30px">Tìm kiếm</button>
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

    <!-- Chart -->
    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Biểu đồ doanh thu</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="areaChart" style="min-height: 250px; height: 400px; max-height: 400px; width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-category-tab" data-name="category" data-toggle="pill" href="#custom-tabs-four-category" role="tab" aria-controls="custom-tabs-four-category" aria-selected="true">Danh mục</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-product-tab" data-name="product" data-toggle="pill" href="#custom-tabs-four-product" role="tab" aria-controls="custom-tabs-four-product" aria-selected="false">Sản phẩm</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-customer-tab" data-name="customer" data-toggle="pill" href="#custom-tabs-four-customer" role="tab" aria-controls="custom-tabs-four-customer" aria-selected="false">Khách mua nhiều</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-settings-tab" data-name="" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-four-category" role="tabpanel" aria-labelledby="custom-tabs-four-category-tab">
                <div class="card-body table-responsive p-0 table-chart">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Danh mục</th>
                        <th>Số lượng bán</th>
                        <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody class="bodyCategory">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-four-product" role="tabpanel" aria-labelledby="custom-tabs-four-product-tab">
                <div class="card-body table-responsive p-0 table-chart">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng bán</th>
                        <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody class="bodyProduct">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-four-customer" role="tabpanel" aria-labelledby="custom-tabs-four-customer-tab">
                <div class="card-body table-responsive p-0 table-chart">
                  <table class="table table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Khách hàng</th>
                        <th>Email</th>
                        <th>Số sản phẩm</th>
                        <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    <tbody class="bodyCustomer">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <!-- PIE CHART -->
        <div class="card chart-card">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-revenue-tab" data-toggle="pill" href="#custom-tabs-two-revenue" role="tab" aria-controls="custom-tabs-two-revenue" aria-selected="true">Doanh thu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-two-count-tab" data-toggle="pill" href="#custom-tabs-two-count" role="tab" aria-controls="custom-tabs-two-count" aria-selected="false">Số lượng</a>
              </li>
            </ul>
          </div>
          <div class="card-body pie-card">
            <div class="tab-content" id="custom-tabs-two-category">
              <div class="tab-pane fade show active" id="custom-tabs-two-revenue" role="tabpanel" aria-labelledby="custom-tabs-two-revenue-tab">
                <canvas id="pieRevenueCategoryChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-count" role="tabpanel" aria-labelledby="custom-tabs-two-count-tab">
                <canvas id="pieCountCategoryChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
            </div>
            <div class="tab-content hidden" id="custom-tabs-two-product">
              <div class="tab-pane fade show active" id="custom-tabs-two-revenue" role="tabpanel" aria-labelledby="custom-tabs-two-revenue-tab">
                <canvas id="pieRevenueProductChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-count" role="tabpanel" aria-labelledby="custom-tabs-two-count-tab">
                <canvas id="pieCountProductChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
            </div>
            <div class="tab-content hidden" id="custom-tabs-two-customer">
              <div class="tab-pane fade show active" id="custom-tabs-two-revenue" role="tabpanel" aria-labelledby="custom-tabs-two-revenue-tab">
                <canvas id="pieRevenueCustomerChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
              <div class="tab-pane fade" id="custom-tabs-two-count" role="tabpanel" aria-labelledby="custom-tabs-two-count-tab">
                <canvas id="pieCountCustomerChart" style="min-height: 200px; height: 350px; max-height: 350px"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.card -->
      <!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection
@include('admin.partials.index-jquery');
@section('footer-content')
<script defer src="{{asset('api/admin/index.js')}}"></script>
@endsection