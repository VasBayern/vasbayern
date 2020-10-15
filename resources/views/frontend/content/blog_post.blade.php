@extends('frontend.layouts.app')
@section('title')
Bài viết
@endsection
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="{{ route('blog') }}">Tin tức</a>
                    <a href="{{ url('blogs/category/').'/'.$post->category->slug }}">{{ $post->category->name }}</a>
                    <span>Bài viết</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="blog-details-inner">
                    <div class="blog-detail-title">
                        <h2>{{ $post->name }}</h2>
                        <p>{{ $post->category->name }} <span>- {{ ($post->updated_at)->format("d-m-Y") }}</span></p>
                    </div>
                    <div class="blog-large-pic">
                        <img src="{{ asset($post->image) }}" alt="" style="height: 400px;">
                    </div>
                    <?php echo $post->desc; ?>
                    <div class="tag-share">
                        <div class="details-tag">
                            <ul>
                                <li><i class="fa fa-tags"></i></li>
                                <li>Travel</li>
                                <li>Beauty</li>
                                <li>Fashion</li>
                            </ul>
                        </div>
                        <div class="blog-share">
                            <span>Share:</span>
                            <div class="social-links">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                    @foreach($comments as $comment)
                    <div class="posted-by">
                        <div class="pb-pic">
                            @if(isset($comment->user->image) && !empty($comment->user->image) )
                            <img src="{{ URL::to('/') }}/front-ends/img/user-image/{{ $comment->user->image }}" style="border-radius: 50%; width: 60px; height: 60px; margin-top: 10px;" />
                            @else
                            <img src="{{ URL::to('/') }}/front-ends/img/user-image/avt.jpg" style="border-radius: 50%; width: 60px; height: 60px; margin-top: 10px;" />
                            @endif
                        </div>
                        <div class="pb-text">
                            <h5 style="font-weight: 700; margin-bottom: 10px;">{{ $comment->user->name }}
                                <span style="color: #B2B2B2; font-size: 12px; font-weight: 400; margin-left: 22px;"> {{ $comment->created_at }}</span>
                            </h5>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                    @endforeach

                    <div class="leave-comment">
                        <h4>Thêm đánh giá</h4>
                        @if(Auth::check())
                        <form action="{{ url('blogs/comment') }}" class="comment-form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" value="{{ Auth::user()->name }}" readonly>
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Bình luận ..." name="comment">{{ old('comment') }}</textarea>
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
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <div class="recent-post">
                        <div class="recent-post">
                            <h4>Bài viết mới</h4>
                            <div class="recent-blog">
                                @foreach($recent_posts as $recent_post)
                                <a href="{{ url('blogs/post/'.$recent_post->slug) }}" class="rb-item">
                                    <div class="rb-pic">
                                        <img src="{{ asset($recent_post->image) }}" style="width: 160px; height: auto" alt="">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{ $recent_post->name }}</h6>
                                        <p>{{ $recent_post->category->name }} <span>- {{ ($recent_post->created_at)->format("d-m-Y") }}</span></p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="recent-post">
                            <h4>Bài viết xem nhiều</h4>
                            <div class="recent-blog">
                                @foreach($recent_posts as $recent_post)
                                <a href="{{ url('blogs/post/'.$recent_post->slug) }}" class="rb-item">
                                    <div class="rb-pic">
                                        <img src="{{ asset($recent_post->image) }}" style="width: 160px; height: auto" alt="">
                                    </div>
                                    <div class="rb-text">
                                        <h6>{{ $recent_post->name }}</h6>
                                        <p>{{ $recent_post->category->name }} <span>- {{ ($recent_post->created_at)->format("d-m-Y") }}</span></p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection