@extends('admin.layouts.app')
@section('title')
Đánh giá
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Đánh giá</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Đánh giá</li>
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
                                    <th>Id</th>
                                    <th>Khách hàng</th>
                                    <th>Sao</th>
                                    <th>Đánh giá</th>
                                    <th>Thời gian</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                @foreach($comments as $comment)
                                <th scope="row">{{ $stt }}</th>
                                <td>{{ $comment->user->name }}</td>
                                <td>{{ $comment->rate }}</td>
                                <td>{{ $comment->review }}</td>
                                <td>{{ ($comment->created_at)->format("d-m-Y") }}</td>
                                <td>
                                    <a href="#myModal" class="btn btn-success btn-action view-detail" data-toggle="modal" data-target="#modal-default" data-view="{{$comment->id}}" title="Xem chi tiết"> <i class="fas fa-eye"></i></a>
                                    <a href="mailto:{{$comment->email}}" onclick="window.location.href='np.html'" class="btn btn-success" title="Trả lời"><i class="far fa-envelope"></i></a>
                                </td>
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
@endsection

<!-- Jquery -->
@include('admin.partials.index-jquery');