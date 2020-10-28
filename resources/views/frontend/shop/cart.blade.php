@extends('frontend.layouts.app')
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
                <img src="{{ asset('front_ends/img/mascot@2x.png') }}" alt="" style="width: 200px;">
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
                                <th>Chi tiết</th>
                                <th>Đơn Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                @foreach($catProducts as $item)
                                @endforeach
                                <th><i class="ti-close closeAll" style="cursor: pointer" data-emptyImgUrl="{{ asset('front_ends/img/mascot@2x.png') }}" data-url="{{ url('/') }}"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($catProducts as $item)
                            <tr class="rowCart rowCart{{$item->id}}" id="{{$i}}">
                                <?php
                                $product_id = $item->attributes->product_id;
                                $images = json_decode($products[$product_id]->images);
                                ?>
                                <td class="cart-pic first-row"><a href="{{ url('products/'.$products[$product_id]->slug) }}">
                                        <img src="{{ asset($images[0]) }}" alt="" style="width: 120px;">
                                    </a></td>
                                <td class="cart-title first-row">
                                    <h5>{{ $item->name }}</h5>
                                </td>
                                <td class="close-td first-row" style="font-weight:bold;">
                                    Size: <span style=" color: #dba239;">{{ $item->attributes->size_name }}</span>
                                    Màu: <span style=" color: #dba239;">{{ $item->attributes->color_name }}</span>
                                    <p>Còn lại: <span style="font-weight: bold;">{{ $item->attributes->quantityStock }}</span></p>
                                </td>
                                <td class="p-price first-row">{{ number_format($item->price) }} VNĐ</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <form action="{{ url('cart') }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="pro-qty" data-id="{{ $item->id }}">
                                                <input type="text" name="quantity" value="{{ $item->quantity }}" class="quantity-btn quantity-btn-{{ $item->id }}" data-quantity="{{ $item->quantity }}" data-price="{{ $item->price }}" data-stock="{{ $item->attributes->quantityStock }}" min="1" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="total-price first-row totalPricre{{$item->id}}">{{ number_format($item->price* $item->quantity) }} VNĐ</td>
                                <td class="close-td first-row">
                                    <i class="ti-close" data-rowId="{{ $item->id }}"></i>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="{{ url('/') }}" class="primary-btn continue-shop" style="color:#e7ab3c;">Tiếp tục mua sắm</a>
                        </div>
                        <div class="discount-coupon">
                            <h6>Mã giảm giá</h6>
                            <p>Nhập mã Coupon để được giảm 100k, mã VAS giảm 200k, mã vietanh giảm 10%</p>
                            <p>Đặc biệt nhập mã VietAnhDepTrai để được giảm 90%, rẻ như cho không!!!</p>
                            <form action="{{ url('cart/coupon') }}" class="coupon-form" method="POST">
                                @csrf
                                <input type="text" placeholder="Nhập mã giảm giá" name="code" id="code">
                                <button type="submit" class="site-btn coupon-btn">Nhập</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Tổng tiền <span class="subTotal">{{ number_format($subTotal) }} VNĐ</span></li>
                                <?php
                                $subTotal = \Cart::getSubTotal();
                                if (session()->has('coupon')) {
                                    $coupon = session()->get('coupon');
                                    if ($coupon['type'] == 'percent') {
                                        $discount =  $coupon['discount_percent'];
                                        $total = $subTotal - ($subTotal * (float) $discount / 100);
                                    } elseif ($coupon['type'] == 'price') {
                                        $discount =   $coupon['discount_price'];
                                        $total = $subTotal - (float) $discount;
                                    }
                                } else {
                                    $discount = 0 . '<br>';
                                    $total = $subTotal - (float) $discount;
                                }
                                ?>
                                <li class="subtotal">Mã giảm giá
                                    <span style="margin-left: 15px;">
                                        <button type="button" class="close close-coupon" aria-label="Close" data-button='{{{ $total }}}'>
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
                                <li class="cart-total">Thanh toán <span id="totalCart">{{ $subTotal > 0 ? number_format($total) : 0 }} VNĐ</span></li>
                            </ul>
                            @if(Auth::check() && !empty(Auth::user()->email_verified_at))
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
<!-- Shopping Cart Section End -->
<script>
    //update cart
    $(document).ready(function() {
        $(document).on('change', '.quantity-btn', function(e) {
            e.preventDefault();
            var update_cart_url = '<?php echo url('cart') ?>';
            var id = $(this).closest('.pro-qty').attr('data-id');
            var quantity = parseInt($('.quantity-btn-' + id).val());
            var quantityStock = parseInt($('.quantity-btn-' + id).attr('data-stock'));
            var product_price = $('.quantity-btn-' + id).attr('data-price');
            var data_quantity = $('.quantity-btn-' + id).attr('data-quantity');
            if (quantity > quantityStock) {
                toastr.error('Số lượng sản phẩm trong kho không đủ');
                $('.quantity-btn-' + id).val(data_quantity);
                breakOut = true;
                return false;
            }
            if (quantity == 0) {
                toastr.error('Vui lòng nhập số lượng');
                $('.quantity-btn-' + id).val(data_quantity);
                breakOut = true;
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: update_cart_url,
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    quantity: quantity,
                    product_price: product_price,
                    quantityStock: quantityStock,
                },
            }).done(function(result) {
                $('.quantity-btn-' + id).attr('data-quantity', quantity);
                $('.countCart').html(result.quantityCart);
                $('.totalPricre' + result.id).html(result.totalPrice);
                $('.cart-price, .subTotal').html(result.subTotal);
                $('#totalCart').html(result.total);
                $('.select-total').html('<span>Tổng tiền:</span><h5>' + result.total + '</h5>');
                $('.quantityCart' + result.id).html(result.quantity);
                $('.quantityCart' + result.id).attr('data-quantity-' + result.id + '', result.quantity);

            });
        })
        $('.inc').on('click', function(e) {
            e.preventDefault();
            var update_cart_url = '<?php echo url('cart') ?>';
            var id = $(this).closest('.pro-qty').attr('data-id');
            var quantity = parseInt($('.quantity-btn-' + id).val()) + 1;
            var product_price = $('.quantity-btn-' + id).attr('data-price');
            var quantityStock = parseInt($('.quantity-btn-' + id).attr('data-stock'));
            var data_quantity = $('.quantity-btn-' + id).attr('data-quantity');
            if (quantity > quantityStock) {
                breakOut = true;
                return false;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: update_cart_url,
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    quantity: quantity,
                    product_price: product_price,
                    quantityStock: quantityStock,
                },
            }).done(function(result) {
                $('.quantity-btn-' + id).attr('data-quantity', quantity);
                $('.countCart').html(result.quantityCart);
                $('.totalPricre' + result.id).html(result.totalPrice);
                $('.cart-price, .subTotal').html(result.subTotal);
                $('#totalCart').html(result.total);
                $('.select-total').html('<span>Tổng tiền:</span><h5>' + result.total + '</h5>');
                $('.quantityCart' + result.id).html(result.quantity);
                $('.quantityCart' + result.id).attr('data-quantity-' + result.id + '', result.quantity);
            });
        })
        $('.dec').on('click', function(e) {
            e.preventDefault();
            var update_cart_url = '<?php echo url('cart') ?>';
            var id = $(this).closest('.pro-qty').attr('data-id');
            var quantity = parseInt($('.quantity-btn-' + id).val()) - 1;
            var product_price = $('.quantity-btn-' + id).attr('data-price');
            var quantityStock = $('.quantity-btn-' + id).attr('data-stock');
            var data_quantity = $('.quantity-btn-' + id).attr('data-quantity');
            if (quantity == 0) {
                breakOut = true;
                return false;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: update_cart_url,
                dataType: 'json',
                type: 'PUT',
                data: {
                    id: id,
                    quantity: quantity,
                    product_price: product_price,
                    quantityStock: quantityStock,
                },
            }).done(function(result) {
                $('.quantity-btn-' + id).attr('data-quantity', quantity);
                $('.countCart').html(result.quantityCart);
                $('.totalPricre' + result.id).html(result.totalPrice);
                $('.cart-price, .subTotal').html(result.subTotal);
                $('#totalCart').html(result.total);
                $('.select-total').html('<span>Tổng tiền:</span><h5>' + result.total + '</h5>');
                $('.quantityCart' + result.id).html(result.quantity);
                $('.quantityCart' + result.id).attr('data-quantity-' + result.id + '', result.quantity);
            });
        })
    })
</script>
@endsection