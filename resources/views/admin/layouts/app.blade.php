<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('admin.partials.head')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    @include('admin.partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin.partials.footer');
    <!-- /footer -->
  </div>
  <!-- ./wrapper -->

  <!-- Jquery Function -->
  @yield('footer-content')
</body>

</html>