<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('front_ends/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/themify-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('front_ends/css/style.css')}}" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Toastr-->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <style type="text/css">
        .product-item .pi-pic .new {
            color: #ffffff;
            font-size: 10px;
            background: #76BC42;
            position: absolute;
            right: 0;
            top: 20px;
            padding: 5px 10px;
            text-transform: uppercase;
            border-radius: 20px;
        }

        .single-latest-blog .latest-text .blog-intro {
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
    </style>
</head>