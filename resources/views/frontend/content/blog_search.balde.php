@extends('frontend.layouts.app')
@section('title')
Tin tức
@endsection
@section('content')

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Tin tức</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<section class="blog-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1">
                <div class="blog-sidebar">
                    <div class="search-form">
                        <h4>Tìm Kiếm</h4>
                        <form action="{{ url('blogs/search') }}" method="post">
                            @csrf
                            <input type="text" placeholder="Tìm kiếm . . .  " id="search-blog" name="name">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="blog-catagory">
                        <h4>Danh Mục</h4>
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{ url('blogs/category/'.$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="recent-post">
                        <h4>Đọc nhiều nhất</h4>
                        <div class="recent-blog">
                            <a href="#" class="rb-item">
                                <div class="rb-pic">
                                    <img src="{{ asset('front_ends/img/blog/recent-1.jpg') }}" alt="">
                                </div>
                                <div class="rb-text">
                                    <h6>The Personality Trait That Makes...</h6>
                                    <p>Fashion <span>- May 19, 2019</span></p>
                                </div>
                            </a>
                            <a href="#" class="rb-item">
                                <div class="rb-pic">
                                    <img src="{{ asset('front_ends/img/blog/recent-2.jpg') }}" alt="">
                                </div>
                                <div class="rb-text">
                                    <h6>The Personality Trait That Makes...</h6>
                                    <p>Fashion <span>- May 19, 2019</span></p>
                                </div>
                            </a>
                            <a href="#" class="rb-item">
                                <div class="rb-pic">
                                    <img src="{{ asset('front_ends/img/blog/recent-3.jpg') }}" alt="">
                                </div>
                                <div class="rb-text">
                                    <h6>The Personality Trait That Makes...</h6>
                                    <p>Fashion <span>- May 19, 2019</span></p>
                                </div>
                            </a>
                            <a href="#" class="rb-item">
                                <div class="rb-pic">
                                    <img src="{{ asset('front_ends/img/blog/recent-4.jpg') }}" alt="">
                                </div>
                                <div class="rb-text">
                                    <h6>The Personality Trait That Makes...</h6>
                                    <p>Fashion <span>- May 19, 2019</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="blog-tags">
                        <h4>Product Tags</h4>
                        <div class="tag-item">
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
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row">
                    @foreach($posts as $post)
                    <div class="col-lg-6 col-sm-6">
                        <div class="blog-item">
                            <div class="bi-pic">
                                <a href="{{ url('blogs/post/').'/'.$post->slug }}">
                                    <img src="{{ asset($post->image) }}" style="width: 400px;height: 200px;" alt="">
                                </a>
                            </div>
                            <div class="bi-text">
                                <a href="{{ url('blogs/post/').'/'.$post->slug }}">
                                    <h4>{{ $post->name }}</h4>
                                </a>
                                <p style="letter-spacing: 0">{{ $post->category->name }}
                                    <span>{{ ($post->updated_at)->format("Y-m-d") }}</span>
                                </p>
                            </div>
                            <div class="intro"><?php echo $post->intro ?></div>
                        </div>
                    </div>
                    @endforeach
                    <!-- <div class="col-lg-12">
                            <div class="loading-more">
                                <i class="icon_loading"></i>
                                <a href="#">
                                    Loading More
                                </a>
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection