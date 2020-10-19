@extends('frontend.layouts.app')
@section('title')
{{ $product->name }}
@endsection
@section('content')
<style>
    .radio-color {
        position: absolute;
        visibility: hidden;
    }

    .radio-inline {
        height: 30px;
        width: 30px;
        cursor: pointer;
        margin-right: 10px;
    }

    .pd-color .color-name {
        font-size: 14px;
        font-weight: 500;
        margin-left: 15px;
    }
</style>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="{{ url('/categories/'.$product->category->slug) }}">{{ $product->category->name}}</a>
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
                <div class="row">
                    <div class="col-lg-5">
                        <div class="product-pic-zoom">
                            <?php $images  = json_decode($product->images) ?>
                            <img class="product-big-img" src="{{ asset($images[0]) }}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                @foreach($images as $image)
                                <div class="pt active" data-imgbigurl="{{ asset($image) }}"><img src="{{ asset($image) }}" alt=""></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                        <form action="{{ url('cart/add') }}" method="post">
                            @csrf
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->category->name }}</span>
                                    <h3>{{ $product->name }}</h3>
                                    <a href="{{ url('wishlists/'.$product->id) }}" class="heart-icon" id="add-wish-list" title="Thêm sản phẩm yêu thích">
                                        <i style="color: #e7ab3c" class="fa @if($count_wishlist == 0) fa-heart-o @endif fa-heart" aria-hidden="true"></i>
                                    </a>
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
                                    <p><?php echo $product->intro; ?></p>
                                    @if($product->priceSale >0)
                                    <h4>{{ number_format($product->priceSale) }} VNĐ<span>{{ number_format($product->priceCore) }} VNĐ</span></h4>
                                    @else
                                    <h4>{{ number_format($product->priceCore) }} VNĐ</h4>
                                    @endif
                                </div>
                                <div class="pd-color">
                                    <h6>Màu <span class="color-name"></span></h6>
                                    <div class="pd-color-choose">
                                        @foreach($properties as $property)
                                        <?php
                                        $listSize = json_encode($property);
                                        ?>
                                        <label class="radio-inline" style="background-color: {{ $property['color'] }}">
                                            <input type="radio" name="color_id" class="radio-color" value="{{ $property['color_id'] }}" data-name="{{ $property['color_name']}}" data-color="{{ $listSize }}">
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="pd-size-choose">
                                    <h6>Size</h6>
                                    @foreach($sizes as $size)
                                    <div class="sc-item">
                                        <label>
                                            <input type="radio" name="size_id" class="size" value="{{ $size->size_id }}" data-quantity="">
                                            {{ $size->size_name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    <div class="log"></div>
                                </div>

                                <div class="quantity">
                                    <div class="pro-qty">
                                        <!-- Chỉ nhập số-->
                                        <input type="text" id="quantity" name="quantity" value="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @if(isset($size))
                                    <button type="submit" class="primary-btn pd-cart" id="add-to-cart" data-product-id="{{ $product->id  }}" style="border:none; padding: 14px 25px 10px">Thêm vào giỏ hàng</button>
                                    @else
                                    <button type="submit" disabled class="primary-btn pd-cart" id="add-to-cart" data-product-id="{{ $product->id  }}" style="border:none; background: darkgray;">Hết hàng</button>
                                    @endif
                                </div>

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

                <!-- bl -->
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
<script>
    $(document).ready(function() {
        $("input[name='color_id']").change(function(e) {
            var colorName = $(this).attr('data-name');
            $('.color-name').html(colorName);
            var color = JSON.parse($(this).attr('data-color'));
            console.log(color.sizes);
            var i;

        });
    })
</script>
@endsection