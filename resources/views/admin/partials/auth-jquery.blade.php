
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
            required: true,
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