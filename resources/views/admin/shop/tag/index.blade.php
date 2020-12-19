@extends('admin.layouts.app')
@section('title')
Tag
@endsection
@section('content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script></script>
<script defer src="{{asset('api/admin/tag.js')}}"></script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thẻ</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thẻ</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default-add">
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
                                    <th>Slug</th>
                                    <th>Loại</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr class="tr-{{ $tag->id }}">
                                    <th scope="row">{{ $tag->id }}</th>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>
                                        @if($tag->tag_type == 1)
                                        <i class="fas fa-tshirt"></i>
                                        @elseif($tag->tag_type == 2)
                                        <i class="far fa-newspaper"></i>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ url('api/admin/tags/'.$tag->id) }}" class="btn btn-primary edit-modal" data-name="{{ $tag->name }}" data-slug="{{ $tag->slug }}" data-type="{{ $tag->tag_type }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/tags/'.$tag->id) }}" class="btn btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
                    <h4 class="modal-title">Thêm thẻ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="homepage">Loại</label>
                        <select name="type" class="form-control custom-select">
                            <option value="1">Sản phẩm</option>
                            <option value="2">Bài viết</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Vui lòng nhập thẻ">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="slug" name="slug" value="{{ old('slug') }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary store-item" href="{{ url('api/admin/tags') }}">Lưu</button>
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
                        <label for="type">Loại</label>
                        <select name="type" class="form-control custom-select" id="type">
                            <option value="1">Sản phẩm </option>
                            <option value="2">Bài viết</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="" class="form-control" id="name" placeholder="Vui lòng nhập thẻ">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" value="" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
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
<script defer src="{{asset('api/admin/common/api.js')}}"></script></script>
<script defer src="{{asset('api/admin/tag.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');