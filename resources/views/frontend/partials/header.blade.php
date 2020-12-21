<style type="text/css">
    .profile {
        color: #222326;
    }

    .profile:hover {
        color: #222326;
    }

    .social-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 4px;
        margin: 5px 0;
        opacity: 0.85;
        display: inline-block;
        font-size: 17px;
        line-height: 20px;
        text-decoration: none;
        text-align: center;
    }

    .social-btn:hover {
        opacity: 1;
    }

    .fb {
        background-color: #3B5998;
        color: white;
    }

    .google {
        background-color: #dd4b39;
        color: white;
    }

    /*
      ##Device = Tablets, Ipads (portrait)
      ##Screen = B/w 768px to 1024px
    */

    @media (min-width: 768px) and (max-width: 1024px) {
        .intro {
            display: none;
        }
    }

    /*
      ##Device = Tablets, Ipads (landscape)
      ##Screen = B/w 768px to 1024px
    */

    @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
        .intro {
            display: none;
        }
    }

    /*
      ##Device = Low Resolution Tablets, Mobiles (Landscape)
      ##Screen = B/w 481px to 767px
    */

    @media (min-width: 481px) and (max-width: 767px) {
        .intro {
            display: none;
        }
    }

    /*
      ##Device = Most of the Smartphones Mobiles (Portrait)
      ##Screen = B/w 320px to 479px
    */

    @media (min-width: 320px) and (max-width: 480px) {
        .intro {
            display: none;
        }
    }
