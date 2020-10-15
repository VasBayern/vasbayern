@extends('frontend.layouts.shop')
@section('title')
    Thông tin tài khoản
@endsection
@section('content')
    <style>
        .avt-image {
            height: 140px;
            background-color: rgb(233, 236, 239);
            padding-left: 0;
            padding-right: 0;
        }
        .add-image button {
            position: relative;
            height: 50px;
            margin-top: 40px;
            margin-left: 15px;
        }
        .add-image i {
            position: relative;
            float: left;
            top: 12px;
        }
        .add-image span {
            position: relative;
            float: left;
            color: #dee2e6;
        }
        .add-image span:hover {
            color: #dee2e6;
        }
        .add-image .file-upload {
            position: absolute;
            left: -35px;
            top: -7px;
            width: 135px;
            font-size: 28px;
            opacity: 0;
            cursor: pointer;
        }

    </style>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Thông tin tài khoản</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <section class="spad">
        @if(Auth::check() && !empty(Auth::user()->email_verified_at))
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                    <div class="filter-widget">
                        <h4 class="fw-title">Tài khoản</h4>
                        <ul class="filter-catagories">
                            <li><a href="{{ url('user/profile') }}" style="color: #e7ab3c">Thông tin tài khoản</a></li>
                            <li><a href="{{ url('user/address') }}">Địa chỉ giao hàng</a></li>
                            <li><a href="{{ url('user/order') }}" >Lịch sử mua hàng</a></li>
                            <li><a href="{{ url('user/wishlist') }}" >Sản phẩm yêu thích</a></li>
                        </ul>
                    </div>
                </div>
                <div class='col-lg-9 order-1 order-lg-2'>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="list-style: none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!!session('success')!!}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!!session('error')!!}
                        </div>
                    @endif
                    <form action='{{ url('user/profile') }}' method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="filter-widget" style="margin-bottom: 0;">
                            <h4 class="fw-title">Thông tin tài khoản</h4>
                        </div>
                        <div class="form-group container">
                           <div class="row">
                               <div class="avt-image col-lg-2">
                                   @if(isset(Auth::user()->image) && !empty(Auth::user()->image) )
                                   <img class="avt-image" src="{{ URL::to('/') }}/front-ends/img/user-image/{{ Auth::user()->image }}" style="border-radius: 50%"/>
                                   @else
                                   <img class="avt-image" src="{{ URL::to('/') }}/front-ends/img/user-image/avt.jpg" style="border-radius: 50%;"/>
                                   @endif
                               </div>
                               <div class="col-lg-3 add-image">
                                   <button class="btn btn-primary upload-button" type="button">
                                       <i class="fa fa-fw fa-camera"></i>
                                       <span class="btn btn-file">Đổi ảnh
                                         <input type='file' class="file-upload" name="image" onchange="readURL(this);" />
                                       </span>
                                   </button>
                               </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" disabled name="email" value="{{ Auth::user()->email }}" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <div class="change-pass">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="check">
                                    <label class="form-check-label">Thay đổi mật khẩu</label>
                                </div>

                            </div>
                        </div>
                        <div class="password" style="display: none">
                            <div class="form-group">
                                <label for="old_password">Mật khẩu cũ</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Nhập mật khẩu cũ" minlength="8">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" placeholder="Mật khẩu từ 8 đến 20 kí tự" name="new_password" minlength="8">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Nhập lại mật khẩu mới " name="confirm_password" minlength="8">
                            </div>
                        </div>
                        <div class='form-group'>
                            <button type="submit" class="btn btn-warning" id="btnUpdateProfile">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.form-check-input').on('click',function () {
                $('.password').toggle();
                var chkBoxVal = $('input[type="checkbox"]:checked').length;
                if(chkBoxVal == 1) {
                    $('#old_password').attr('required', true) ;
                    $('#new_password').attr('required', true) ;
                    $('#confirm_password').attr('required', true) ;
                }
            });
        });
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.avt-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        };
        // $(document).ready(function(){
        //     var chkBoxVal = $('input[type="checkbox"]:checked').length;
        //         if(chkBoxVal == 0) {
        //             $('#btnUpdateProfile').on('click', function (e) {
        //                 e.preventDefault();
        //                 var name = $('#name').val();
        //                 var image = $('.file-upload').prop('files')[0];
        //                 var changeProfileUrl = '<?php echo url('user/profile')?>';
        //                 // var dataPost = $(this).closest('form').serializeArray();
        //                 var dataPost = { name: name, image:image};
        //                 console.log(dataPost);
        //                 $.ajax({
        //                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                     url: changeProfileUrl,
        //                     dataType:'json',
        //                     type:'post',
        //                     data: {name:name, image:image},
        //                     processData: false
        //                 }).done(function(result){
        //                     if(result.msg === 'success') {
        //                         toastr.success('Cập nhật thành công');
        //                         $('#old_password').val('');
        //                         $('#new_password').val('');
        //                         $('#confirm_password').val('');
                                
        //                     } else {
        //                         toastr.error('Vui lòng thử lại sau','Có lỗi xảy ra');
        //                     }
        //                 });
        //     });
        //         }
           
        // })
    </script>

@endsection
