@extends('frontend.layouts.shop')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row" id="rowEmptyCart">
                @if(Cart::isEmpty())
                <?php
                session()->forget('coupon');
                ?>
               <div class="col-lg-12 empty-cart" style="text-align: center; margin-bottom: 80px;">
                   <img src="{{ asset('front-ends/img/mascot@2x.png') }}" alt="" style="width: 200px;">
                   <h6 style="color: #999999; font-size: 16px; margin: 1rem;">Giỏ hàng của bạn đang trống</h6>
                   <a href="{{ url('/') }}" class="primary-btn pd-cart" style="border-radius: 0.25rem">Tiếp tục mua sắm</a>
               </div>
                @else
                <div class="col-lg-12 contentCart">
                    <div class="cart-table">
                        <table>
                            <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th class="p-name">Sản phẩm</th>
                                <!-- <th>Size</th> -->
                                <th>Đơn Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                @foreach($cat_products as $cat_product)
                                @endforeach
                                <th><i class="ti-close closeAll" style="cursor: pointer" data-emptyImgUrl="{{ asset('front-ends/img/mascot@2x.png') }}" data-url="{{ url('/') }}"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            @foreach($cat_products as $item)
                            <tr class="rowCart rowCart{{$item->id}}" id="{{$i}}">
                                <?php
                                $product_id = $item->id;
                                $images = (isset($products[$product_id]->images) && $products[$product_id]->images) ? json_decode($products[$product_id]->images) : array();
                                ?>
                                <td class="cart-pic first-row"><a href="{{ url('product/'.$product_id) }}">
                                        @foreach($images as $image)
                                        <img src="{{ asset($image) }}" alt="" style="width: 120px;">
                                        @break;
                                        @endforeach
                                    </a></td>
                                <td class="cart-title first-row">
                                    <h5>{{ $item->name }}</h5>
                                </td>
                               <!-- <td class="close-td first-row" style="font-weight:bold; color: #dba239;">{{ $item->attributes->size }}</td> -->
                                <td class="p-price first-row">{{ number_format($item->price) }} VNĐ</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <form action="{{ url('cart/update') }}" method="POST">
                                            @csrf
                                            <div class="pro-qty">
                                               <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" onchange="updateCart(this.value,'{{ $product_id }}', '{{ $item->price }}')" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                                            </div>
                                        </form>

                                    </div>
                                </td>
                                <td class="total-price first-row totalPricre{{$item->id}}">{{ number_format($item->price* $item->quantity) }} VNĐ</td>
                                <td class="close-td first-row">
                                    <i class="ti-close" data-rowId="{{ $item->id }}"></i>
                                </td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="{{ url('/') }}" class="primary-btn continue-shop" style="color:#e7ab3c;">Tiếp tục mua sắm</a>
                            </div>
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
                            @if(session('msg'))
                                <div class="alert alert-warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!session('msg')!!}
                                </div>
                            @endif
                            <div class="discount-coupon">
                                <h6>Mã giảm giá</h6>
                                <p>Nhập mã Coupon để được giảm 100k, mã VAS giảm 200k, mã vietanh giảm 10%</p>
                                <p>Đặc biệt nhập mã VietAnhDepTrai để được giảm 90%, rẻ như cho không!!!</p>
                                <form action="{{ url('cart/add-coupon') }}" class="coupon-form" method="POST">
                                    @csrf
                                    <input type="text" placeholder="Nhập mã giảm giá" name="code" id="code" >
                                    <button type="submit" class="site-btn coupon-btn">Nhập</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Tổng tiền <span class="subTotal">{{ number_format($sub_total) }} VNĐ</span></li>
                                    <?php
                                    $sub_total = \Cart::getSubTotal();
                                    if(session()->has('coupon')) {
                                        $coupon =session()->get('coupon');
                                        if ($coupon['type'] == 'percent') {
                                            $discount =  $coupon['discount_percent'];
                                            $total = $sub_total- ($sub_total * (double) $discount / 100);
                                        } elseif ($coupon['type'] == 'price') {
                                            $discount =   $coupon['discount_price'];
                                            $total = $sub_total - (double) $discount;
                                        }
                                    } else {
                                        $discount = 0 .'<br>';
                                        $total = $sub_total - (double) $discount;
                                    }
                                    ?>

                                    <li class="subtotal">Mã giảm giá
                                        <span style="margin-left: 15px;">
                                            <button type="button"  class="close close-coupon" aria-label="Close" data-button='{{{ $total }}}'>
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </span>
                                        <span id="couponName"><?php echo  isset($coupon) ? $coupon['name'] : '' ?></span>
                                    </li>
                                    <li class="subtotal">Giảm
                                        @if(isset($coupon))
                                            @if($coupon['type'] == 'percent')
                                            <span id="couponValue">- {{ $discount }} % </span>
                                            @elseif ($coupon['type'] == 'price')
                                            <span id="couponValue">- {{ number_format($discount) }} VNĐ</span>
                                            @endif
                                        @else
                                            <span id="couponValue">- 0 VNĐ</span>
                                        @endif
                                    </li>
                                    <li class="cart-total">Thanh toán <span id="totalCart">{{ $sub_total>0 ? number_format($total) : 0 }} VNĐ</span></li>
                                    
                                </ul>
                                @if(Auth::check())
                                    <a href="{{ url('payment') }}" class="proceed-btn" style="background: #e7ab3c;">TIẾN HÀNH THANH TOÁN</a>
                                @else
                                    <a href="#myModal" class="proceed-btn" data-toggle="modal" data-target=".bd-example-modal-lg" style="background: #e7ab3c;">TIẾN HÀNH THANH TOÁN</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Shopping Cart Section End -->
    <script>
        // update
        function updateCart(quantity,product_id, product_price) {
            var update_cart_url = '<?php echo url('cart/update')?>';
            var dataPost = {quantity: quantity, product_id: product_id, product_price: product_price};
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: update_cart_url,
                dataType: 'json',
                type: 'post',
                data: dataPost,
            }).done(function(result){
                $('.countCart').html(result.quantityCart);
                $('.totalPricre'+result.id).html(result.totalPrice);
                $('.cart-price, .subTotal').html(result.subTotal);
                $('#totalCart').html(result.total);
                $('.select-total').html('<span>Tổng tiền:</span>'+
                                        '<h5>'+ result.total +'</h5>');
                $('.quantityCart'+result.id).html(result.quantity);
                $('.quantityCart'+result.id).attr('data-quantity-'+result.id+ '', result.quantity);
            });
        };

        $(document).ready(function () {
           
            //xóa hết
            $('.closeAll').on('click', function (e) {
                var clear_cart_url = '<?php echo url('cart/clear')?>';
                // var emtyImg = $(this).attr('data-emptyImgUrl');
                // var url = $(this).attr('data-url');
                //console.log(emptyImg);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: clear_cart_url,
                    type: 'post',
                    dataType : 'json',
                }).done(function(result){
                    if(result.msg === 'success') {
                        toastr.success('Xoá giỏ hàng thành công');
                        $('.contentCart').remove();
                        html = '';
                        html += '<div class="col-lg-12 empty-cart" style="text-align: center; margin-bottom: 80px;">'+
                                '<img src="" alt="" style="width: 200px;">'+
                                '<h6 style="color: #999999; font-size: 16px; margin: 1rem;">Giỏ hàng của bạn đang trống</h6>'+
                                '<a href="" class="primary-btn pd-cart" style="border-radius: 0.25rem">Tiếp tục mua sắm</a>'+
                                '</div>';
                        $('#rowEmptyCart').html(html);
                    } else {
                        toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
                    }
                });
            });
            //add coupon
            $('.coupon-btn').on('click', function (e) {
                e.preventDefault();
                var add_coupon_url = '<?php echo url('cart/add-coupon')?>';
                var couponName = $('#code').val();
                $('#code').empty();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: add_coupon_url,
                    type: 'post',
                    dataType: 'json',
                    data: { code : couponName},
                }).done(function(result) {
                    if(result.msg === 'success') {
                        toastr.success('Thêm mã giảm giá thành công');
                        $('#code').val('');
                        $('#couponName').html(result.couponName);
                        $('#totalCart').html(result.totalPrice);
                        $('#couponValue').html(result.couponValue);
                    } else if (result.msg === 'error') {
                        toastr.error('Mã giảm giá không đúng');
                    } else {
                        toastr.error('Vui lòng thử lại sau','Có lỗi xảy ra');
                    }
                   
                });
            });
            //remove coupon
            $('.close-coupon').on('click', function (e) {
               
                var remove_coupon_url = '<?php echo url('cart/remove-coupon')?>';
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: remove_coupon_url,
                    dataType:'json',
                    type: 'post',
                }).done(function(result){
                
                    if(result.msg === 'success') {

                        toastr.success('Xóa mã giảm giá thành công');
                        $('#couponName').empty();
                        $('#totalCart').html(result.total);
                        $('#couponValue').html('- 0 VNĐ');
                    } else {
                        toastr.error('Vui lòng thử lại sau','Có lỗi xảy ra');
                    }
                });
            });

        });

    </script>
@endsection
