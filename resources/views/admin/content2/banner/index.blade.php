@extends('admin.layouts.app')
@section('title')
Banner
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Banner</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Banner</li>
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
                            <a href="{{ url('admin/banners') }}"><button type="button" class="btn btn-primary">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Tên</th>
                                    <th>Link</th>
                                    <th>Ảnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($banners as $banner)
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $banner->name }}</td>
                                <td>{{ $banner->link }}</td>
                                <td>
                                    <img src="{{ asset($banner->image) }}" style="margin-top:10px;max-width:300px; max-height:200px">
                                </td>
                                <td>
                                    <a href="{{ url('admin/banners/'.$banner->slug) }}" class="btn btn-primary" title="Sửa"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#myModal{{$banner->slug}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
<!-- Modal HTML -->
@foreach($banners as $banner)
<div id="myModal{{$banner->slug}}" class="modal fade">
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
                <form name="category" action="{{ url('admin/banners/'.$banner->slug) }}" method="post" class="form-horizontal">
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