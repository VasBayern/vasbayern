@extends('admin.layouts.app')
@section('title')
Bình luận của khách hàng
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bình luận của khách hàng</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Bình luận</li>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Bình luận</th>
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php $stt = 1; ?>
                            @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ ($comment->created_at)->format("d-m-Y") }}</td>
                                <td>
                                    @if($comment->status == 0)
                                    Chưa phản hồi
                                    @else
                                    Đã phản hồi
                                    @endif
                                </td>
                                <td>
                                    <a href="mailto:{{$comment->email}}" onclick="window.location.href='np.html'" class="btn btn-success" title="Trả lời"><i class="far fa-envelope"></i></a>
                                </td>
                            </tr>
                            <?php $stt++; ?>
                            @endforeach
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
<!-- /.modal -->
@foreach($comments as $comment)
<!-- Modal Delete -->
<div id="myModal{{$comment->id}}" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fas fa-exclamation"></i>
                </div>
                <h4 class="modal-title w-100">Bạn có muốn xóa? </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Lưu ý : Hành động này không thể hoàn tác</p>
            </div>
            <div class="modal-footer justify-content-center">
                <form name="comment" action="{{ url('admin/contacts/'.$comment->id) }}" method="post" class="form-horizontal">
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