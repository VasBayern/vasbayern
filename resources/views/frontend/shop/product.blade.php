@extends('frontend.layouts.app')
@section('title')
    {{ $product->name }}
@endsection
@section('content')

    <style>
        .new {
            color: #ffffff;
            font-size: 10px;
            background: #76BC42;
            position: absolute;
            right: 0;
            top: 20px;
            padding: 5px 10px;
            text-transform: uppercase;
            border-radius: 20px;
        }
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            ul.tab li {
                width: 500px;
            }
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
            ul.tab li {
                width: 500px;
            }
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{ url('/category/'.$product->cat_id) }}">Danh mục</a>
                        <span>{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php $images = (isset($product->images) && $product->images) ? json_decode($product->images) : array() ?>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-pic-zoom">
                                @foreach($images as $image)
                                <img class="product-big-img" src="{{ asset($image) }}" alt="">
                                    @break
                                @endforeach
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach($images as $image)
                                    <div class="pt active" data-imgbigurl="{{ asset($image) }}"><img
                                            src="{{ asset($image) }}" alt="" ></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5">
                            <form action="{{ url('cart/add') }}" method="post">
                                @csrf

                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->category->name }}</span>
                                    <h3>{{ $product->name }}</h3>
                                    @if($count_wishlist == 0)
                                    <a href="{{ url('user/wishlist/'.$product->id) }}" class="heart-icon" id="add-wish-list" title="Thêm sản phẩm yêu thích">
                                        <i style="color: #e7ab3c" class="fa fa-heart-o"  aria-hidden="true"></i>
                                    </a>
                                    @else
                                        <a href="{{ url('user/wishlist/'.$product->id) }}" class="heart-icon" id="add-wish-list" title="Thêm sản phẩm yêu thích">
                                            <i style="color: #e7ab3c" class="fa fa-heart"  aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="pd-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span>(5)</span>
                                </div>
                                <div class="pd-desc">
                                    <p><?php echo $product->intro;?></p>
                                    @if($product->priceSale >0)
                                    <h4>{{ number_format($product->priceSale) }} VNĐ<span>{{ number_format($product->priceCore) }} VNĐ</span></h4>
                                    @else
                                    <h4>{{ number_format($product->priceCore) }} VNĐ</h4>
                                    @endif
                                </div>

                                <div class="pd-size-choose">
                                    @if(isset($product->product_properties) && count($product->product_properties) >0)
                                        @foreach($product->product_properties as $size)
                                            <div class="sc-item">
                                                <label>
                                                    <input type="radio" name="size_id" class="size" value="{{ $size->size_id }}" data-quantity="{{ $size->quantity }}">
                                                    {{ $size->size->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    @endif
                                    <div class="log"></div>
                                </div>

                                <div class="quantity">
                                    <div class="pro-qty">
                                        <!-- Chỉ nhập số-->
                                        <input type="text" id="quantity" name="quantity" value="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        {{--<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />--}}
                                    </div>
                                    {{--<a href="{{ url('cart/add/{') }}" data-product-id=" {{ $product->id }}" class="primary-btn pd-cart">Add To Cart</a>--}}
                                    <input type="hidden" class="cart-btn" name="product_id" value="{{ $product->id }}">
                                    @if(isset($size) && $size->quantity > 0)
                                        <button type="submit" class="primary-btn pd-cart" id="add-to-cart" data-product-id="{{ $product->id  }}" style="border:none; padding: 14px 25px 10px">Thêm vào giỏ hàng</button>
                                    @else
                                        <button type="submit" disabled class="primary-btn pd-cart" id="add-to-cart" data-product-id="{{ $product->id  }}" style="border:none; background: darkgray;">Hết hàng</button>
                                    @endif

                                </div>
                                <p class='amount-remain' style="display: none">Còn lại <span id='amount' style="font-weight:bold;">@if(isset($size)){{ $size->quantity }}@endif</span> sản phẩm trong kho</p>

                                <ul class="pd-tags">
                                    <li><span>CATEGORIES</span>: More Accessories, Wallets & Cases</li>
                                    <li><span>TAGS</span>: Clothing, T-shirt, Woman</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Sku : 00012</div>
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>

                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist" >
                                <li>
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">Chi tiết sản phẩm</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-2" role="tab">Thông số sản phẩm</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews ({{ $count_cmt }})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                              <?php echo $product->desc?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <span>(5)</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Giá sản phẩm</td>
                                                <td>
                                                    <div class="p-price">
                                                        @if($product->priceSale >0)
                                                            {{ number_format($product->priceSale) }} VNĐ<span style="margin-left: 10px;font-size: 13px; text-decoration: line-through; color: #888 ">{{ number_format($product->priceCore) }} VNĐ</span>
                                                        @else
                                                            {{ number_format($product->priceCore) }} VNĐ
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Số lượng</td>
                                                <td>
                                                    <div class="p-stock">22 in stock</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Size</td>
                                                <td>
                                                    <div class="p-size">
                                                        @if(isset($product->product_properties) && count($product->product_properties) >0)
                                                            @foreach($product->product_properties as $size)
                                                                <label style="padding: 5px 10px; border: 1px solid #888">
                                                                    {{ $size->size->name }}
                                                                </label>
                                                            @endforeach
                                                        @else
                                                            <label style="padding: 5px 10px; border: 1px solid #888">Tạm hết hàng</label>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Màu</td>
                                                <td><span class="cs-color"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{--{{ count($comments->id) }}--}}</h4>
                                        @foreach($comments as $cmt)
                                        <div class="comment-option">
                                            <div class="co-item">
                                                <div class="avatar-pic">
                                                    @if(isset($cmt->user->image) && !empty($cmt->user->image) )
                                                        <img src="{{ URL::to('/') }}/front-ends/img/user-image/{{ $cmt->user->image }}" style="border-radius: 50%; width: 60px; height: 60px; margin-top: 10px;"/>
                                                    @else
                                                        <img src="{{ URL::to('/') }}/front-ends/img/user-image/avt.jpg" style="border-radius: 50%; width: 60px; height: 60px; margin-top: 10px;"/>
                                                    @endif
                                                </div>
                                                <div class="avatar-text">
                                                    <div class="at-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <h5>{{ $cmt->user->name }} <span>{{ $cmt->created_at }}</span></h5>
                                                    <div class="at-reply">{{ $cmt->review }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="leave-comment">
                                            <h4>Thêm đánh giá</h4>
                                            @if(Auth::check())
                                            <form action="{{ url('product/'.$product->id.'/comment') }}" class="comment-form" method="post">
                                                @csrf
                                               {{-- <div id="rateBox"></div>
                                                <script>
                                                    $("#rateBox").rate({
                                                        length: 5,
                                                        value: 3.5,
                                                        readonly: false,
                                                        size: '48px',
                                                        selectClass: 'fxss_rate_select',
                                                        incompleteClass: 'fxss_rate_no_all_select',
                                                        customClass: 'custom_class',
                                                        callback: function(object){
                                                            console.log(object)
                                                        }
                                                    });
                                                </script>--}}
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" value="{{ Auth::user()->name }}" readonly>
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="text" value="{{ Auth::user()->email }}" readonly>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <textarea placeholder="Bình luận ..." name="review">{{ old('review') }}</textarea>
                                                        <button type="submit" class="site-btn">Bình luận</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                                <h6><a href="#myModal" style=" color: #e5a226;font-size: 20px;padding-right: 10px;" class="login-panel trigger-btn" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Đăng nhập để bình luận</a></h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($related_products as $related_product)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <?php $images = (isset($related_product->images) && $related_product->images) ? json_decode($related_product->images) : array() ?>
                            @foreach($images as $image)
                                <img src="{{ asset($image) }}" alt="">
                                @break
                            @endforeach
                            @if($related_product->priceSale> 0)
                                <div class="sale pp-sale" style="border-radius: 20px;">Sale</div>
                            @endif
                            @if($related_product->new == 1)
                                <div class="new pp-new">New</div>
                            @endif
                            <ul>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                <li class="quick-view"><a href="{{ url('product/'.$related_product->id) }}">+ Quick View</a></li>
                                <li class="w-icon active"><a href="#"> <i class="icon_heart_alt"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{ $related_product->category->name }}</div>
                            <a href="{{ url('product/'.$related_product->id) }}">
                                <h5>{{ $related_product->name }}</h5>
                            </a>
                            @if($related_product->priceSale == 0)
                                <div class="product-price">{{ number_format( $related_product->priceCore)  }} VNĐ</div>
                            @else
                                <div class="product-price">{{ number_format( $related_product->priceSale) }} VNĐ<span style="margin-left: 10px;">{{ number_format( $product->priceCore)  }} VNĐ</span></div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
    <!-- Modal -->
    <div id="myModal-cart" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn đã thêm sản phẩm vào giỏ hàng thành công</h4>
                </div>
                <div class="modal-body">
                    <p style="text-align: center">
                        <a href="{{ url('/cart') }}" class="btn btn-success">Thanh toán</a>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Tiếp tục mua sắm</button>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            // mua hàng thành công
            $('#add-to-cart').on('click', function (e) {
                e.preventDefault();
                var add_cart_url = '<?php echo url('cart/add') ?>';
                var dataPost = $(this).closest('form').serializeArray();
                
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: add_cart_url,
                    dataType:'json',
                    type:'POST',
                    data:  dataPost,
                    success: function(result){
                        $('#myModal-cart').modal('show');
                        $('.countCart').html(result.quantityCart);
                        $('.emptyCart').remove();
                        $('.select-total').html('<span>Tổng tiền:</span>'+
                                                '<h5>'+ result.total +'</h5>');
                        $('.cart-price').html(result.total);

                        let i;
                        let html = ''; 
                       
                        if($('.rowCart'+result.id).length > 0){
                            let oldQuantity = parseInt($('.quantityCart'+result.id).attr('data-quantity-'+result.id+ ''));
                            let newQuantity = parseInt(result.quantity); 
                            let quantity = newQuantity+oldQuantity;
                            $('.quantityCart'+result.id).html(quantity);
                            $('.quantityCart'+result.id).attr('data-quantity-'+result.id+ '', quantity);
                        } else {
                            for(i=0; i<1000; i++) {
                                html += '<tr class="rowCart'+ result.id +'">'+
                                    '<td class="si-pic">' +   
                                    '<img src="" alt="" style="width: 100px; ">'+       
                                    '</td>'+           
                                    '<td class="si-text">'+
                                    '<div class="product-selected">'+
                                    '<p>'+ result.price +'x <span class="quantityCart'+result.id+'" data-quantity-'+result.id+'="'+result.quantity+'">'+ result.quantity +'</span></p>'+
                                    '<h6>'+ result.name +'</h6>'+
                                    '</div>'+
                                    '</td>'+
                                    '<td class="si-close" >'+
                                    '<i class="ti-close" data-rowId="'+ result.id +'"></i>'+
                                    '</td>'+
                                    '</tr>';
                                break;
                            }
                        }
                        $('.cartBody').append(html);
                    }
                });
            });

            //đổi quantity size
            $("input[name='size_id']"),$(".size").change(function(e) {
                var size_id = $(this).val();
                var quantity = $(this).attr('data-quantity');
                $('.amount-remain').show();
                $('#amount').html(quantity);
                $('#amount').attr('data-qty',quantity);
                //$('#quantity').prop('max', quantity).prop('min', 1);
                //$('#quantity').val('1').prop('checked',false).prop('selected', false);
            });
            // chọn số lượng mua hàng
            $('#add-to-cart').on('click', function (e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                var size_qty = parseInt($('#amount').attr('data-qty'));
                if (quantity>0) {
                    if(quantity>size_qty) {
                        alert('Vui lòng chọn số lượng ít hơn');
                    }
                } else {
                    alert('Vui lòng chọn số lượng muốn mua');
                }
            })
            //thêm sp yêu thích
            $('#add-wish-list').on('click', function (e) {
                e.preventDefault();
                $('.fa-heart-o').removeClass('fa-heart-o').addClass('fa-heart');
                var url=$(this).attr('href');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'post',
                    url: url,
                }).done(function (result) {
                    if (result['msg'] === 'success') {
                        toastr.success('Thêm sản phẩm yêu thích thành công');
                    } else if (result['msg'] === 'error') {
                        toastr.error('Sản phẩm đã được thêm từ trước');
                    } else if (result['msg'] === 'not exist') {
                        toastr.error('Vui lòng thử lại','Không có sản phẩm')
                    } else {
                        toastr.error('Vui lòng thử lại sau', 'Có lỗi xảy ra');
                    }
                })
            })
        });
    </script>
@endsection
