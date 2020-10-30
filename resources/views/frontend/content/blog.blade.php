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
                    <div class="filter-widget">
                        <h4 class="fw-title">Danh Mục</h4>
                        <ul class="fw-brand-check">
                            @foreach($categories as $category)
                            <div class="bc-item" style="display: block;">
                                <label>
                                    {{ $category->name }}
                                    <input type="checkbox" id="bc-polo" name="category_id" value="{{ $category->id }}">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
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
                    <div class="filter-widget">
                        <h4 class="fw-title">Tags</h4>
                        <div class="fw-tags">
                            @foreach($tags as $tag)
                            <label>
                                <input type="checkbox" name="tag_id" id="tag" value="{{ $tag->id }}">
                                {{ $tag->slug }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="row rowCategory">
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
<script>
    $(document).ready(function() {
        $('input').on('click', function() {
            dataPost = [];
            let categoryID = $('input[name="category_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(categoryID);

            let tagID = $('input[name="tag_id"]:checked').map(function() {
                return this.value;
            }).toArray();
            dataPost.push(tagID);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '<?php echo url('blogs') ?>',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    dataPost
                }
            }).done(function(response) {
                console.log(response);
                let i;
                let html = '';
                for (i = 0; i < response.length; i++) {
                    html += '<div class="col-lg-6 col-sm-6">' +
                        '<div class="blog-item">' +
                        '<div class="bi-pic">' +
                        '<a href="' + response[i].link + '">' +
                        '<img src="' + response[i].image + '" style="width: 400px;height: 200px;" alt="">' +
                        '</a>' +
                        '</div>' +
                        '<div class="bi-text">' +
                        '<a href="' + response[i].link + '">' +
                        '<h4>' + response[i].name + '</h4>' +
                        '</a>' +
                        '<p style="letter-spacing: 0">' + response[i].cat_name +
                        '<span style="margin-left:5px">' + response[i].updated_at + '</span>' +
                        '</p>' +
                        '</div>' +
                        '<div class="intro">' + response[i].intro + '</div>' +
                        '</div>' +
                        '</div>';
                }
                $('.rowCategory').html(html);
            })
        })
    })
</script>
@endsection