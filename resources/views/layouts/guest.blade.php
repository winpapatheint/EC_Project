<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <title>On-demand last-mile delivery</title>

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
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/bootstrap.css') }}">

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
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/scss/vendors/feather-icon/_feather-icon.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/scss/pages/_inner_pages.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/scss/vendors/bootstrap/_reboot.scss') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/scss/vendors/bootstrap/_grid.scss') }}">
    <style>

    header .navbar.navbar-expand-xl .navbar-nav .nav-link .menu::before
    {
        content:"" !important;
        position:absolute !important;
        font-family:"Font Awesome 6 Free" !important;
        font-weight:900 !important;right:-12px !important;top:50% !important;
        -webkit-transform:translateY(-50%) !important;
        transform:translateY(-50%) !important;
    }

    </style>
</head>

<body class="bg-effect">

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
                                        <h6><strong class="me-1">Welcome to the アジア食彩館 EC site!</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-language"
                                        data-bs-toggle="dropdown">
                                        <img src="../assets/images/country/united-states.png"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <span>English</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="english">
                                                <img src="../assets/images/country/united-kingdom.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="france">
                                                <img src="../assets/images/country/germany.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>Japanese</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-dollar"
                                        data-bs-toggle="dropdown">
                                        <span>USD</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end sm-dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="aud" href="javascript:void(0)">AUD</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="eur" href="javascript:void(0)">EUR</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="cny" href="javascript:void(0)">CNY</a>
                                        </li>
                                    </ul>
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
                                <img src="{{ asset('images/logos/logo_foods.png') }}" class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                <div class="location-box">
                                    <button class="btn location-button" data-bs-toggle="modal"
                                        data-bs-target="#locationModal">
                                        <span class="location-arrow">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                        <span class="locat-name">Your Location</span>
                                        <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                </div>

                                {{--<div class="search-box">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="I'm searching for..." id="mainSearch">
                                        <a href="{{ route('show-product') }}?mainSearch={{ urlencode(request()->input('search')) }}" id="searchButton"><button class="btn" type="button" id="button-addon2">
                                            <i data-feather="search"></i>
                                        </button></a>
                                    </div>
                                </div>--}}
                                <div class="search-box">
                                    <form id="mainSearchForm" action="{{ route('show-product') }}" method="GET">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="mainSearch" placeholder="I'm searching for...">
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
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
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
                                        <a href="{{ url('/wishlist') }}" class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <button type="button" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge">2
                                                    <span class="visually-hidden">unread messages</span>
                                                </span>
                                            </button>

                                            <div class="onhover-div">
                                                <ul class="cart-list">
                                                    <li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="product-left-thumbnail.html" class="drop-image">
                                                                <img src="../assets/images/vegetable/product/1.png"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="product-left-thumbnail.html">
                                                                    <h5>Fantasy Crunchy Choco Chip Cookies</h5>
                                                                </a>
                                                                <h6><span>1 x</span> $80.58</h6>
                                                                <button class="close-button close_button">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <li class="product-box-contain">
                                                        <div class="drop-cart">
                                                            <a href="product-left-thumbnail.html" class="drop-image">
                                                                <img src="../assets/images/vegetable/product/2.png"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="drop-contain">
                                                                <a href="product-left-thumbnail.html">
                                                                    <h5>Peanut Butter Bite Premium Butter Cookies 600 g
                                                                    </h5>
                                                                </a>
                                                                <h6><span>1 x</span> $25.68</h6>
                                                                <button class="close-button close_button">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="price-box">
                                                    <h5>Total :</h5>
                                                    <h4 class="theme-color fw-bold">$106.58</h4>
                                                </div>

                                                <div class="button-group">
                                                    <a href="{{ url('/cart') }}" class="btn btn-sm cart-button">View Cart</a>
                                                    <a href="{{ url('/checkout') }}" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side onhover-dropdown">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>Hello,</h6>
                                                <h5>My Account</h5>
                                            </div>
                                        </div>
                                        @if(empty(Auth::user()))
                                        <div class="onhover-div onhover-div-login">
                                            <ul class="user-box-name">
                                                <li class="product-box-contain">
                                                    <a href="{{ route('login') }}">Log In</a>
                                                </li>
                                                <li class="product-box-contain">
                                                    <a href="{{route ('user_register')}}">Buyer Register</a>
                                                </li>

                                            </ul>
                                        </div>
                                        @else
                                        <div class="onhover-div onhover-div-login">
                                            <ul class="user-box-name">
                                                <li class="product-box-contain">
                                                    <form method="POST" action="{{ route('adminlogout') }}">
                                                    @csrf
                                                        <a class="nav-link" id="pills-profile-tab" style="font-size: 12px; text-align: center;" href="route('adminlogout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                                    </form>
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
                                    <h5>Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <ul class="category-list">
                                @foreach ($categories as $category)
                                @if ($category['name'] != 'Special Corner')
                                    <li class="onhover-category-list">
                                        <a href="javascript:void(0)" class="category-name">
                                            <img src="{{ asset('images/'.$category['icon']) }}" alt="">
                                            <h6>{{ $category['name'] }}</h6>
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>

                                        <div class="onhover-category-box" style="height: fit-content;">
                                            @if (!empty($category['subcategories']))
                                            @php
                                            $displayedCategories = [];
                                            @endphp
                                            @foreach ($category['subcategories'] as $subcategory)
                                            @if (!in_array($subcategory['subid'], $displayedCategories))
                                            <div class="list-1">
                                                <div class="category-title-box">
                                                    <h5>{{ $subcategory['name'] }}</h5>
                                                </div>
                                                <ul>
                                                    @foreach ($category['sub'] as $sub)
                                                    @if($sub['subid']==$subcategory['subid'])
                                                    <li>
                                                        <a href="{{ url('/subcategorysidebar/'.$sub['id'])}}">{{ $sub['name'] }}</a>
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @php
                                            $displayedCategories[] = $subcategory['subid'];
                                            @endphp
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                    </li>
                                @endif
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
                                            @if(empty(Auth::user()))
                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ url('/') }}">Home</a>
                                            </li>
                                            @endif

                                            @if(!empty(Auth::user()))
                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="{{ url('/user') }}">Profile</a>

                                            </li>
                                            @endif
                                             <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ url('/products') }}">Products</a>
                                            </li>

                                            @if(empty(Auth::user()))
                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ route('shoplist') }}">Shop</a>
                                            </li>
                                            @endif

                                            @php
                                                $specialCornerFlag = 0;
                                                if ($myanmarProducts->count() > 0 || $koreaProducts->count() > 0 || $chinaProducts->count() > 0) {
                                                    $specialCornerFlag = 1;
                                                }
                                            @endphp



                                            @if ($specialCornerFlag == 1)
                                            <li class="nav-item dropdown dropdown-mega">
                                                <a class="nav-link menu dropdown-toggle ps-xl-2 ps-0"
                                                    href="javascript:void(0)" data-bs-toggle="dropdown">
                                                    <span class="menu">Special Corner</span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-2">
                                                    <div class="row">
                                                        <div class="dropdown-column col-xl-3">
                                                        @if($myanmarProducts->count() > 0)
                                                            <h5 class="dropdown-header">Myanmar Products</h5>
                                                            @foreach($myanmarProducts as $myanmarProduct)
                                                                <a class="dropdown-item" href="{{ route('show-product-left-thumbnail', ['id' => $myanmarProduct->id]) }}">
                                                                {{ $myanmarProduct->product_name }}</a>
                                                            @endforeach
                                                        @endif
                                                        </div>

                                                        <div class="dropdown-column col-xl-3">

                                                        @if($koreaProducts->count() > 0)
                                                            <h5 class="dropdown-header">Korea Products</h5>
                                                            @foreach($koreaProducts as $koreaProduct)
                                                                <a class="dropdown-item" href="{{ route('show-product-left-thumbnail', ['id' => $koreaProduct->id]) }}">
                                                                {{ $koreaProduct->product_name }}</a>
                                                            @endforeach
                                                        @endif
                                                        </div>

                                                        <div class="dropdown-column col-xl-3">

                                                        @if($chinaProducts->count() > 0)
                                                            <h5 class="dropdown-header">China Products</h5>
                                                            @foreach($chinaProducts as $chinaProduct)
                                                                <a class="dropdown-item" href="{{ route('show-product-left-thumbnail', ['id' => $chinaProduct->id]) }}">
                                                                {{ $chinaProduct->product_name }}</a>
                                                            @endforeach
                                                        @endif
                                                        </div>

                                                        <div class="dropdown-column dropdown-column-img col-3"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif

                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="{{ url('/faq') }}">FAQ</a>

                                            </li>

                                            @if(empty(Auth::user()))
                                            <li class="nav-item dropdown new-nav-item">
                                                <label class="new-dropdown">Blog</label>
                                                <a class="nav-link"  href="{{ url('/news') }}">Blog</a>
                                            </li>
                                            @endif

                                        </ul>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                <i data-feather="zap"></i>
                                <span>Deal Today</span>
                            </button>
                        </div>
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
                <a href="search.html" class="search-box">
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
                <a href="cart.html">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    {{ $slot }}


     <!-- Footer Section Start -->
     <footer class="section-t-space">
        <div class="container-fluid-lg">
            <div class="service-section">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="service-contain">
                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/product.svg') }}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Every Fresh Products</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/delivery.svg') }}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Free Delivery For Order Over $50</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/discount.svg') }}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="service-detail">
                                    <h5>Daily Mega Discounts</h5>
                                </div>
                            </div>

                            <div class="service-box">
                                <div class="service-image">
                                    <img src="{{ asset('frontend/assets/svg/market.svg') }}" class="blur-up lazyload" alt="">
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
                                <a href="index.html">
                                    <img src="../assets/images/logo/1.png" class="blur-up lazyload" alt="">
                                </a>
                            </div>

                            <div class="footer-logo-contain">
                                <p>We are a friendly bar serving a variety of cocktails, wines and beers. Our bar is a
                                    perfect place for a couple.</p>

                                <ul class="address">
                                    <li>
                                        <i data-feather="home"></i>
                                        <a href="javascript:void(0)">4-27-5 Ikebukuro, Toshima-ku, Tokyo</a>
                                    </li>
                                    <li>
                                        <i data-feather="mail"></i>
                                        <a href="javascript:void(0)">support@asia-hd.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Categories</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                            @foreach ($allCategories as $category)
                                <li>
                                    <a href="{{ url('/categorysidebar/'.$category->id)}}" class="text-content">{{ $category->category_name }}</a>
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
                                    <a href="index.html" class="text-content">Home</a>
                                </li>
                                <li>
                                    <a href="shop-left-sidebar.html" class="text-content">Shop</a>
                                </li>
                                <li>
                                    <a href="about-us.html" class="text-content">About Us</a>
                                </li>
                                <li>
                                    <a href="blog-list.html" class="text-content">Blog</a>
                                </li>
                                <li>

                                    <a href="contact-us.html" class="text-content">Contact Us</a>
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
                                <li>
                                    <a href="{{ route('seller.register') }}" class="text-content">Seller Register</a>
                                </li>
                                <li>
                                    <a href="user-dashboard.html" class="text-content">Your Account</a>
                                </li>
                                <li>
                                    <a href="order-tracking.html" class="text-content">Track Order</a>
                                </li>
                                <li>
                                    <a href="{{ url('/wishlist') }}" class="text-content">Your Wishlist</a>
                                </li>
                                <li>
                                    <a href="search.html" class="text-content">Search</a>
                                </li>
                                <li>
                                    <a href="{{ url('/faq') }}" class="text-content">FAQ</a>
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
                                            <h5>info@asia-hd.com</h5>
                                        </div>
                                    </div>
                                </li>

                                <li class="social-app mb-0">
                                    <h5 class="mb-2 text-content">Download App :</h5>
                                    <ul>
                                        <li class="mb-0">
                                            <a href="https://play.google.com/store/apps" target="_blank">
                                                <img src="../assets/images/playstore.svg" class="blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li class="mb-0">
                                            <a href="https://www.apple.com/in/app-store/" target="_blank">
                                                <img src="../assets/images/appstore.svg" class="blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                    </ul>
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

                <div class="payment">
                    <img src="../assets/images/payment/1.png" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content">Stay connected :</h6>
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
    </footer>
    <!-- Footer Section End -->

     <!-- Quick View Modal Box Start -->
     <div class="modal fade theme-modal view-modal" id="view-product" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="{{ asset('upload/product_thambnail/1711095325.jpg') }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                                <h4 class="price">$36.99</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">9 sold in last 16 hours</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                        Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                        Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                        muffin I love carrot cake sugar plum dessert bonbon.</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>Black Forest</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>W0690034</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Type:</h5>
                                            <h6>White Cream Cake</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Cake Size :</h4>
                                    <select class="form-select select-form-size">
                                        <option selected>Select Size</option>
                                        <option value="1.2">1/2 KG</option>
                                        <option value="0">1 KG</option>
                                        <option value="1.5">1/5 KG</option>
                                        <option value="red">Red Roses</option>
                                        <option value="pink">With Pink Roses</option>
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md add-cart-button icon">Add
                                        To Cart</button>
                                    <button onclick="location.href = 'product-left.html';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        View More Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Box End -->

    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Cookie Bar Box Start -->
    <div class="cookie-bar-box">
        <div class="cookie-box">
            <div class="cookie-image">
                <img src="../assets/images/cookie-bar.png" class="blur-up lazyload" alt="">
                <h2>Cookies!</h2>
            </div>

            <div class="cookie-contain">
                <h5 class="text-content">We use cookies to make your experience better</h5>
            </div>
        </div>

        <div class="button-group">
            <button class="btn privacy-button">Privacy Policy</button>
            <button class="btn ok-button">OK</button>
        </div>
    </div>
    <!-- Cookie Bar Box End -->

    <!-- Deal Box Modal Start -->
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            @foreach($deal as $list)
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="{{ asset('upload/product_thambnail/'.$list-> product_thambnail) }}" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>{{$list->product_name}}</h5>
                                        <h6>{{  $list->original_price - ($list->original_price * 10)/100 }} <del>{{ $list->original_price }}</del> <span>500 G</span></h6>
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

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

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
</body>

</html>
