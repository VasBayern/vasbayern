@extends('admin.layouts.app')
@section('title')
Bài viết
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Bài viết</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active"> Bài viết</li>
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
                            <a href="{{ url('api/admin/content/posts/create') }}"><button type="button" class="btn btn-primary">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Ảnh</th>
                                    <th>Giới thiệu</th>
                                    <th>Tác giả</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr class="tr-{{ $post->id }}">
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td><img src="{{ asset($post['image']) }}" style="margin-top:10px;max-width:240px;"></td>
                                    <td><?php echo $post->intro ?></td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>
                                        <a href="{{ url('api/admin/content/posts/'.$post->slug .'/edit') }}" class="btn btn-action btn-primary edit-modal" title="Sửa"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="{{ url('api/admin/content/posts/'.$post->slug) }}" class="btn btn-action btn-danger delete-item" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
@endsection

<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script></script>
<script defer src="{{asset('api/admin/content-post.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');