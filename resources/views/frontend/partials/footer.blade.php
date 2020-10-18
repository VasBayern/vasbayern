<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="footer-left">
                    <div class="footer-logo">
                        <a href="#"><img src="{{asset('front_ends/img/footer-logo.png')}}" alt=""></a>
                    </div>
                    <ul>
                        <li>Địa chỉ: Số 34 ngõ 445 Nguyễn Khang, Cầu Giấy, Hà Nội</li>
                        <li>SĐT: 0346741998</li>
                        <li>Email: vasbayernshop@gmail.com</li>
                    </ul>
                    <div class="footer-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <div class="footer-widget">
                    <h5>Information</h5>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Checkout</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Serivius</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="footer-widget">
                    <h5>My Account</h5>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="newslatter-item">
                    <div class="newslatter-item">
                        <h5>Đăng ký nhận bản tin</h5>
                        <p>Nhận email về các chương trình khuyến mãi, các bài viết mới của cửa hàng</p>
                        <form action="{{ route('followBlog') }}" class="subscribe-form" method="post" enctype="multipart/form-data" id="quickForm" required>
                            @csrf
                            <input type="email" placeholder="Nhập email của bạn ..." name="email">
                            <button type="submit">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                    <div class="payment-pic">
                        <img src="{{asset('front_ends/img/payment-method.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
