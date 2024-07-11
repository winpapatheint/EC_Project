<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Asian food museum">
    <meta name="keywords" content="Asian food museum">

    <link rel="icon" href="{{ asset('frontend/assets/logos/logos_foods.png') }}" type="image/x-icon">
    <title>Asian food museum</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/scss/base/_typography.scss') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/review.min.css') }}">

    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/remixicon.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/scss/vendors/feather-icon/_feather-icon.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/scss/pages/_inner_pages.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/scss/vendors/bootstrap/_reboot.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/scss/vendors/bootstrap/_grid.scss') }}">
    <style>
        header .navbar.navbar-expand-xl .navbar-nav .nav-link .menu::before {
            content: "" !important;
            position: absolute !important;
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
            right: -12px !important;
            top: 50% !important;
            -webkit-transform: translateY(-50%) !important;
            transform: translateY(-50%) !important;
        }
    </style>
</head>

<body class="bg-effect">

    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Price Range Js -->
    <script src="{{ asset('frontend/assets/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    @php
        if (!empty(Auth::user()) && Auth::user()->role != 'buyer') {
            Auth::logout();
        }
    @endphp

    <!-- Header Start -->
    <header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white">4-27-5 Ikebukuro, Toshima-ku, Tokyo</span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                <div>
                                    <div class="timer-notification">
                                        <h6><strong class="me-1">Welcome to the Asian Food Museum EC site!</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select" style="display: flex;">
                                    <img src="{{ asset('frontend/assets/images/country/japan.png') }}"
                                        class="img-fluid blur-up lazyload" alt="" width="30px">
                                    <img src="{{ asset('frontend/assets/images/country/united-states.png') }}"
                                        class="img-fluid blur-up lazyload" alt="" width="30px"
                                        style="margin-left: 5px;">
                                </div>
                            </li>
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <span>JPY</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="/" class="web-logo nav-logo">
                                <img src="{{ asset('images/logos/logo_foodsh.png') }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                <div class="search-box">
                                    <form id="mainSearchForm" action="{{ route('show-product') }}" method="GET">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="mainSearch"
                                                placeholder="I'm searching for..."
                                                value="{{ request('mainSearch') }}">
                                            <button class="btn" type="submit" id="button-addon2">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type"
                                            placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{ url('/contact') }}" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>24/7 Delivery</h6>
                                                <h5>+91 888 104 2340</h5>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{ url('/wishlist') }}"
                                            class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <a href="{{ route('show_carts') }}">
                                                <button type="button"
                                                    class="btn p-0 position-relative header-wishlist">
                                                    <i data-feather="shopping-cart"></i>
                                                    @php
                                                        $userCarts = collect([]);
                                                        $count = 0;
                                                    @endphp
                                                    @if (!empty(Auth::user()))
                                                        @php
                                                            $userCarts = DB::table('carts')
                                                                ->join(
                                                                    'products',
                                                                    'carts.product_id',
                                                                    '=',
                                                                    'products.id',
                                                                )
                                                                ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
                                                                ->where('buyers.user_id', Auth::user()->id)
                                                                ->get();

                                                            $count = $userCarts->count();
                                                        @endphp
                                                    @endif
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge"
                                                        id="unreadMessages">
                                                        {{ $count }}
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </button>
                                            </a>

                                            @if (!empty(Auth::user()))
                                                <div class="onhover-div">
                                                    <ul class="cart-list">
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($userCarts as $cart)
                                                            <li class="product-box-contain">
                                                                <div class="drop-cart">
                                                                    <a
                                                                        href="{{ route('show-product-left-thumbnail', ['id' => $cart->product_id]) }}">
                                                                        <img src="{{ asset('upload/product_thambnail/' . $cart->product_thambnail) }}"
                                                                            class="blur-up lazyload" alt=""
                                                                            width="87" height="73">
                                                                    </a>

                                                                    <div class="drop-contain">
                                                                        <a
                                                                            href="{{ route('show-product-left-thumbnail', ['id' => $cart->product_id]) }}">
                                                                            <h5>{{ $cart->product_name }}</h5>
                                                                        </a>
                                                                        <h6><span>{{ $cart->quantity }} x</span>
                                                                            ¥{{ number_format($cart->selling_price, 0, '.', ',') }}
                                                                        </h6>
                                                                        <button class="close-button close_button"
                                                                            data-product-id="{{ $cart->product_id }}">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="drop-contain">
                                                                        <h5>Total</h5>

                                                                        <h6>¥{{ number_format($cart->quantity * $cart->selling_price, 0, '.', ',') }}
                                                                        </h6>
                                                                        <button class="close-button close_button"
                                                                            data-product-id="{{ $cart->product_id }}">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                            @php
                                                                $total += $cart->selling_price * $cart->quantity;
                                                            @endphp
                                                        @endforeach
                                                    </ul>

                                                    <div class="price-box">
                                                        <h5>Total :</h5>
                                                        <h4 class="theme-color fw-bold">
                                                            ¥{{ number_format($total, 0, '.', ',') }}</h4>
                                                    </div>

                                                    <div class="button-group">
                                                        <a href="{{ route('show_carts') }}"
                                                            class="btn btn-sm cart-button">View Cart</a>
                                                        {{-- <a href="{{ url('/checkout') }}" class="btn btn-sm cart-button theme-bg-color
                                                        text-white">Checkout</a> --}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="profile-nav onhover-dropdown pe-0 me-0">
                                        @if (empty(Auth::user()))
                                            <div class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                            </div>
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('login') }}">Log In</a>
                                                    </li>
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('user_register') }}">Buyer Register</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="media profile-media">
                                                <img src="{{ !empty(Auth::user()->user_photo) ? url('upload/profile/' . Auth::user()->user_photo) : url('backend/assets/images/users/4.jpg') }}"
                                                    class="user-profile rounded-circle" width="30px"
                                                    height="30px">

                                                <div class="user-name-hide media-body">
                                                    @if (mb_strlen(Auth::user()->name) > 3)
                                                        <span>{!! mb_substr(Auth::user()->name, 0, 3) !!}</span>
                                                    @else
                                                        {!! nl2br(e(Auth::user()->name)) !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="profile-dropdown onhover-show-div">
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                            href="javascript:void(0)">
                                                            <i data-feather="log-out"></i>
                                                            <span style="margin-left: 10px;">Log out</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span>All Categories</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>All Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                                <ul class="category-list">
                                    @foreach ($categories as $category)
                                        <li class="onhover-category-list">
                                            <a href="javascript:void(0)" class="category-name">
                                                <img src="{{ asset('images/' . $category->category_icon) }}"
                                                    alt="">
                                                <h6>{{ $category->category_name }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>

                                            <div class="onhover-category-box" style="height: fit-content;">
                                                @foreach ($category->subCategoryTitle as $subCategoryTitle)
                                                    <div class="list-1" style="margin-left: 10px;margin-top: 10px;">
                                                        <div class="category-title-box">
                                                            <h5>{{ $subCategoryTitle->sub_category_titlename }}</h5>
                                                        </div>
                                                        @foreach ($subCategoryTitle->subCategory as $subCategory)
                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="{{ url('/subcategorysidebar/' . $subCategory->id) }}">{{ $subCategory->sub_category_name }}</a>
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>

                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            @if (empty(Auth::user()))
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link " href="{{ url('/') }}">Home</a>
                                                </li>
                                            @endif

                                            @if (!empty(Auth::user()))
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="{{ url('/user') }}">My Menu</a>

                                                </li>
                                            @endif

                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ url('/products') }}">Products</a>
                                            </li>


                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ route('shoplist') }}">Shop</a>
                                            </li>

                                            @if ($specialCorner->isNotEmpty())
                                                <li class="nav-item dropdown dropdown-mega">
                                                    <a class="nav-link menu dropdown-toggle ps-xl-2 ps-0"
                                                        href="javascript:void(0)" data-bs-toggle="dropdown">
                                                        <span class="menu">Special Corner</span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-2">
                                                        @foreach ($specialCorner as $category)
                                                            @foreach ($category->subCategoryTitle as $index => $subCategoryTitle)
                                                                @if ($index % 3 == 0)
                                                                    @if ($index > 1)
                                                                        <div class="row" style="margin-top: 10px;">
                                                                        @else
                                                                            <div class="row">
                                                                    @endif
                                                                @endif
                                                                <div class="dropdown-column col-xl-3">
                                                                    <h5 class="dropdown-header">
                                                                        {{ $subCategoryTitle->sub_category_titlename }}
                                                                    </h5>
                                                                    @foreach ($subCategoryTitle->subCategory as $subCategory)
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/specialsubcategorysidebar/' . $subCategory->id) }}">
                                                                            {{ $subCategory->sub_category_name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @if ($index % 3 == 2 || $loop->last)
                                                    </div>
                                            @endif
                                            @endforeach
                                            @endforeach
                                    </div>
                                    </li>
                                    @endif


                                    @if (empty(Auth::user()))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ url('/faq') }}">FAQ</a>

                                        </li>
                                    @endif

                                    @if (empty(Auth::user()))
                                        <li class="nav-item dropdown new-nav-item">
                                            @if ($newBlogsExist)
                                                <label class="new-dropdown">New</label>
                                            @endif
                                            <a class="nav-link" href="{{ url('/news') }}">Blog</a>
                                        </li>
                                    @endif

                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                    @if (!empty(Auth::user()))
                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                <i data-feather="zap"></i>
                                <span>Deal Today</span>
                            </button>
                        </div>
                    @else
                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal">
                                <i data-feather="zap"></i>
                                <a href="{{ route('login') }}" style="color:#0da487"><span> Deal Today</span></a>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="{{ url('/') }}">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/search') }}" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/wishlist') }}" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/carts') }}">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    {{ $slot }}


    <!-- Footer Section Start -->
    <footer class="section-t-space footer-section-2">
        <div class="container-fluid-lg">
            <div class="service-section">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="service-contain">
                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/product.svg') }}"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Every Fresh Products</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/delivery.svg') }}"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Free Delivery For Order Over ¥5000</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/discount.svg') }}"
                                        class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Daily Mega Discounts</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/market.svg') }}" class="blur-up lazyload"
                                        alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Best Price On The Market</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-footer section-b-space section-t-space">
                <div class="row g-md-4 g-3">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="/">
                                    <img src="{{ asset('images/logos/logo_foodsh.png') }}" class="blur-up lazyload"
                                        alt="">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>Specializing in Asian cuisine, we're dedicated to providing fresh, top-quality food
                                    to Japan daily.</p>

                                <ul class="address">
                                    <li>
                                        <i data-feather="home"></i>
                                        <a href="javascript:void(0)">4-27-5 Ikebukuro, Toshima-ku, Tokyo</a>
                                    </li>
                                    <li>
                                        <i data-feather="mail"></i>
                                        <a href="javascript:void(0)">support@asian-food.site</a>
                                    </li>
                                </ul>
                                <div class="sub-footer" style="border-top: none;">
                                    <div class="social-link" style="margin-top: 10px; justify-content: left;">
                                        <h5 class="text-content">Stay connected :</h5>
                                        <ul>
                                            <li>
                                                <a href="https://www.facebook.com/" target="_blank">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/" target="_blank">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/" target="_blank">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://in.pinterest.com/" target="_blank">
                                                    <i class="fa-brands fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Categories</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ url('/categorysidebar/' . $category->id) }}"
                                            class="text-content">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl col-lg-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Useful Links</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="{{ url('/') }}" class="text-content">Home</a>
                                </li>
                                <li>
                                    <a class="text-content " href="{{ url('/products') }}">Products</a>
                                </li>
                                <li>
                                    <a href="{{ route('shoplist') }}" class="text-content">Shop</a>
                                </li>
                                <li>
                                    <a href="{{ url('/news') }}" class="text-content">Blog</a>
                                </li>
                                <li>
                                    <a href="{{ url('/contact') }}" class="text-content">Contact Us</a>
                                </li>
                                <li>
                                    <a href="{{ url('/our-story') }}" class="text-content">Our Story</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Help Center</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                @if (empty(Auth::user()))
                                    <li>
                                        <a href="{{ route('seller.register') }}" class="text-content">Seller
                                            Register</a>
                                    </li>
                                @endif
                                @if (!empty(Auth::user()))
                                    <li>
                                        <a href="{{ route('user_profile') }}" class="text-content">Your Account</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('user_order') }}" class="text-content">Track Order</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/wishlist') }}" class="text-content">Your Wishlist</a>
                                </li>
                                <li>
                                    <a href="{{ url('/comparelist') }}" class="text-content">Your Compare List</a>
                                </li>
                                <li>
                                    <a href="{{ route('footer_search') }}" class="text-content">Search</a>
                                </li>
                                <li>
                                    <a href="{{ url('/faq') }}" class="text-content">FAQ</a>
                                </li>
                                <li>
                                    <a href="{{ url('/term-and-condition') }}" class="text-content">Terms and
                                        Conditions</a>
                                </li>

                                <li class="social-app mb-0">
                                    <a href="{{ url('/privacy-policy') }}" class="text-content">
                                        <h5 class="mb-2 text-content">Privacy policy</h5>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Contact Us</h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Hotline</h6>
                                            <h5>(+81) 03-3981-5090</h5>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Email Address :</h6>
                                            <h5>support@asian-food.site</h5>
                                        </div>
                                    </div>
                                </li>
                                <li class="social-app mb-0">
                                    {{-- just for ...... --}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">©2024 Asia Human Development, Inc. All rights reserved</h6>
                </div>

                <ul class="payment-box">
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/paypal.png') }}" style="width:80px"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/visa.png') }}"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/jcbcard.png') }}"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/american.png') }}" alt=""
                            class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/master-card.png') }}" alt=""
                            class="blur-up lazyload">
                    </li>

                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Deal Box Modal Start -->
    @php
        if (Auth::check()) {
            $buyer = DB::table('buyers')
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($buyer) {
                // $todayDate = Carbon::today()->toDateString();
                $todayDate = date('Y-m-d');

                // Perform the query to get today's deals
        $deal = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('products.*', 'order_details.payment_approved')
            ->where('order_details.buyer_id', $buyer->id)
            ->whereDate('order_details.created_at', $todayDate)
            ->orderBy('orders.order_code', 'desc')
                    ->get();
            } else {
                $deal = collect();
            }
        } else {
            $deal = collect();
        }
    @endphp
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        @if ($deal->count() > 0)
                            <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                            <p class="mt-1 text-content">Your ordered items for today.</p>
                        @else
                            <p class="mt-1 text-content">Today, no order yet.</p>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            @foreach ($deal as $list)
                                <li class="list-1">
                                    <div class="deal-offer-contain">
                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $list->id]) }}"
                                            class="deal-image">
                                            <img src="{{ asset('upload/product_thambnail/' . $list->product_thambnail) }}"
                                                class="blur-up lazyload" alt="">
                                        </a>

                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $list->id]) }}"
                                            class="deal-contain">
                                            <h5>{{ $list->product_name }}</h5>
                                            @if ($list->discount_percent != 0)
                                                <h6>¥{{ number_format($list->selling_price, '0', '', ',') }}<del>¥{{ number_format($list->original_price, '0', '', ',') }}</del>
                                                </h6>
                                            @else
                                                <h6>¥{{ number_format($list->selling_price, '0', '', ',') }}</h6>
                                            @endif
                                            @if ($list->payment_approved == 0)
                                                <span style="color: red">Payment transfer not yet!</span>
                                            @else
                                                @if ($list->estimate_date)
                                                    <span>Estimated Waiting Time : {{ $list->estimate_date }}
                                                        {{ $list->estimate_date > 1 ? 'days' : 'day' }}</span>
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->

    <!-- Tap to top and theme setting button start -->
    <div class="theme-option">
        <div class="setting-box">
            <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button>

            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>Color</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">Theme Color</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#0da487" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>Dark</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">Dark</button>
                                <button class="btn btn-2 unline" id="lightButton">Light</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->
    <!-- Logout modal start -->
    <div class="modal fade theme-modal remove-profile" id="staticBackdrop" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel">Logging Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>Are you sure you want to log out?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('adminlogout') }}">
                        @csrf
                        <button type="submit" class="btn btn-animation btn-md fw-bold"
                            style="background: #0da487; !important;">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                        style="background: #6c757d;">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout modal end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('frontend/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('frontend/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('frontend/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('frontend/assets/js/auto-height.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('frontend/assets/js/timer1.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('frontend/assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('frontend/assets/js/quantity-2.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <!-- theme setting js -->
    <script src="{{ asset('frontend/assets/js/theme-setting.js') }}"></script>

    <!-- sidebar open js -->
    <script src="{{ asset('frontend/assets/js/filter-sidebar.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.close_button').click(function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    url: '/remove-cart-product/' + productId,
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        var countElement = $('#unreadMessages');
                        var count = parseInt(countElement.text());
                        countElement.text(count - 1);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting cart item:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function isDesktopView() {
                return window.matchMedia("(min-width: 769px)").matches;
            }

            function handleHover() {
                if (isDesktopView()) {
                    $('.onhover-category-list').hover(function() {
                        var $hoverBox = $(this).find('.onhover-category-box');
                        var offset = $(this).position(); // Get the position relative to the parent

                        // Calculate the top position of the hover box to match the list item
                        var topPosition = offset.top;

                        $hoverBox.css({
                            'top': topPosition,
                            'left': '100%',
                            'display': '-ms-flexbox'
                        });
                    });
                } else {
                    $('.onhover-category-list').off('mouseenter mouseleave');
                }
            }

            // Initial check
            handleHover();

            // Re-check on window resize
            $(window).resize(function() {
                handleHover();
            });
        });
    </script>
</body>

</html>
