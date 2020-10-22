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

        /* user profile */
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

        /* end user profile */

        /* user address */
        .form-group .col-form-label {
            font-weight: bold;
            font-size: 14px;
        }

        .address-info .info {
            height: 180px;
            margin-bottom: 30px;
            margin-right: 70px;
            background: #F8F8F8;
            border: 1px solid #BBBBBB;
        }

        .address-info #info-default {
            border: 1px dashed #8FC050;
        }

        .address-info span.default {
            font-size: 16px;
            font-weight: 700;
            float: right;
            color: #F8F8F8;
        }

        .address-info #defaultAddress {
            color: #8FC050;
        }

        .address-info h5 {
            font-weight: 700;
            margin-bottom: 10px;
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

        .address-info .edit-address,
        .delete-address {
            border-radius: 2px;
            padding: 7px;
            border: 1px solid;
            border-color: rgb(204, 204, 204);
            color: #333333;
            background: linear-gradient(rgb(255, 255, 255), rgb(247, 247, 247));
        }

        .address-info .edit-address:hover,
        .delete-address:hover {
            color: #333333;
        }

        /* end user-address */

        /* product */
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

        /* end product */

        /* blog */
        .single-latest-blog .latest-text .blog-intro {
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }

        .blog-item .intro {
            color: #636363;
            font-weight: 300;
            margin-top: 15px;
            letter-spacing: 0;
            font-size: 14px;
            text-transform: none;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }

        /* end blog */
    </style>
</head>