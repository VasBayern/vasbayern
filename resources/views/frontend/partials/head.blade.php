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

    <!-- Toastr-->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style type="text/css">
        .spad {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .avatar .avatar-image {
            height: 140px;
            background-color: rgb(233, 236, 239);
            padding-left: 0;
            padding-right: 0;
        }

        .avatar .add-avatar button {
            position: relative;
            height: 50px;
            margin-top: 40px;
            margin-left: 15px;
        }

        .avatar .add-avatar i {
            position: relative;
            float: left;
            top: 12px;
        }

        .avatar .add-avatar span {
            position: relative;
            float: left;
            color: #dee2e6;
        }

        .avatar .add-avatar span:hover {
            color: #dee2e6;
        }

        .avatar .add-avatar .file-upload {
            position: absolute;
            left: -35px;
            top: -7px;
            width: 135px;
            font-size: 28px;
            opacity: 0;
            cursor: pointer;
        }

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