@extends('frontend.layouts.app')
@section('title')
{{ $category->name }}
@endsection
@section('content')
<style>
    .center {
        text-align: center;
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }

    .pagination a.active {
        background-color: #e7ab3c;
        color: white;
        border: 1px solid #e7ab3c;
        pointer-events: none;
    }

    .pagination .not-event {
        pointer-events: none;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>{{ $category->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                <form action=""></form>
                @if($parentCategory == 0)
                <div class="filter-widget">
                    <h4 class="fw-title">Danh Mục</h4>
                    <ul class="fw-brand-check">
                        @foreach($categories as $cat)
                        <div class="bc-item">
                            <label>
                                {{ $cat->name }}
                                <input type="checkbox" id="bc-polo" name="category_id" value="{{ $cat->id }}">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        @foreach($brands as $brand)
                        <div class="bc-item">
                            <label>
                                {{ $brand->name }}
                                <input type="checkbox" id="bc-polo" name="brand_id" value="{{ $brand->id }}">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        @endforeach
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Size</h4>
                    <div class="fw-size-choose">
                        @foreach($sizes as $size)
                        <div class="sc-item">
                            <label>
                                <input type="checkbox" name="size_id" id="size" value="{{ $size->id }}">
                                {{ $size->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Màu</h4>
                    <div class="fw-color-choose">
                        @foreach($colors as $color)
                        <div class="sc-item">
                            <label style="background-color: {{ $color->color }}" title="{{ $color->name }}">
                                <input type="checkbox" name="color_id" id="color" value="{{ $color->id }}">
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Price</h4>
                    <div class="filter-range-wrap">
                        <div class="range-slider">
                            <div class="price-input">
                                <input type="text" id="minamount">
                                <input type="text" id="maxamount">
                            </div>
                        </div>
                        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="0" data-max="5000000">
                            <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                        </div>
                    </div>
                    <a href="#" class="filter-btn">Filter</a>
                </div>
                <!-- <div class="filter-widget">
                    <h4 class="fw-title">Tags</h4>
                    <div class="fw-tags">
                        @foreach($tags as $tag)
                        <label>
                            <input type="checkbox" name="tag_id" id="tag" value="{{ $tag->id }}">
                            {{ $tag->slug }}
                        </label>
                        @endforeach
                    </div>
                </div> -->
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting">
                                    <option value="">Default Sorting</option>
                                </select>
                                <select class="p-show">
                                    <option value="">Show:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            <p>Show 01- 09 Of 36 Product</p>
                        </div>
                    </div>
                </div> -->
                <div class="product-list">
                    <div class="row rowCategory">
                        @foreach($products as $product)
                        <div class="col-lg-4 col-sm-6">
                            <ul class="product-item">
                                <li class="pi-pic">
                                    <?php $images = json_decode($product->images) ?>
                                    <img src="{{ asset($images[0]) }}" alt="">
                                    @if($product->priceSale> 0)
                                    <div class="sale pp-sale" style="border-radius: 20px;">Sale</div>
                                    @endif
                                    @if($product->new == 1)
                                    <div class="new pp-new">New</div>
                                    @endif
                                    <ul>
                                        <?php
                                        $wishlist = \App\Models\WishListModel::where('user_id', \Auth::id())->where('product_id', $product->id)->get();
                                        $count_wishlist = count($wishlist);
                                        ?>
                                        <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                        <li class="quick-view"><a href="#" id="quick-view" data-toggle="modal" data-target="#modalQuickView{{$product->id}}" data-id="{{ $product->id }}">+ Xem nhanh</a></li>
                                        <li class="w-icon active"><a href="{{ url('wishlists/'.$product->id) }}" title="Thêm sản phẩm yêu thích" id="add-wish-list"><i class="fa @if($count_wishlist == 0) fa-heart-o @endif fa-heart"></i></a></li>
                                    </ul>
                                </li>
                                <div class="pi-text">
                                    <div class="catagory-name">{{ $product->cat_name }}</div>
                                    <a href="{{ url('products/'.$product->slug) }}">
                                        <h5>{{ $product->name }}</h5>
                                    </a>
                                    @if($product->priceSale == 0)
                                    <div class="product-price">{{ number_format( $product->priceCore)  }} VNĐ</div>
                                    @else
                                    <div class="product-price">{{ number_format( $product->priceSale) }} VNĐ<span style="margin-left: 10px;">{{ number_format( $product->priceCore)  }} VNĐ</span></div>
                                    @endif
                                </div>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($hasPage == true)
                <div class="center">
                    <div class="pagination">
                        <a href="{{$previousPageUrl}}" class="{{ $currentPage == 1 ? 'not-event' : '' }}">&laquo;</a>
                        @for($i=1; $i<=$totalPaginate; $i++) 
                        <a href="?page={{$i}}" class="{{ $i == $currentPage ? 'active' : ''}}">{{$i}}</a>
                        @endfor
                        <a href="{{$nextPageUrl}}" class="{{ $totalPaginate == $currentPage ? 'not-event' : '' }}">&raquo;</a>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

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
<!-- Product Shop Section End -->
<script>
    // $(document).ready(function() {
    //     $('.mdb-select').materialSelect();
    // });
    $(document).ready(function() {
        $('input').on('click', function() {
            let id = '<?php echo $category->id ?>';
            let parent_id = '<?php echo $category->parent_id ?>';
            let dataPost = [];
            let categoryID = $('input[name="category_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(categoryID);

            let brandID = $('input[name="brand_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(brandID);

            let sizeID = $('input[name="size_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(sizeID);

            let colorID = $('input[name="color_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(colorID);

            let tagID = $('input[name="tag_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(tagID);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '<?php echo url('categories') ?>',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    id: id,
                    parent_id: parent_id,
                    data: dataPost
                }
            }).done(function(response) {
                let i;
                let html = '';
                for (i = 0; i < response.length; i++) {
                    html += '<div class="col-lg-4 col-sm-6">';
                    html += '<ul class="product-item">';
                    html += '<li class="pi-pic">';
                    html += '<img src="' + response[i].image + '" alt="">';
                    if (response[i].sale > 0) {
                        html += '<div class="sale pp-sale" style="border-radius: 20px;">Sale</div>';
                    }
                    if (response[i].new == 1) {
                        html += '<div class="new pp-new">New</div>';
                    }
                    html += '<ul>';
                    html += '<li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>';
                    html += '<li class="quick-view"><a href="#" id="quick-view" data-toggle="modal" data-target="#modalQuickView' + response[i].id + '" data-id="' + response[i].id + '">+ Xem nhanh</a></li>';
                    html += '<li class="w-icon active"><a href="" title="Thêm sản phẩm yêu thích" id="add-wish-list"><i class="fa fa-heart-o"></i></a></li>';
                    html += '</ul>';
                    html += '</li>';
                    html += '<div class="pi-text">';
                    html += '<div class="catagory-name">' + response[i].cat_name + '</div>';
                    html += '<a href="' + response[i].link + '">';
                    html += '<h5>' + response[i].name + '</h5>';
                    html += '</a>';
                    if (response[i].sale == 0) {
                        html += '<div class="product-price">' + response[i].priceCore + '</div>';
                    } else {
                        html += '<div class="product-price">' + response[i].priceSale + '<span style="margin-left: 10px;">' + response[i].priceCore + '</span></div>';
                    }
                    html += '</div>';
                    html += '</ul>';
                    html += '</div>';
                }
                $('.rowCategory').html(html);
                $('.pagination').css('display', 'none');
            })
        })
    })
</script>
@endsection