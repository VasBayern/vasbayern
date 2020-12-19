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
                            <a href="{{ url('admin/category') }}"><button type="button" class="btn btn-primary">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Tên</th>
                                    <th>Danh mục</th>
                                    <th>Cha</th>
                                    <th>Ảnh</th>
                                    <th>Hiển thị</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <th scope="row">{{ $category['id'] }}</th>
                                <td>{{ $category['name'] }}</td>
                                <td>{{ str_repeat('-', $category['level'] - 1) . ' ' . $category['name'] }}</td>
                                <td>{{ $category['parent_id'] }}</td>
                                <td>
                                    <img src="{{ asset($category['image']) }}" style="margin-top:10px;max-width:240px;">
                                </td>
                                <td>
                                    @if($category['homepage'] == 1)
                                    <i class="far fa-check-square" style="color: #007BFF;"></i>
                                    @else
                                    <i class="far fa-window-close" style="color: #ff0a0a;"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/category/'.$category['slug']) }}" class="btn btn-primary" title="Sửa"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#myModal{{$category['slug']}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
<!-- Modal HTML -->
@foreach($categories as $category)
<div id="myModal{{$category['slug']}}" class="modal fade">
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
                <form name="category" action="{{ url('admin/category/'.$category['slug']) }}" method="post" class="form-horizontal">
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