</style>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    vasbayernshop@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    034.674.1998
                </div>
            </div>
            <div class="ht-right">
                @if(Auth::check() && !empty(Auth::user()->email_verified_at))
                <ul class="nav nav-tabs" style="border: none">
                    <li class="nav-item dropdown" style="background: #fff">
                        <a class="nav-link dropdown-toggle profile" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="true" aria-expanded="false" style="border: none; font-size: 16px;">
                            @if(isset(Auth::user()->avatar) && !empty(Auth::user()->avatar) )
                            <img src="{{ URL::to('/') }}/front_ends/img/user_avatar/{{ Auth::user()->avatar }}" style="border-radius: 50%; width: 35px; height:35px; margin-right: 10px;" />
                            @else
                            <img src="{{ URL::to('/') }}/front_ends/img/user_avatar/avt.jpg" style="border-radius: 50%; width: 35px; margin-right: 10px;" />
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Thông tin tài khoản</a>
                            <a class="dropdown-item" href="{{ route('user.address') }}">Địa chỉ giao hàng</a>
                            <a class="dropdown-item" href="{{ route('user.order') }}">Lịch sử mua hàng</a>
                            <a class="dropdown-item" href="{{ route('wishlist') }}">Sản phẩm yêu thích</a>
                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                @else
                <a href="#myModal" class="login-panel trigger-btn" data-toggle="modal" data-target=".bd-example-modal-lg">Đăng nhập</a>
                <!-- Modal HTML -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="background: rgb(248,248,248)">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-4 intro" style="background: rgb(255,255,255); height: 576px">
                                            <div class="modal-body" style="margin-top: 65px;">
                                                <p>Đăng ký, đăng nhập để tiến hành mua hàng, theo dõi đơn hàng, lưu danh sách sản phẩm yêu thích, nhận nhiều ưu đãi hấp dẫn hơn.</p>
                                                <img src="{{ asset('front_ends/img/welcome.jpg') }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-8 ml-auto show-login" style="background: rgb(255,255,255);">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle register" style="cursor: pointer">Đăng Nhập</h5>
                                                <h5 class="modal-title register" id="exampleModalCenterTitle" style="cursor: pointer; margin-left: 20px;">Đăng Ký</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 26%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('login') }}" method="post" id="quickForm">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Mật khẩu</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group hint-text small">
                                                        <a href="#" style="color: #e5a226;font-size: 16px;padding-right: 10px;">Quên mật khẩu?</a>
                                                        <a href="{{ url('register') }}" style="color: #e5a226;font-size: 16px;padding-right: 10px;">Đăng ký</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-warning btn-block  btn-lg" style="color: #fff">ĐĂNG NHẬP</button>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-social">
                                                            <a href="{{ url('login/facebook') }}" class="fb social-btn">
                                                                <i class="fa fa-facebook fa-fw"></i> Đăng nhập bằng Facebook
                                                            </a>

                                                            <a href="{{ url('/redirect') }}" class="google social-btn"><i class="fa fa-google fa-fw">
                                                                </i> Đăng nhập bằng Google
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-8 ml-auto show-register" style="background: rgb(255,255,255); display: none">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle register" style="cursor: pointer">Đăng ký</h5>
                                                <h5 class="modal-title login" id="exampleModalCenterTitle" style="cursor: pointer; margin-left: 45px;">Đăng nhập</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 26%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('register') }}" id="quickForm">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="text">Tên</label>
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Tên" required="required">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required="required">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Mật khẩu</label>
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="**********" required="required" min="6">
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password-confirm">Nhập lại mật khẩu</label>
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="**********" required min="6">
                                                    </div>
                                                    <div class="form-group hint-text small">
                                                        <label class="form-check-label"><input type="checkbox" required="required"> Tôi đồng ý với
                                                            <a href="#" style=" color: #e5a226;font-size: 16px;padding-right: 10px;">Điều khoản sử dụng</a>
                                                            &amp; <a href="#" style=" color: #e5a226;font-size: 16px;padding-right: 10px;">Chính sách riêng tư</a></label>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-warning btn-block  btn-lg" style="color: #fff">ĐĂNG KÝ</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div> -->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{asset('front_ends/img/logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <form action="{{ url('search') }}" method="POST">
                            @csrf
                            <button type="button" class="category-btn">Danh mục</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?" id="search" name="name">
                                <button type="submit"><i class="ti-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">

                        <li class="heart-icon">
                            @if(!Auth::check() && empty(Auth::user()->email_verified_at))
                            <a href="#myModal" class="proceed-btn" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <i class="icon_heart_alt"></i>
                            <span class="countWhislist">0</span>
                            </a>
                            @else
                            <?php $wishlists = \App\Models\WishListModel::where('user_id', \Auth::id())->get() ?>
                            <a href="{{ route('wishlist') }}">
                                <i class="icon_heart_alt"></i>
                                <span class="countWhislist">{{ count($wishlists) }}</span>
                            </a>
                            <div class="heart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody class="heartBody">
                                            @if(count($wishlists) > 0)
                                            @foreach($wishlists as $item)
                                            <tr class="row-wishlist-{{ $item->id }}">
                                                <?php
                                                $product = \App\Models\ShopProductModel::find($item->product_id);
                                                $images = json_decode($product->images);
                                                if ($product->priceSale > 0) {
                                                    $price = $product->priceSale;
                                                } else {
                                                    $price = $product->priceCore;
                                                }
                                                ?>
                                                <td class="si-pic">
                                                    <a href="{{ url('products/'.$product->slug) }}"><img src="{{asset($images[0]) }}" alt="" style="width: 100px; "></a>
                                                </td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <?php ?>
                                                        <p>{{ number_format($price) }} VNĐ </p>
                                                        <h6>{{ $product->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <a href="{{ url('wishlists/'.$item->id) }}" class="remove-wish-list">x</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <div class="select-heart">
                                                <span class="emptyHeart">Chưa có sản phẩm</span>
                                            </div>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </li>
                        <li class="cart-icon">
                            <a href="{{ url('cart') }}">
                                <i class="icon_bag_alt"></i>
                                <span class="countCart">{{ \Cart::getTotalQuantity() }}</span>
                            </a>
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody class="cartBody">
                                            @foreach(\Cart::getContent() as $item)
                                            <tr class="rowCart rowCart{{$item->id}}">
                                                <?php
                                                $product_id = $item->attributes->product_id;
                                                $product = \App\Models\ShopProductModel::find($product_id);
                                                $images = json_decode($product->images);
                                                if ($product->priceSale > 0) {
                                                    $price = $product->priceSale;
                                                } else {
                                                    $price = $product->priceCore;
                                                }
                                                ?>
                                                <td class="si-pic">
                                                    <img src="{{asset($images[0]) }}" alt="" style="width: 100px; ">
                                                </td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <?php ?>
                                                        <p>{{ number_format($price) }} VNĐ x <span class="quantityCart{{$item->id}}" data-quantity-{{$item->id}}="{{ $item->quantity }}">{{ $item->quantity }}</span></p>
                                                        <h6>{{ $product->name }}</h6>
                                                        <p style="color: #252525;">Size: <span style=" color: #dba239;">{{ $item->attributes->size_name }}</span> -
                                                            Màu: <span style=" color: #dba239;">{{ $item->attributes->color_name }}</span>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close" data-rowId="{{ $item->id }}"></i>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(Cart::isEmpty())
                                <div class="select-total">
                                    <span class="emptyCart">Chưa có sản phẩm</span>
                                </div>
                                @else
                                <div class="select-total">
                                    <span>Tổng tiền:</span>
                                    <h5>{{ number_format(\Cart::getSubTotal()) }} VNĐ</h5>
                                </div>
                                @endif
                                <div class="select-button">
                                    <a href="{{ route('cart') }}" class="primary-btn view-card">XEM GIỎ HÀNG</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">{{ number_format(\Cart::getSubTotal()) }} VNĐ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>Tất cả danh mục</span>
                    <!-- multi  level -->
                    <ul class="depart-hover">
                        <?php
                        $category = \App\Models\ShopCategoryModel::where('parent_id', '!=',  0)->get();
                        ?>
                        @foreach($category as $category)
                        <li><a href="{{ url('/categories/').'/'.$category->slug }}">{{ $category->name }}</a></li>
                        @endforeach
                        <!-- <li><a href="#">Polo</a></li>
                        <li><a href="#">Sơ Mi</a></li>
                        <li class="parent"><a href="#">T-Shirt </a> <span class="expand">»</span>
                            <ul class="child">
                                <li><a href="#">T-Shirt 1</a></li>
                                <li><a href="#">T-Shirt 2</a></li>
                                <li class="parent"><a href="#">T-Shirt 3</a><span class="expand">»</span>
                                    <ul class="child">
                                        <li><a href="#">T-Shirt 1</a></li>
                                        <li><a href="#">T-Shirt 2</a></li>
                                        <li><a href="#">T-Shirt 3</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="parent"><a href="#">Jeans</a><span class="expand">»</span>
                            <ul class="child">
                                <li><a href="#">T-Shirt 1</a></li>
                                <li><a href="#">T-Shirt 2</a></li>
                                <li><a href="#">T-Shirt 3</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li><a href="" id="dLabel" data-toggle="dropdown">Danh mục</a>
                        <ul class="dropdown">
                            <?php
                            $category = \App\Models\ShopCategoryModel::where('parent_id', '=',  0)->get();
                            ?>
                            @foreach($category as $category)
                            <li><a href="{{ url('/categories/').'/'.$category->slug }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('blog') }}">Tin tức</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href="#">Shop</a>
                        <ul class="dropdown">
                            <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                            @if(Auth::check() && !empty(Auth::user()->email_verified_at))
                            <li><a href="{{ route('wishlist') }}">SP Yêu Thích</a></li>
                            @else
                            <li><a href="#myModal" data-toggle="modal" data-target=".bd-example-modal-lg">SP Yêu Thích</a></li>
                            @endif
                            <li><a href="{{ route('faq') }}">Câu hỏi thường gặp</a></li>
                            @if(!Auth::check() || empty(Auth::user()->email_verified_at))
                            <li><a href="{{ route('register') }}">Đăng kí</a></li>
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>
<script>
    $(".btn-group, .dropdown").hover(
        function() {
            $('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
            $(this).addClass('open');
        },
        function() {
            $('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
            $(this).removeClass('open');
        });
</script>