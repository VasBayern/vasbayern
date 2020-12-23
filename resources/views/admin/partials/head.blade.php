<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_assets/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}/">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('css/modalDelete.css')}}">
  <!-- Date-picker -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Toastr-->
  <!-- <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!} -->
  <!-- Sweetalert -->
  <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

  <script type="text/javascript">
    var BASE_URL = '{{ URL::to('/') }}';
  </script>
  <script defer src="{{asset('api/admin/common/api.js')}}"></script>
  <style type="text/css">
    table thead tr th {
      text-align: center;
    }

    table tbody th,
    td {
      text-align: center;
    }

    .btn-action {
      display: table;
      margin-bottom: 10px;
    }

    .small-box .increase-value {
      font-size: 14px;
      font-weight: 500;
      margin-left: 10px;
    }
  </style>
</head>