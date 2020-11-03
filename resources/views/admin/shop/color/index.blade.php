@extends('admin.layouts.app')
@section('title')
Màu sắc
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Màu sắc</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Màu sắc</li>
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
                            <button type="button" class="btn btn-primary add-modal" data-toggle="modal" data-target="#modal-default">
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
                                    <th>Mã màu</th>
                                    <th>Màu</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                                <tr>
                                    @foreach($colors as $color)
                                    <th scope="row">{{ $color->id }}</th>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->color }}</td>
                                    <td>
                                        <p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:{{ $color->color }}"></p>
                                    </td>
                                    <td>
                                        <a href="#myModal" class="btn btn-primary edit-modal" data-id="{{ $color->id }}" data-name="{{ $color->name }}" data-color="{{ $color->color }}" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="#myModal{{$color->id}}" class="btn btn-danger delete-modal" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/colors') }}" method="post" enctype="multipart/form-data" id="quickForm">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Thêm màu </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="color">Mã màu</label>
                        <input type="text" name="color" value="{{ old('color') }}" class="form-control" id="color" placeholder="Vui lòng nhập màu">
                    </div>
                    <div class="form-group">
                        <label for="color">Màu</label>
                        <p style="width: 80px; height: 50px;  position:relative">
                            <span class="bg-color" style="width: 30px; height: 30px; position:absolute; top: 8px; left: 20px; border:1px solid #ebebeb;"></span>
                        </p>
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
@foreach($colors as $color)
<!-- Modal Edit -->
<!-- <div class="modal fade" id="modal-default-{{ $color->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/colors/'.$color->id) }}" method="post" enctype="multipart/form-data" id="quickForm">
                @method('PUT')
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Sửa màu {{ $color->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" value="{{ $color->name }}" class="form-control" id="name" placeholder="Vui lòng nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="color">Mã Màu</label>
                        <input type="text" name="color" value="{{ $color->color }}" class="form-control" id="color" placeholder="Vui lòng nhập màu">
                    </div>
                    <div class="form-group">
                        <label for="color">Màu</label>
                        <p style="width: 80px; height: 50px;  position:relative">
                            <span class="bg-color" style="width: 30px; height: 30px; position:absolute; top: 8px; left: 20px; border:1px solid #ebebeb; background-color: {{ $color->color }}"></span>
                        </p>
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
</div> -->

<!-- Modal Delete -->
<div id="myModal{{$color->id}}" class="modal fade">
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
                <form name="brand" action="{{ url('admin/colors/'.$color->id) }}" method="post" class="form-horizontal">
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
<script>
    $(document).ready(function() {
        $(document).on('change', '#color', function(e) {
            var color = $(this).val();
            $('.bg-color').css({
                "background-color": color
            });
        });
    });
    $(document).ready(function() {
        $(document).on('click', '.add-modal', function(e){
            $('.modal-title').html('Thêm màu');
            $('#name').val('');
            $('#color').val('');
            $('.bg-color').css({
                "background-color": ''
            });
        })
        $(document).on('click', '.edit-modal', function(e) {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var color = $(this).attr('data-color');
            $('#modal-default').modal('show');
            $('.modal-title').html('Sửa màu ' + name);
            $('#name').val(name);
            $('#color').val(color);
            $('.bg-color').css({
                "background-color": color
            });
        })
        $(document).on('click', '.store-color', function(e) {
            var data = $(this).closest('form').serializeArray();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo url('api/admin/colors') ?>',
                type: 'POST',
                dataType: 'JSON',
                data: data,
            }).done(function(response) {
                html = '';
                html += '<tr><th scope="row">' + response.id + '</th>' +
                    '<td>' + response.name + '</td>' +
                    '<td>' + response.color + '</td>' +
                    '<td><p style="width: 30px; height: 30px; margin: 0 auto; border:1px solid #ebebeb; background-color:' + response.color + '"></p></td>' +
                    '<td><a href="#myModal"  class="btn btn-primary edit-modal"  data-id="' + response.id + '" data-name="' + response.name + '" data-color="' + response.color + '" title="Sửa" data-toggle="modal"><i class="fas fa-pencil-alt"></i></a>' +
                    '<a href="#myModal' + response.id + '" class="btn btn-danger delete-modal" data-toggle="modal" title="Xóa"><i class="fas fa-trash-alt"></i></a>' +
                    '</td></tr>';
                $('.tbody').append(html);
                toastr.success('Thêm thành công');
                $('.modal').modal('hide');
            }).fail(function(response) {
                toastr.error('Màu đã tồn tại');
            })
        })
    })
</script>