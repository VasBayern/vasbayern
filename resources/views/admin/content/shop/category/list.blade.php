@extends('admin.layouts.app')
@section('title')
Danh mục sản phẩm
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh mục</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh mục</li>
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
                            <a href="{{ url('admin/category/create') }}"><button type="button" class="btn btn-block bg-gradient-primary">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Slug</th>
                                    <th>Ảnh</th>
                                    <th>Cha</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($categories as $category)
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <?php
                                    $image = isset($category->image) ? json_decode($category->image) : array();
                                    ?>
                                    @if(!empty($image))
                                    @foreach($image as $key => $value)
                                    <img src="{{ asset($value) }}" style="margin-top:10px;max-width:240px;">
                                    @break
                                    @endforeach
                                    @endif
                                </td>

                                <td>
                                    @if($category->parent_id == 0)
                                    {{ "Gốc" }}
                                    @else
                                    <?php
                                    $item = DB::table('shop_categories')->where("id", $category->parent_id)->first();
                                    echo $item->name;
                                    ?>
                                    @endif
                                </td>
                                <td>
                                    @if($category->homepage == 1)
                                    {{ "Hiển thị" }}
                                    @else
                                    {{ "Không hiển thị" }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category->id.'/edit') }}" class="btn btn-primary" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#myModal{{$category->id}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

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
@endsection

<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('admin_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- page script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>