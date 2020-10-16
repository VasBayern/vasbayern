@extends('frontend.layouts.app')
@section('title')
{{ $category->name }}
@endsection
@section('content')

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
                <div class="filter-widget">
                    <h4 class="fw-title">Danh Mục</h4>
                    <ul class="filter-catagories">
                        @foreach($categories as $cat)
                        <li><a href="{{ url('categories/'.$cat->slug) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="filter-widget">
                    <h4 class="fw-title">Brand</h4>
                    <div class="fw-brand-check">
                        @foreach($brands as $brand)
                        <div class="bc-item">
                            <label>
                                {{ $brand->name }}
                                <input type="checkbox" id="bc-polo">
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
                                <input type="radio" name="size_id" value="{{ $size->id }}">
                                {{ $size->name }}
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
                    <h4 class="fw-title">Color</h4>
                    <div class="fw-color-choose">
                        <div class="cs-item">
                            <input type="radio" id="cs-green">
                            <label class="cs-green" for="cs-green">Green</label>
                        </div>
                    </div>
                </div> -->

                <div class="filter-widget">
                    <h4 class="fw-title">Tags</h4>
                    <div class="fw-tags">
                        <a href="#">Towel</a>
                        <a href="#">Shoes</a>
                        <a href="#">Coat</a>
                        <a href="#">Dresses</a>
                        <a href="#">Trousers</a>
                        <a href="#">Men's hats</a>
                        <a href="#">Backpack</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
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
                </div>
                <div class="product-list">
                    <div class="row">
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
                                        <li class="quick-view"><a href="#" data-toggle="modal" data-target="#modalQuickView{{$product->id}}">+ Xem nhanh</a></li>
                                        <li class="w-icon active"><a href="{{ url('wishlists/'.$product->id) }}" title="Thêm sản phẩm yêu thích" id="add-wish-list"><i class="fa @if($count_wishlist == 0) fa-heart-o @endif fa-heart"></i></a></li>
                                    </ul>
                                </li>
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
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
                </div>
                <!-- <div class="loading-more">
                    <i class="icon_loading"></i>
                    <a href="#">
                        Loading More
                    </a>
                </div> -->
            </div>
        </div>
    </div>

    @foreach($products as $product)
    <!-- Modal: modalQuickView -->
    <div class="modal fade" id="modalQuickView{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <!--Carousel Wrapper-->
                            <?php $images = json_decode($product->images) ?>
                            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" alt="{{$product->name}}" src="{{ asset($images[0]) }}">
                                    </div>
                                </div>
                                <!--/.Slides-->
                                <!--Controls-->
                                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <!--/.Controls-->
                                <ol class="carousel-indicators">
                                    @foreach($images as $key=>$image)
                                    <li data-target="#carousel-thumb" data-slide-to="{{$key}}">
                                        <img src="{{ asset($image) }}" width="60">
                                    </li>
                                    @endforeach
                                </ol>
                            </div>
                            <!--/.Carousel Wrapper-->
                        </div>
                        <div class="col-lg-7">
                            <h4 class="h2-responsive product-name">
                                {{ $product->name }}
                            </h4>
                            <h4 class="h4-responsive" style="margin: 10px auto;">
                                @if($product->priceSale == 0)
                                <span class="" style="color: #E7AB3C; font-size: 18px; margin-right: 20px;">{{ number_format($product->priceCore) }} VNĐ</span>
                                @else
                                <span class="" style="color: #E7AB3C; font-size: 18px;">{{ number_format($product->priceSale) }} VNĐ</span>
                                <span class="grey-text"><small style="text-decoration: line-through; font-size: 16px; color: #B2B2B2">{{ number_format($product->priceCore) }} VNĐ</small></span>
                                @endif
                            </h4>

                            <!--Accordion wrapper-->
                            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                                <!-- Accordion card -->
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingTwo2">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo2">
                                            <h5 class="mb-0" style="text-align: justify">
                                                Thông số sản phẩm
                                            </h5>
                                        </a>
                                    </div>
                                    <!-- Card body -->
                                    <div id="collapseTwo2" class="collapse show" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td class="p-catagory">Đánh giá khách hàng</td>
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
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="p-catagory">Giá sản phẩm</td>
                                                        <td>
                                                            <div class="p-price" style="font-size: 15px;">
                                                                @if($product->priceSale >0)
                                                                {{ number_format($product->priceSale) }} VNĐ<span style="margin-left: 10px;font-size: 12px; text-decoration: line-through; color: #888 ">{{ number_format($product->priceCore) }} VNĐ</span>
                                                                @else
                                                                {{ number_format($product->priceCore) }} VNĐ
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-catagory">Số lượng</td>
                                                        <td>
                                                            <div class="p-stock">22 </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-catagory">Size</td>
                                                        <td>
                                                            <div class="p-size">
                                                                @if(isset($product->product_properties) && count($product->product_properties) >0)
                                                                @foreach($product->product_properties as $size)
                                                                <label style="padding: 4px 8px; border: 1px solid #888">
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Accordion card -->
                                <!-- Accordion card -->
                                <div class="card">
                                    <!-- Card header -->
                                    <div class="card-header" role="tab" id="headingOne1">
                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false" aria-controls="collapseOne1">
                                            <h5 class="mb-0" style="text-align: justify">
                                                Chi tiết sản phẩm
                                            </h5>
                                        </a>
                                    </div>
                                    <!-- Card body -->
                                    <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                        <div class="card-body" style="text-align: justify">
                                            <?php echo $product->desc ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Accordion card -->
                            </div>
                            <!-- Accordion wrapper -->
                            <!-- Add to Cart -->
                            <!-- <div class="card-body">
                                <form action="{{ url('cart/add') }}" method="post">
                                    @csrf
                                    <div class="form-group row" style="margin-bottom: 0;">
                                        <label for="" class="col-lg-3" style="margin-top: 8px;">Size</label>
                                        <div class="product-details col-lg-9">
                                            <div class="pd-size-choose">

                                                @if(isset($product->product_properties) && count($product->product_properties) >0)
                                                @foreach($product->product_properties as $pro)
                                                <div class="sc-item">
                                                    <label>
                                                        <input type="radio" required name="size_id" class="size" value="{{ $pro->size_id }}" data-quantity="{{ $pro->quantity }}">
                                                        {{ $pro->size->name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                                @else
                                                <p style="padding-top: 10px">Tạm hết hàng</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="size" class="col-lg-3 col-form-label">Số lượng</label>
                                        <div class="col-lg-6">
                                            <input type="number" name="quantity" min="1" value="1" class="form-control" id="quantity" required placeholder="Nhập số lượng ..." onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class='amount-remain offset-lg-3' style="display:none; padding-left: 15px;">Còn lại <span id='amount' style="font-weight:bold;">@if(isset($pro)){{ $pro->quantity }}@endif</span> sản phẩm trong kho</p>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Đóng</button>
                                        <input type="hidden" class="cart-btn" name="product_id" value="{{ $product->id }}">
                                        @if(isset($pro) && $pro->quantity > 0)

                                        <button type="submit" class="btn btn-primary" id="add-to-cart" data-product-id="{{ $product->id  }}">Thêm vào giỏ hàng</button>
                                        @else
                                        <button type="submit" disabled class="btn btn-primary" id="add-to-cart" data-product-id="{{ $product->id  }}" style="background: darkgray;">Hết hàng</button>
                                        @endif

                                    </div>
                                </form>
                            </div> -->
                            <!-- /.Add to Cart -->
                        </div>
                    </div>
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
    
</script>
@endsection