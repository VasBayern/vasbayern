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
                            @foreach($comments as $comment)
                            <tr class="tr-{{ $comment->id }}">
                            <th scope="row">{{ $comment->id }}</th>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ ($comment->created_at)->format("d-m-Y") }}</td>
                                <td>
                                    <?php echo $comment->status == 0 ? "Chưa phản hồi" : "Đã phản hồi" ?>
                                </td>
                                <td>
                                    <a href="mailto:{{$comment->email}}" onclick="window.location.href='np.html'" class="btn btn-success" title="Trả lời"><i class="far fa-envelope"></i></a>
                                </td>
                            </tr>
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
@endsection

<!-- Jquery -->
@section('footer-content')
<script defer src="{{asset('api/admin/common/admin-function.js')}}"></script>
<script defer src="{{asset('api/admin/common/api.js')}}"></script>
@endsection
@include('admin.partials.index-jquery');