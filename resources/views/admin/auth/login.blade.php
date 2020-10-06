<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Đăng nhập</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_assets/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Admin</b>LTE
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Đăng nhập để truy cập Admin</p>
        <form action="{{ route('admin.login') }}" method="post" id="quickForm">
          @csrf
          @if(session('msg'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('msg')}}
          </div>
          @endif
          <div class="input-group mb-3 form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3 form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="row">
            <div class="col-7">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                  Nhớ mật khẩu
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-5">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- Hoặc -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Đăng nhập bằng Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Đăng nhập bằng Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          @if (Route::has('admin.password.request'))
          <a href="{{ route('admin.password.request') }}">Quên mật khẩu</a>
          @endif

        </p>
        <p class="mb-0">
          <a href="{{ route('admin.register') }}" class="text-center">Đăng kí tài khoản Admin mới</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{asset('admin_assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin_assets/dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin_assets/dist/js/demo.js')}}"></script>
  <!-- jquery-validation -->
  <script src="{{asset('admin_assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#quickForm').validate({
        rules: {
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            minlength: 8,
            equalTo: '#password'
          },
          terms: {
            required: true
          },
        },
        messages: {
          name: {
            required: "Vui lòng nhập tên",
          },
          email: {
            required: "Vui lòng nhập địa chỉ email",
            email: "Định dạng email không đúng"
          },
          password: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự"
          },
          password_confirmation: {
            required: "Vui lòng nhập mật khẩu",
            minlength: "Mật khẩu chứa ít nhất 8 kí tự",
            equalTo: "Mật khẩu xác thực không trùng khớp",
          },
          terms: "Vui lòng chấp nhận điều khoản"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
  </script>

  
</body>

</html>