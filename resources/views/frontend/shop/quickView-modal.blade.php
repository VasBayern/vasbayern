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
                                @if(count($sizes) > 0)
                                <tr>
                                    <td class="p-catagory">Số lượng</td>
                                    <td>
                                        <div class="p-stock">22 </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">Màu</td>
                                    <td class="filter-widget">
                                        <div class="modal-color-choose">
                                            @foreach($properties as $property)
                                            <div class="sc-item" style="display: inline-block">
                                                <label style="background-color: {{ $property['color'] }}; pointer-events:none" title="{{ $property['color_name']}}"></label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-catagory">Size</td>
                                    <td>
                                        <div class="p-size">
                                            @foreach($sizes as $size)
                                            <label style="padding: 4px 12px; margin-right: 8px; border: 1px solid #888">
                                                {{ $size->size_name }}
                                            </label>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endif
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
        <div class="card-body">
            <form action="{{ url('cart/add') }}" method="post">
                @csrf
                @if(count($sizes) > 0)
                <div class="form-group row" style="margin-bottom: 0;">
                    <label for="color" class="col-lg-3">Màu</label>
                    <div class="col-lg-9 filter-widget" style="margin-bottom: 20px;">
                        <div class="modal-color-choose">
                            @foreach($properties as $property)
                            <?php
                            $listSize = json_encode($property);
                            $sizeOfColor = json_encode($sizes)
                            ?>
                            <div class="sc-item">
                                <label style="background-color: {{ $property['color'] }}" title="{{ $property['color_name']}}">
                                    <input type="radio" name="color" class="radio-color" value="{{ $property['color_id'] }}" data-name="{{ $property['color_name']}}" data-size="{{ $sizeOfColor }}" data-color="{{ $listSize }}">
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="margin-bottom: 0;">
                    <label for="" class="col-lg-3">Size</label>
                    <div class="col-lg-9 product-details">
                        <div class="pd-size-choose">
                            @foreach($sizes as $size)
                            <div class="sc-item">
                                <label class="size size-{{$size->size_id}}">
                                    <input type="radio" class="size_id" name="size" value="{{ $size->size_id }}">
                                    {{ $size->size_name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="size" class="col-lg-3 col-form-label">Số lượng</label>
                    <div class="col-lg-6">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantityStock" class="quantityStock" value="">
                        <input type="number" name="quantity" min="1" value="1" class="form-control" id="quantity" data-quantity="" required placeholder="Nhập số lượng ..." onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                </div>
                <div class="form-group row">
                    <p class="amount"></p>
                </div>
                @endif
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" id="close-modal" data-dismiss="modal">Đóng</button>
                    @if(count($sizes) > 0)
                    <button type="submit" class="btn btn-primary" id="add-to-cart">Thêm vào giỏ hàng</button>
                    @else
                    <button type="submit" disabled class="btn btn-secondary">Hết hàng</button>
                    @endif
                </div>
            </form>
        </div>
        <!-- /.Add to Cart -->
    </div>
</div>