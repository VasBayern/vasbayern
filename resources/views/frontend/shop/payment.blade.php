@extends('frontend.layouts.shop')
@section('title')
   Thanh toán
@endsection
@section('content')
    <style>
        .radio-item label {
            margin-left: 10px;
            font-size: 14px;
        }
        .radio-ship {
            margin-left: 20px;
            margin-top: 20px;
        }
        .radio-item label span {
            margin-left: 5px;
            color: #000;
        }
        .detail-ship {
            margin-left: 50px;
            margin-bottom: 40px;
            width: 450px;
            padding: 20px 30px 20px 30px;
        }
        .detail-ship ul{
            margin-left: 30px;
            color: #666666;
            font-size: 12px;
        }
        .lol {
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .lol p {
            color: #8FC050;
            font-weight: bold;
        }
        .lol-price {
            padding-top: 10px;
            padding-bottom: 15px;
        }
        .lol-price p {
            color: #000;
        }
        .user-profile {
            border: 2px solid #ebebeb;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .edit-address, .add-address  {
            border-radius: 2px;
            padding: 7px;
            border: 1px solid;
            border-color: rgb(204,204,204);
            color: #333333;
            background: linear-gradient(rgb(255, 255, 255), rgb(247, 247, 247));
            float: right;
            font-size: 14px;
        }
        .edit-address:hover, .add-address:hover {
            color: #333333;
        }
        .user-edit {
            padding-bottom: 50px;
            border-bottom: 1px solid #dee2e6;
        }
        .user-address {
            padding: 10px 0;
        }
        .user-address p {
            margin-bottom: 5px;
            font-size: 14px;
        }
        .user-address h6 {
            font-weight:700;
            margin-bottom: 10px;
        }
        .user-product {
            padding: 10px 0 30px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .user-product p {
            margin-bottom: 5px;
            font-size: 12px;
            float: left;
            width: 210px;
        }
        .user-product .price-product {
            float: right;
            margin-bottom: 5px;
            font-size: 12px;
        }
        .sub-total {
            padding-bottom: 65px;
        }
        .sub-total span {
            float: right;
            font-size: 12px;
        }
        .sub-total p {
            width: 210px;
            float: left;
        }
        .total-product {
            font-weight:bold;
            color:rgb(238, 35, 71);

        }

    </style>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{ url('cart') }}">Giỏ hàng</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <section class="checkout-section spad">

        @if(Auth::check())
        <div class="container">
            @if(session('msg'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('msg')}}
                </div>
            @endif
            <form action="" method="post" class="checkout-form">
                <div class="row">
                    <form action="{{ url('payment') }}" method="post">
                        @csrf
                    <div class="col-lg-8">
                        <h4>1. Chọn hình thức giao hàng (chưa hoàn thiện)</h4>
                        <div class="border radio-item">
                                <div class="radio-ship">
                                    <input type="radio" name="ship-time" class="ship-time" checked id="on-day" value="300000" style="width: 2%;  height: auto;" >
                                    <label>Giao hàng nhanh</label>
                                    <div class="order-total" id="ship-on-day" style="display: none">
                                        <div class="order-btn">
                                            <div class="detail-ship border">
                                                <div class="lol">
                                                    <p>Giao vào {{$tomorrow}}, {{ $day_tomorrow }}/{{ $month_tomorrow }}</p>
                                                    <ul>
                                                        @foreach($cat_products as $cat_product)
                                                            <li>{{ $cat_product->quantity }} x {{ $cat_product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="lol-price">
                                                    <p style="float: left;">Giao hàng nhanh</p>
                                                    <p style="float: right">30.000 đ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="radio-ship">
                                    <input type="radio" name="ship-time" class="ship-time" id="two-days" value="15000" style="width: 2%;  height: auto;" >
                                    <label>Giao tiêu chuẩn</label>
                                    <div class="order-total" id="ship-2-days" style="display: none">
                                        <div class="order-btn">
                                            <div class="detail-ship border">
                                                <div class="lol">
                                                    <p>Giao vào {{$nextday}}, {{ $day_nextday }}/{{ $month_nextday }}</p>
                                                    <ul>
                                                        @foreach($cat_products as $cat_product)
                                                            <li>{{ $cat_product->quantity }} x {{ $cat_product->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="lol-price">
                                                    <p style="float: left;">Giao tiêu chuẩn</p>
                                                    <p style="float: right">15.000 đ</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <h4 style="margin-top: 20px;">2. Chọn hình thức thanh toán (chưa hoàn thiện)</h4>
                        <div class="border radio-item">
                            <div class="radio-ship">
                                <input type="radio" name="payment" class="ship-time" checked id="cod" value="COD" style="width: 2%;  height: auto;" >
                                <label>Thanh toán tiền mặt khi nhận hàng</label>
                            </div>
                            <div class="radio-ship">
                                <input type="radio" name="payment" class="ship-time" id="visa" value="visa" style="width: 2%;  height: auto;" >
                                <label>Thanh toán bằng thẻ quốc tế Visa, Master, JCB</label>
                            </div>
                            <div class="radio-ship">
                                <input type="radio" name="payment" class="ship-time" id="atm" value="atm" style="width: 2%;  height: auto;" >
                                <label>Thanh toán bằng thẻ ATM nội địa, Internet Banking</label>
                            </div>
                            <div class="radio-ship">
                                <input type="radio" name="payment" class="ship-time" id="momo" value="momo" style="width: 2%;  height: auto;" >
                                <label>Thanh toán bằng ví điện tử Momo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="place-order">
                            <h4>3. Thông tin </h4>
                            @if(session('msg'))
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!session('msg')!!}
                                </div>
                            @endif
                            <div class="user-profile">
                                <div class="user-edit">
                                    <p style="float: left;">Địa chỉ giao hàng</p>
                                    @if (isset($customer_default) || isset($customer))
                                    <a class="edit-address" href="{{ url('user/address') }}">Sửa</a>
                                    @endif
                                </div>
                                @if (isset($customer_default) && !empty($customer_default))
                                <div class="user-address">
                                    <h6>{{ $customer_default->name }}</h6>
                                    <p>Địa chỉ: {{ $customer_default->address }}, {{ $customer_default->ward }}, {{ $customer_default->district }}, {{ $customer_default->city }}</p>
                                    <p>Điện thoại: {{ $customer_default->phone }}</p>
                                </div>

                                @elseif (!isset($customer_default) && isset($customer) && !empty($customer))
                                    <div class="user-address">
                                        <h6>{{ $customer->name }}</h6>
                                        <p>Địa chỉ: {{ $customer->address }}, {{ $customer->ward }}, {{ $customer->district }}, {{ $customer->city }}</p>
                                        <p>Điện thoại: {{ $customer->phone }}</p>
                                    </div>
                                @else
                                    <div class="user-address" style="padding: 10px 0 28px 0">
                                        <p style="float: left;">Vui lòng thêm một địa chỉ giao hàng</p>
                                        <a class="add-address" href="{{ url('user/address') }}">Thêm</a>

                                    </div>
                                @endif
                            </div>
                            <?php
                            $ship_price = 30000;
                            if ($sub_total >= 500000 ) {
                                $ship_price = 0;
                            } else {
                                $ship_price;
                            }
                            if(isset($coupon)) {
                                if ($coupon['type'] == 'percent') {
                                    $discount =  $coupon['discount_percent'];
                                    $discount_price = $sub_total * (double) $discount / 100;
                                    $total = $sub_total- $discount_price + $ship_price;
                                } elseif ($coupon['type'] == 'price') {
                                    $discount =   $coupon['discount_price'];
                                    $discount_price = (double) $discount;
                                    $total = $sub_total - $discount_price + $ship_price;
                                }
                            } else {
                                $discount_price = 0 ;
                                $total = $sub_total + $ship_price;
                            }

                            ?>
                            <div class="user-profile" style="padding-bottom: 65px;">
                                <div class="user-edit">
                                    <p style="float: left;">Đơn hàng</p>
                                    <a class="edit-address" href="{{ url('cart') }}">Sửa</a>
                                </div>
                                @foreach($cat_products as $cat_product)
                                <div class="user-product">
                                    <p>{{ $cat_product->quantity}} x <span style="font-size: 10px;">{{ $cat_product->name }}</span> </p>
                                    <span class="price-product">{{ number_format($cat_product->price*$cat_product->quantity) }} vnđ</span>
                                </div>
                                @endforeach
                                <div class="user-address sub-total">
                                    <p>Tạm tính :  </p>
                                    <span>{{ number_format($sub_total) }} vnđ</span>
                                    <p>Mã giảm giá :  </p>
                                    @if(isset($coupon) && $coupon['type'] == 'percent')
                                        <span>- {{ $coupon['discount_percent'] }}%</span>
                                    @elseif(isset($coupon) && $coupon['type'] == 'price')
                                        <span>- {{ number_format($coupon['discount_price']) }} vnđ</span>
                                    @else
                                        <span>0</span>
                                    @endif
                                    <p>Phí vận chuyển :  </p>
                                    <span>+ {{ number_format($ship_price) }} vnđ</span>
                                    <p style="font-weight:bold;">Thành tiền :  </p>
                                    <span class="total-product" style="font-size: 16px;">{{ number_format($total) }} vnđ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4">
                            @if (isset($customer_default) && !empty($customer_default))
                                <input type="hidden" name="name" value="{{ $customer_default->name }}">
                                <input type="hidden" name="phone" value="{{ $customer_default->phone }}">
                                <input type="hidden" name="address" value="{{ $customer_default->address }} ,{{ $customer_default->ward }}, {{ $customer_default->district }}, {{ $customer_default->city }}">
                                <input type="hidden" name="note" value="{{ $customer_default->note }}">
                            @elseif (!isset($customer_default) && isset($customer))
                                <input type="hidden" name="name" value="{{ $customer->name }}">
                                <input type="hidden" name="phone" value="{{ $customer->phone }}">
                                <input type="hidden" name="address" value="{{ $customer->address }} ,{{ $customer->ward }}, {{ $customer->district }}, {{ $customer->city }}">
                                <input type="hidden" name="note" value="{{ $customer->note }}">
                            @endif
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="total_price" value="{{ $total }}">
                            <input type="hidden" name="promotion" value="{{ $discount_price }}">
                            <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                            <input type="hidden" name="ship_price" value="{{ $ship_price }}">
                            <button type="submit" class="primary-btn pd-cart" id="order-proceed" style="border: 0; margin-top: 20px; width: 300px; padding: 15px; font-size: 17px;">
                                <div id="payment">MUA HÀNG</div>
                                <div id="loading" style="display: none">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Vui lòng chờ...
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
        @endif
    </section>
    <script>
        $(document).ready(function () {
            //disable payment radio
            $('input[name="payment"]:not(:checked)').attr('disabled', true);
            //show hide radio ship
            if($("input[name='ship-time']:checked")) {
                $('#ship-2-days').hide();
                $('#ship-on-day').show();
            }
            $("input[name='ship-time']"),$("#on-day").change(function(e) {
                $('#ship-2-days').hide();
                $('#ship-on-day').show();
            });
            $("input[name='ship-time']"),$("#two-days").change(function(e) {
                $('#ship-2-days').show();
                $('#ship-on-day').hide();
            });
        })
        // ajax radio ship_price
       /* $(document).ready(function () {
            $('input[name="ship-time"]').on('change',function () {
                var ship_price = $('input[name="ship-time"]:checked').val();
                var dataPost = { ship_price : ship_price }
                var choose_ship_url = '<?php echo url('payment/choose-ship') ?>';
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: choose_ship_url,
                    type: 'post',
                    dataType: 'json',
                    data: dataPost,
                    success:function (result) {
                       window.location.reload();
                    }
                })
            });
        })*/
        $(document).ready(function(){
            $('#order-proceed').on('click',function () {
                $('#loading').show();
                $('#payment').hide();
                var add_order_url = '<?php echo url('payment') ?>';
                var dataPost = $(this).closest('form').serializeArray();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: add_order_url,
                    type: 'post',
                    dataType: 'json',
                    data: dataPost,
                    success:function (result) {
                        alert('success'.result);
                    }
                })
            })
        })
    </script>
@endsection
