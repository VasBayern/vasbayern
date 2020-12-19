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
                            <button type="button" class="btn btn-primary add-modal" data-toggle="modal" data-target="#modal-xl-add">
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
                                    <th>Tên</th>
                                    <th>Link</th>
                                    <th>Ảnh</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banners as $banner)
                                <tr class="tr-{{ $banner['id'] }}">
                                    <th scope="row">{{ $banner['id'] }}</th>
                                    <td>{{ $banner->name }}</td>
                                    <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                                    <td>
                                        <img src="{{ asset($banner->image) }}" style="margin-top:10px;max-width:240px;">
                                    </td>
                                    <td>
                                        <a href="{{ url('api/admin/banners/'.$banner['slug']) }}" class="btn btn-primary edit-modal" data-name="{{ $banner->name }}" data-slug="{{ $banner->slug }}" data-link="{{ $banner->link }}" data-image="{{ $banner->image }}" data-location_id="{{ $banner->location_id }}" data-intro="{{ $banner->intro }}" data-desc="{{ $banner->desc }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/banners/'.$banner['slug']) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
<div class="modal fade" id="modal-xl-add">
    <form action="" id="quickForm">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Banner</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="text" name="link" value="{{ old('link') }}" class="form-control" id="link" placeholder="Vui lòng nhập đường dẫn">
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Vị trí</label>
                                        <select name="location_id" class="form-control custom-select" id="location_id">
                                            @foreach($locations as $key_location => $location)
                                            <option value="{{ $key_location }}">{{ $location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Ảnh</label>
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="lfm-btn btn">
                                                <button type="button" class="btn btn-block bg-gradient-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>
                                            </a>
                                        </span>
                                        <input id="thumbnail1" type="text" name="image" value="{{ old('image') }}" class="form-control" id="focusedinput">
                                        <img id="holder1" style="max-height:100px;">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Mô tả</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="intro">Mô tả</label>
                                        <div class="mb-3">
                                            <textarea class="textarea" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Chi tiết</label>
                                        <div class="mb-3">
                                            <textarea class="textareaDesc" name="desc" id="desc" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary store-item" href="{{ url('api/admin/banners') }}">Thêm</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modal-xl-edit">
    <form action="" id="quickFormEdit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Banner</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên</label>
                                        <input type="text" name="name" value="" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" value="" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="text" name="link" value="" class="form-control" id="link" placeholder="Vui lòng nhập đường dẫn">
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Vị trí</label>
                                        <select name="location_id" class="form-control custom-select" id="location_id">
                                            @foreach($locations as $key_location => $location)
                                            <option value="{{ $key_location }}">{{ $location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Ảnh</label>
                                        <span class="input-group-btn">
                                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="lfm-edit-btn btn">
                                                <button type="button" class="btn btn-block bg-gradient-primary"><i class="fas fa-image" style="margin-right:10px"></i>Chọn</button>
                                            </a>
                                        </span>
                                        <input id="thumbnail1" type="text" name="image" class="form-control image" id="focusedinput">
                                        <img id="holder1" style="max-height:100px;">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Mô tả</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="intro">Mô tả</label>
                                        <div class="mb-3">
                                            <textarea class="textarea" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Chi tiết</label>
                                        <div class="mb-3">
                                            <textarea class="textareaDesc" name="desc" id="desc" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary update-item">Lưu</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/banner.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');