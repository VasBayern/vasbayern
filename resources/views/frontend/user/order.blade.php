@extends('frontend.layouts.shop')
@section('title')
    Địa chỉ giao hàng
@endsection
@section('content')
    <style type="text/css">
        .info {
            height: 180px;
            margin-bottom: 30px;
            margin-right: 70px;
            background: #F8F8F8;
        }
        .info-default {
            border: 1px dashed #8FC050;
        }
        .col-form-label {
            font-weight: bold;
            font-size: 14px;
        }
        .address-info p {
            margin-bottom: 0;
            font-size: 14px;
        }
        .address-info .add-address {
            color: #007bff;
            font-size: 16px;
            margin-left: 10px;
        }

        .address-info .edit-address, .delete-address {
            border-radius: 2px;
            padding: 7px;
            border: 1px solid;
            border-color: rgb(204,204,204);
            color: #333333;
            background: linear-gradient(rgb(255, 255, 255), rgb(247, 247, 247));
        }
        .address-info .edit-address:hover {
            color: #333333;
        }
        .address-info .delete-address:hover {
            color: #333333;
        }
        span.default {
            font-size: 16px;
            font-weight: 700;
            float: right;
            color: #F8F8F8;
        }
        #defaultAddress {
            color: #8FC050;
        }
    </style>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span> Địa chỉ giao hàng</span>
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
                            <li><a href="{{ url('user/order') }}" style="color: #e7ab3c" >Lịch sử mua hàng</a></li>
                            <li><a href="{{ url('user/wishlist') }}" >Sản phẩm yêu thích</a></li>
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
                    <div class="filter-widget" style="margin-bottom: 0;">
                        <h4 class="fw-title">Lịch sử mua hàng</h4>
                    </div>
                    
                </div>
            </div>
        </div>
        @endif
    </section>
   
   
@endsection
