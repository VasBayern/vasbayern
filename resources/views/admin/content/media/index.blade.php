@extends('admin.layouts.app')
@section('title')
    Media
@endsection
@section('content')
    <h1> Media</h1>
    <div style="margin-top: 30px">
    <iframe src="http://localhost/vasbayern/public/laravel-filemanager?type=images" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
    </div>
@endsection
<!-- jQuery -->
<script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>