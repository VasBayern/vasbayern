@extends('admin.layouts.app')
@section('title')
Tag
@endsection

@section('content')

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
                                    <th>Tên</th>
                                    <th>Loại</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($tags as $tag)
                                <th scope="row">{{ $stt }}</th>
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
                                    <a href="#myModal" class="btn btn-primary" title="Sửa" data-toggle="modal" data-target="#modal-default-{{ $tag->id }}"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#myModal{{$tag->id}}" class="btn btn-danger" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
            <form action="{{ url('admin/tags') }}" method="post" enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thẻ</h4>
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
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@foreach($tags as $tag)
<!-- Modal Edit -->
<div class="modal fade" id="modal-default-{{ $tag->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/tags/'.$tag->id) }}" method="post" enctype="multipart/form-data" id="quickForm">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sửa thẻ {{ $tag->name }}</h4>
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
                        <label for="type">Loại</label>
                        <select name="type" class="form-control custom-select">
                            <option value="1" <?php echo ($tag->tag_type == 1) ? 'selected' : '' ?>>Sản phẩm </option>
                            <option value="2" <?php echo ($tag->tag_type == 2) ? 'selected' : '' ?>>Bài viết</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ $tag->name }}" class="form-control" id="name" placeholder="Vui lòng nhập thẻ">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" value="{{ $tag->slug }}" class="form-control" id="slug" placeholder="Vui lòng nhập slug">
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
<div id="myModal{{$tag->id}}" class="modal fade">
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
                <form name="brand" action="{{ url('admin/tags/'.$tag->id) }}" method="post" class="form-horizontal">
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