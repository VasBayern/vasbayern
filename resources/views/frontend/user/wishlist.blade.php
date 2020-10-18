@extends('frontend.layouts.shop')
@section('title')
    Sản phẩm yêu thích
@endsection
@section('content')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span> Sản phẩm yêu thích</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <section class="spad">
        @if(Auth::check() && !empty(Auth::user()->email_verified_at))
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                        <div class="filter-widget">
                            <h4 class="fw-title">Tài khoản</h4>
                            <ul class="filter-catagories">
                                <li><a href="{{ url('user/profile') }}">Thông tin tài khoản</a></li>
                                <li><a href="{{ url('user/address') }}">Địa chỉ giao hàng</a></li>
                                <li><a href="{{ url('user/order') }}" >Lịch sử mua hàng</a></li>
                                <li><a href="{{ url('user/wishlist') }}" style="color: #e7ab3c">Sản phẩm yêu thích</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class='col-lg-9 order-1 order-lg-2'>
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
                        @if(session('error'))
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!!session('error')!!}
                            </div>
                        @endif
                        <div class="filter-widget" style="margin-bottom: 0;">
                            <h4 class="fw-title">Sản phẩm yêu thích</h4>
                        </div>
                        @if(count($wishlists) != 0)
                        <div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên SP</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Xem</th>
                                    <th scope="col">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $stt = 1;?>
                                @foreach($wishlists as $wishlist)
                                <tr>
                                    <td style="vertical-align:middle;" scope="row">{{ $stt }}</td>
                                    <td style="vertical-align:middle; font-weight: 700;">{{ $wishlist->name }}</td>
                                    <td>
                                        <?php
                                        $images = (isset($wishlist->images) && $wishlist->images) ? json_decode($wishlist->images) : array();
                                        ?>
                                        @foreach($images as $image)
                                            <img src="{{ asset($image) }}" alt="" style="width: 120px;">
                                            @break;
                                        @endforeach
                                    </td>
                                    <td style="vertical-align:middle;">
                                        @if($wishlist->priceSale == 0)
                                            <p style="color: #e7ab3c; font-weight: 700; font-size: 18px;">{{ number_format( $wishlist->priceCore)  }} VNĐ</p>
                                        @else
                                            <p style="color: #e7ab3c; font-weight: 700; font-size: 18px;">{{ number_format( $wishlist->priceSale) }} VNĐ</p>
                                            <p style="font-size: 14px;text-decoration: line-through; color: #b7b7b7">{{ number_format( $wishlist->priceCore)  }} VNĐ</p>
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle; text-align: center"><a href="{{ url('product/'.$wishlist->product_id) }}" class="btn btn-primary" title="Xem"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                    <td class="close-td" style="vertical-align: middle; text-align: center" data-rowId="{{ $wishlist->id }}">
                                        <form action=" {{ url('user/wishlist/'.$wishlist->id.'/delete') }} " method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>Vui lòng thêm sản phẩm yêu thích</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection