@extends('frontend.layouts.app')
@section('title')
Liên hệ
@endsection
@section('content')
<style>
    .phone {
        color: #e7ab3c;
    }

    .phone:hover {
        color: #e7ab3c !important
    }

    .phone.active {
        color: #e7ab3c !important
    }

    .contact-form {
        margin-top: 50px;
    }
</style>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Câu hỏi thường gặp</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Map Section Begin -->

<!-- Map Section Begin -->

<!-- Contact Section Begin -->
<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="contact-title">
                    <h4>Liên hệ với chúng tôi</h4>
                    <p>Nếu bạn có bất cứ thắc mắc nào về sản phẩm, chính sách khuyến mại của cửa hàng hoặc đơn giản là muốn tìm một người để tâm sự, hãy <span style="color:#e7ab3c;">liên hệ</span> với chúng tôi:</p>
                </div>
                <div class="contact-widget">
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="ci-text">
                            <span>Địa chỉ:</span>
                            <p>Số nhà 34 ngõ 445 Nguyễn Khang, Cầu Giấy, Hà Nội</p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-mobile"></i>
                        </div>
                        <div class="ci-text">
                            <span>Số điện thoại:</span>
                            <p><a href="tel:0346741998" class="phone">034-674-1998</a></p>
                        </div>
                    </div>
                    <div class="cw-item">
                        <div class="ci-icon">
                            <i class="ti-email"></i>
                        </div>
                        <div class="ci-text">
                            <span>Email:</span>
                            <p>vastb98@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <div class="leave-comment">
                        <h4>Để lại bình luận</h4>
                        <p>Nhân viên cửa hàng sẽ phản hồi email sớm nhất</p>
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
                        <form action="{{ route('comment') }}" class="comment-form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" @if(Auth::check()) value="{{ Auth::user()->name }}" readonly @endif placeholder="Nhập tên ..." required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" @if(Auth::check()) value="{{ Auth::user()->email }}" readonly @endif placeholder="Nhập email ..." required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Nhập bình luận ..." name="comment" required>{{ old('comment') }}</textarea>
                                    <button type="submit" class="site-btn">Gửi tin nhắn</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map spad col-lg-6 offset-lg-1">
                <div class="container">
                    <div class="map-inner">
                        <div class="mapouter">
                            <div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=445%20Nguy%E1%BB%85n%20Khang&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com/divi-discount/">elegant themes discount</a></div>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 500px;
                                    width: 600px;
                                }
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 500px;
                                    width: 600px;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
@endsection