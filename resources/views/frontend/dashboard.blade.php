<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@section('title')
Trang chủ
@endsection
<!-- Head Begin -->
@include('frontend.partials.head')
<!-- Head End -->

<body>
    <!-- Header Section Begin -->
    @include('frontend.partials.header')
    <!-- Header End -->
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            @foreach($banner_mains as $banner_main)
            <div class="single-hero-items set-bg" data-setbg="url({{ $banner_main->image }})" style="background-image: url({{ $banner_main->image }}); max-height: 600px; padding-top: 140px">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 banner">
                            <?php echo $banner_main->intro ?>
                            <a href="{{ url('/').$banner_main->link }}" class="primary-btn">MUA NGAY</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <?php echo $banner_main->desc ?>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                @foreach($parent_categories as $parent_category)
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="{{ asset($parent_category->image) }}" alt="" height="200px">
                        <div class="inner-text">
                            <a href="{{ url('/categories/'.$parent_category->slug) }}">
                                <h4>{{ $parent_category->name }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    @foreach($banner_sale_1 as $sale_1)
                    @if (isset($sale_1->id))
                    <div class="product-large set-bg" data-setbg="{{ url($sale_1->image) }}" style="background-image: url({{ $sale_1->image }})">
                        <?php echo $sale_1->intro ?>
                        <a href="{{ url($sale_1->link) }}">Xem Ngay</a>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            @foreach($parent_1_categories as $key => $parent_category)
                            <li class="parent_1_Category parent_1_Category{{ $key}}" data-parentId="{{ $key }}" data-group="1">{{ $parent_category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach($parent_1_categories as $key => $parent_category)
                    <div class="product-slider product-slider-1 owl-carousel product_1_Slider{{ $key }}">
                        <?php
                        $products = \App\Models\ShopProductModel::where('cat_id', $parent_category->id)->where('homepage', 1)->orderBy('updated_at', 'DESC')->get();
                        ?>
                        @foreach($products as $product)
                        <div class="product-item">
                            <div class="pi-pic">
                                <?php $images = (isset($product->id) && $product->images) ? json_decode($product->images) : array(); ?>
                                @foreach($images as $image)
                                <img src="{{ asset($image) }}" alt="">
                                @break;
                                @endforeach
                                @if($product->priceSale > 0)
                                <div class="sale pp-sale" style="border-radius: 20px;">Sale</div>
                                @endif
                                @if($product->new == 1)
                                <div class="new pp-new">New</div>
                                @endif
                                <ul>
                                    <li class="w-icon"><a href="#1"><i class="fa fa-random"></i></a></li>
                                    <li class="quick-view"><a href="#" id="quick-view" data-toggle="modal" data-target="#modalQuickView{{$product->id}}" data-id="{{ $product->id }}">+ Xem nhanh</a></li>
                                    <li class="w-icon active"><a href="#{{ url('wishlists') }}" title="Thêm sản phẩm yêu thích" id="add-wish-list"> <i class="icon_heart_alt"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $product->category->name }}</div>
                                <a href="{{ url('products/'.$product->slug) }}">
                                    <h5>{{ $product->name }}</h5>
                                </a>
                                @if($product->priceSale == 0)
                                <div class="product-price">{{ number_format( $product->priceCore)  }} VNĐ</div>
                                @else
                                <div class="product-price">{{ number_format( $product->priceSale) }} VNĐ<span style="margin-left: 10px;">{{ number_format( $product->priceCore)  }} VNĐ</span></div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <?php
        $products = \App\Models\ShopProductModel::where('homepage', 1)->orderBy('updated_at', 'DESC')->get();
        ?>
        @foreach($products as $product)
        <!-- Modal: modalQuickView -->
        <div class="modal fade" id="modalQuickView{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <!-- Women Banner Section End -->

    <!-- Deal Of The Week Section Begin-->
    <!-- <section class="deal-of-week set-bg spad" data-setbg="img/time-bg.jpg">
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed<br /> do ipsum dolor sit amet,
                        consectetur adipisicing elit </p>
                    <div class="product-price">
                        $35.00
                        <span>/ HanBag</span>
                    </div>
                </div>
                <div class="countdown-timer" id="countdown">
                    <div class="cd-item">
                        <span>56</span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span>12</span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span>40</span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span>52</span>
                        <p>Secs</p>
                    </div>
                </div>
                <a href="#" class="primary-btn">Shop Now</a>
            </div>
        </div>
    </section> -->
    <!-- Deal Of The Week Section End -->

    <!-- Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control">
                        <ul>
                            @foreach($parent_2_categories as $key => $parent_category)
                            <li class="parent_2_Category parent_2_Category{{ $key}}" data-parentId="{{ $key }}" data-group="1">{{ $parent_category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach($parent_2_categories as $key => $parent_category)
                    <div class="product-slider product-slider-2 owl-carousel product_2_Slider{{ $key }}">
                        <?php
                        $products = \App\Models\ShopProductModel::where('cat_id', $parent_category->id)->where('homepage', 1)->orderBy('updated_at', 'DESC')->get();
                        ?>
                        @foreach($products as $product)
                        <div class="product-item">
                            <div class="pi-pic">
                                <?php $images = (isset($product->id) && $product->images) ? json_decode($product->images) : array(); ?>
                                @foreach($images as $image)
                                <img src="{{ asset($image) }}" alt="">
                                @break;
                                @endforeach
                                @if($product->priceSale > 0)
                                <div class="sale pp-sale" style="border-radius: 20px;">Sale</div>
                                @endif
                                @if($product->new == 1)
                                <div class="new pp-new">New</div>
                                @endif
                                <ul>
                                    <li class="w-icon"><a href="#1"><i class="fa fa-random"></i></a></li>
                                    <li class="quick-view"><a href="#" data-toggle="modal" data-target="#modalQuickView{{$product->id}}">+ Xem nhanh</a></li>
                                    <li class="w-icon active"><a href="#{{ url('wishlists') }}" title="Thêm sản phẩm yêu thích" id="add-wish-list"> <i class="icon_heart_alt"></i></a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $product->category->name }}</div>
                                <a href="{{ url('products/'.$product->slug) }}">
                                    <h5>{{ $product->name }}</h5>
                                </a>
                                @if($product->priceSale == 0)
                                <div class="product-price">{{ number_format( $product->priceCore)  }} VNĐ</div>
                                @else
                                <div class="product-price">{{ number_format( $product->priceSale) }} VNĐ<span style="margin-left: 10px;">{{ number_format( $product->priceCore)  }} VNĐ</span></div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-3 offset-lg-1">
                    @foreach($banner_sale_2 as $sale_2)
                    @if (isset($sale_2->id))
                    <div class="product-large set-bg" data-setbg="{{ url($sale_2->image) }}" style="background-image: url({{ $sale_2->image }})">
                        <?php echo $sale_2->intro ?>
                        <a href="{{ url($sale_2->link) }}">Xem Ngay</a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Instagram Section Begin -->
    <!-- <div class="instagram-photo">
        <div class="insta-item set-bg" data-setbg="img/insta-1.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/insta-2.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/insta-3.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/insta-4.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/insta-5.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
        <div class="insta-item set-bg" data-setbg="img/insta-6.jpg">
            <div class="inside-text">
                <i class="ti-instagram"></i>
                <h5><a href="#">colorlib_Collection</a></h5>
            </div>
        </div>
    </div> -->
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Tin tức mới</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="single-latest-blog">
                        <a href="{{ url('blogs/post/'.$blog->slug) }}"><img src="{{ asset($blog->image) }}" alt="" style="height: 200px"></a>
                        <div class="latest-text">
                            <div class="tag-list">
                                <div class="tag-item">
                                    <i class="fa fa-calendar-o"></i>
                                    {{ ($blog->created_at)->format("d-m-Y") }}
                                </div>
                                <div class="tag-item">
                                    <i class="fa fa-comment-o"></i>
                                    <?php echo $count_cmt = \App\Models\BlogCommentModel::where('post_id', $blog->id)->count(); ?>
                                </div>
                            </div>
                            <a href="{{ url('blogs/post/'.$blog->slug) }}">
                                <h4>{{ $blog->name }}</h4>
                            </a>
                            <div class="blog-intro"><?php echo $blog->intro ?></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="benefit-items">
                <div class="row">
                    @foreach($benefit_items as $benefit_item)
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="{{ asset($benefit_item->image) }}" alt="" style="margin-bottom: 20px;">
                            </div>
                            <div class="sb-text">
                                <h6 style="margin-top: 5px;"><?php echo $benefit_item->intro ?></h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

    <!-- Partner Logo Section Begin -->
    @include('frontend.partials.partner')
    <!-- Partner Logo Section End -->

    <!-- Footer Section Begin -->
    @include('frontend.partials.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('frontend.partials.main-js')
    <!-- Js Plugins End -->

    @foreach($products as $product)
    <!-- Modal: modalQuickView -->
    <div class="modal fade" id="modalQuickView{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    @endforeach
    <script>
        // slide category
        $(document).ready(function() {
            $('.product-slider-1').hide();
            $('.parent_1_Category0, .parent_2_Category0').addClass('active');
            $('.product_1_Slider0, .product_2_Slider0').show();

            $('.parent_1_Category').on('click', function(e) {
                e.preventDefault();
                let parentId = $(this).attr('data-parentId');
                $('.parent_1_Category').removeClass('active');
                $(this).addClass('active');
                $('.product-slider-1').hide();
                $('.product_1_Slider' + parentId).show();
            });
            $('.parent_2_Category').on('click', function(e) {
                e.preventDefault();
                let parentId = $(this).attr('data-parentId');
                $('.parent_2_Category').removeClass('active');
                $(this).addClass('active');
                $('.product-slider-2').hide();
                $('.product_2_Slider' + parentId).show();
            });
        })
        $(document).on('click', '#quick-view', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '<?php echo url('addToCart') ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id
                }
            }).done(function(response) {
                console.log(response);
                $('.modal-body').html(response);
                //$('.modalQuickView').modal('show');
            });
        })
    </script>
</body>

</html>