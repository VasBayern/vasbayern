@extends('admin.layouts.app')
@section('title')
Sửa bài viết
@endsection
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin_assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin_assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sửa bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.post') }}">Bài viết</a></li>
                    <li class="breadcrumb-item active">Sửa</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ url('admin/blog/posts/'.$post->slug) }}" method="post" enctype="multipart/form-data" id="quickForm">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Bài viết</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
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
                            <input type="text" name="name" value="{{ $post->name }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" value="{{ $post->slug }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control custom-select" name="category_id">
                                @foreach($categories as $category)
                                <?php $selected = ($category['id'] == $post->category_id) ? 'selected' : '' ?>
                                <option value="{{ $category['id'] }}" {{ $selected }}>{{ $category['name'] }}</option>
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
                            <input id="thumbnail1" type="text" name="image" value="{{ $post->image }}" class="form-control" id="focusedinput">
                            <img id="holder1" src="{{ asset($post->image) }}" style="max-height:100px;">
                        </div>
                        <div class="form-group">
                            <label>Thẻ</label>
                            <select class="select2" multiple="multiple" data-placeholder="Chọn thẻ" style="width: 100%;" name="tag[]">
                                @foreach($tags as $tag)
                                <?php
                                $selected = in_array($tag->id, $tagPostIDs) ? 'selected' : '';
                                ?>
                                <option value="{{ $tag->id }}" {{ $selected }}>{{ $tag->slug }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="intro">Giới thiệu</label>
                            <div class="mb-3">
                                <textarea class="textarea" name="intro" id="intro" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{ $post->intro }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                       
                        <div class="form-group">
                            <label for="desc">Bài viết</label>
                            <div class="mb-3">
                                <textarea class="textareaPost" name="desc" id="desc" placeholder="Place some text here" style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{ $post->desc}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.blog.post') }}" class="btn btn-secondary">Hủy</a>
                <input type="submit" value="Sửa" class="btn btn-success">
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection
<!-- Jquery -->
@include('admin.partials.admin-jquery');