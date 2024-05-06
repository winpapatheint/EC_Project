
<x-guest-layout>
    <style>
        .home-section pt-2
        {
        background-image: url(../assets/images/vegetable/banner/1.jpg);
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        display: block;
        }

    </style>
        <!-- Home Section Start -->
        <section class="home-section pt-2">
            <div class="container-fluid-lg">
                <div class="row g-4">
                    <div class="col-xl-8 ratio_65">
                        <div class="home-contain h-100">
                            <div class="h-100">
                                <img src="{{ asset('frontend/assets/images/homepage/11.jpg') }}" class="bg-img blur-up lazyload" alt="">
                            </div>
                                <div class="home-detail p-center-left w-75">
                                    <div>
                                    @if ($productsGroupedByDiscount[30] != null)
                                        <h6>Exclusive offer <span>30% OFF</span></h6>
                                    @endif
                                        <h1 class="text-uppercase">Stay home & delivered your <span class="daily">Daily
                                            Needs</span></h1>
                                        <p class="w-75 d-none d-sm-block">Vegetables contain many vitamins and minerals that are
                                            good for your health.</p>
                                    @if ($productsGroupedByDiscount[30] != null)
                                        <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[30]]) }}';"
                                            class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">Shop Now
                                            <i class="fa-solid fa-right-long icon"></i></button>
                                    @endif
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="col-xl-4 ratio_65">
                        <div class="row g-4">
                                <div class="col-xl-12 col-md-6">
                                    <div class="home-contain">
                                        <img src="{{ asset('frontend/assets/images/homepage/12.jpg') }}"
                                            class="bg-img blur-up lazyload" alt="">
                                        <div class="home-detail p-center-left home-p-sm w-75">
                                            <div>
                                            @if ($productsGroupedByDiscount[45] != null)
                                                <h2 class="mt-0 text-danger">45% <span class="discount text-title">OFF</span>
                                                </h2>
                                            @endif
                                                <h3 class="theme-color">Nut Collection</h3>
                                                <p class="w-75">We deliver organic vegetables & fruits</p>
                                            @if ($productsGroupedByDiscount[45] != null)
                                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[45]]) }}"
                                                    class="shop-button">Shop Now
                                                    <i class="fa-solid fa-right-long"></i></a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-md-6">
                                    <div class="home-contain">
                                        <img src="{{ asset('frontend/assets/images/homepage/13.jpg') }}" class="bg-img blur-up lazyload"
                                            alt="">
                                        <div class="home-detail p-center-left home-p-sm w-75">
                                            <div>
                                            @if ($productsGroupedByDiscount[50] != null)
                                                <h2 class="mt-0 text-danger">50% <span class="discount text-title">OFF</span>
                                                </h2>
                                            @endif
                                                <h3 class="theme-color">Nut Collection</h3>
                                                <p class="w-75">We deliver organic vegetables & fruits</p>
                                            @if ($productsGroupedByDiscount[50] != null)
                                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[50]]) }}" class="shop-button">Shop Now <i
                                                        class="fa-solid fa-right-long"></i></a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Home Section End -->

        <!-- Banner Section Start -->
        <section class="banner-section ratio_60 wow fadeInUp">
            <div class="container-fluid-lg">
                <div class="banner-slider">
                    <div>
                        <div class="banner-contain hover-effect">
                            <img src={{ asset('frontend/assets/images/homepage/egg.jpg') }} class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                @if ($productsGroupedByDiscount[5] != null)
                                    <h6 class="text-danger">5% OFF</h6>
                                @endif
                                    <h5>Hot Deals on New Items</h5>
                                    <h6 class="text-content">Daily Essentials Eggs & Dairy</h6>
                                </div>
                                @if ($productsGroupedByDiscount[5] != null)
                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[5]]) }}" class="banner-button text-white">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="banner-contain hover-effect">
                            <img src={{ asset('frontend/assets/images/homepage/vegetable.jpg') }} class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                @if ($productsGroupedByDiscount[10] != null)
                                    <h6 class="text-danger">10% OFF</h6>
                                @endif
                                    <h5>Buy More & Save More</h5>
                                    <h6 class="text-content">Fresh Vegetables</h6>
                                </div>
                                @if ($productsGroupedByDiscount[10] != null)
                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[10]]) }}" class="banner-button text-white">Shop Now
                                        <i class="fa-solid fa-right-long ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="banner-contain hover-effect">
                            <img src={{ asset('frontend/assets/images/homepage/meat.jpg') }} class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                @if ($productsGroupedByDiscount[15] != null)
                                    <h6 class="text-danger">15% OFF</h6>
                                @endif
                                    <h5>Organic Meat Prepared</h5>
                                    <h6 class="text-content">Delivered to Your Home</h6>
                                </div>
                                @if ($productsGroupedByDiscount[15] != null)
                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[15]]) }}" class="banner-button text-white">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="banner-contain hover-effect">
                            <img src={{ asset('frontend/assets/images/homepage/snack.jpg')  }} class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details">
                                <div class="banner-box">
                                @if ($productsGroupedByDiscount[20] != null)
                                    <h6 class="text-danger">20% OFF</h6>
                                @endif
                                    <h5>Buy More & Save More</h5>
                                    <h6 class="text-content">Nuts & Snacks</h6>
                                </div>
                                @if ($productsGroupedByDiscount[20] != null)
                                <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[20]]) }}" class="banner-button text-white">Shop Now <i
                                        class="fa-solid fa-right-long ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Section End -->

        <!-- Product Section Start -->
        <section class="product-section">
            <div class="container-fluid-lg">
                <div class="row g-sm-4 g-3">
                    <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                        <div class="p-sticky">
                            <div class="category-menu">
                                <h3>Category</h3>
                                <ul>
                                    @foreach($categories as $list)
                                    @if ($list->category_name != "Special Corner")
                                    <li>

                                        <div class="category-list">
                                            <img src="{{ asset('images/'.$list->category_icon)}}" class="blur-up lazyload" alt="">

                                            <h5>
                                                <a href="{{ url("/categorysidebar/".$list->id ) }}">{{ $list->category_name }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>

                                <ul class="value-list">
                                    <li>
                                        <div class="category-list">
                                            <h5 class="ms-0 text-title">
                                                <a href="{{ route('show-discount-product', ['topic' => 'value-of-the-day']) }}">Value of the Day</a>
                                            </h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="category-list">
                                            <h5 class="ms-0 text-title">
                                                <a href="{{ route('show-discount-product', ['topic' => 'top-50-offers']) }}">Top 50 Offers</a>
                                            </h5>
                                        </div>
                                    </li>
                                    <li class="mb-0">
                                        <div class="category-list">
                                            <h5 class="ms-0 text-title">
                                                <a href="{{ route('show-discount-product', ['topic' => 'new-arrivals']) }}">New Arrivals</a>
                                            </h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="ratio_156 section-t-space">
                                <div class="home-contain hover-effect">
                                    <img src="{{ asset('frontend/assets/images/homepage/freshproduct.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                        @if($seafood != null)
                                            <h6 class="text-yellow home-banner">Seafood</h6>
                                        @endif
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">Freshes</span> Products</h3>
                                            <h3 class="fw-light">every hour</h3>
                                        @if($seafood != null)
                                            <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $seafood]) }}';"
                                                class="btn btn-animation btn-md mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ratio_medium section-t-space">
                                <div class="home-contain hover-effect">
                                    <img src="{{ asset('frontend/assets/images/homepage/organic.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h4 class="text-yellow text-exo home-banner">Organic</h4>
                                            <h2 class="text-uppercase fw-normal mb-0 text-russo theme-color">fresh</h2>
                                            <h2 class="text-uppercase fw-normal text-title">Vegetables</h2>
                                        @if($vegetableHalfDiscount != null)
                                            <p class="mb-3">Super Offer to 50% Off</p>
                                            <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $vegetableHalfDiscount]) }}';"
                                                class="btn btn-animation btn-md mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(count($trendingProducts) > 0)
                            <div class="section-t-space">
                                <div class="category-menu">
                                    <h3>Trending Products</h3>

                                    <ul class="product-list border-0 p-0 d-block">
                                    @foreach($trendingProducts as $trending)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('show-product-left-thumbnail', ['id' => $trending->id]) }}" class="offer-image">
                                                    <img src="{{ asset('upload/product_thambnail/'.$trending->product_thambnail)}}"
                                                        class="blur-up lazyload" alt="">
                                                </a>

                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $trending->id]) }}" class="text-title">
                                                            <h6 class="name">{{ $trending->product_name }}</h6>
                                                        </a>
                                                        <span>{{ $trending->product_size}}</span>
                                                        <h6 class="price theme-color">¥{{ number_format($trending->selling_price, 0, '.', ',') }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                            @if ($maxStarsRatedRow)
                            <div class="section-t-space">
                                <div class="category-menu">
                                    <h3>Customer Comment</h3>
                                    <div class="review-box">
                                        <div class="review-contain">
                                            <h5 class="w-75">We Care About Our Customer Experience</h5>
                                            <p>{{ $maxStarsRatedRow -> comment }}</p>
                                        </div>

                                        <div class="review-profile">
                                            <div class="review-image">
                                                <img src="{{ asset('upload/profile/'.$maxStarsRatedRow ->user_photo) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>
                                            <div class="review-detail">
                                                <h5>{{ $maxStarsRatedRow -> name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-xxl-9 col-xl-8">
                    @if ($coupons->count() > 0)
                    @if(count($topSaveTodayProducts) > 0)
                        <div class="title title-flex">
                            <div>
                                <h2>Today Coupon Items</h2>
                                <span class="title-leaf">
                                    <svg class="icon-width">
                                        <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                    </svg>
                                </span>
                                <p>Don't miss this opportunity at a special discount just for this week.</p>
                            </div>
                            <div class="timing-box">
                                <div class="timing">
                                    <i data-feather="clock"></i>
                                    <h6 class="name">Expires in :</h6>
                                    <div class="time" id="clockdiv-1">
                                        <ul>
                                            <li>
                                                <div class="counter">
                                                    <div class="days">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="hours">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="minutes">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="seconds">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-b-space">
                            <div class="product-border border-row overflow-hidden">
                                <div class="product-box-slider no-arrow">
                                    @foreach($topSaveTodayProducts as $topSaveProduct)
                                        <div>
                                            <div class="row m-0">
                                                @php
                                                    $starRating = 0;
                                                    $count = 0;
                                                @endphp
                                                @foreach ($reviews as $review)
                                                    @if ($topSaveProduct->id == $review->product_id)
                                                        @php
                                                            $count += 1;
                                                            $starRating += $review->stars_rated;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if ($count != 0)
                                                    @php
                                                        $starRating = $starRating / $count;
                                                    @endphp
                                                @endif
                                                <div class="col-12 px-0">
                                                    <div class="product-box">
                                                    @if ($topSaveProduct->created_at->diffInDays(\Carbon\Carbon::now()) < 7)
                                                        <div class="label-tag">
                                                            <span>NEW</span>
                                                        </div>
                                                    @endif
                                                        <div class="product-image">
                                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $topSaveProduct->id]) }}">
                                                                <img src="{{ asset('upload/product_thambnail/'.$topSaveProduct->product_thambnail)}}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product-detail">
                                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $topSaveProduct->id]) }}">
                                                                <h6 class="name">{{ $topSaveProduct->product_name }}</h6>
                                                            </a>
                                                            <h5 class="sold text-content">
                                                                    <span class="theme-color price">¥{{ number_format($topSaveProduct->selling_price, 0, '.', ',') }}</span>

                                                                @if ($topSaveProduct->discount_percent != null)
                                                                    <del>¥{{ number_format($topSaveProduct->original_price, 0, '.', ',') }}</del>
                                                                @endif
                                                            </h5>
                                                            <div class="product-rating mt-sm-2 mt-1">
                                                                <ul class="rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $starRating)
                                                                            <li><i data-feather="star" class="fill"></i></li>
                                                                        @else
                                                                            <li><i data-feather="star"></i></li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                                @if ($topSaveProduct->product_qty > 0)
                                                                    <h6 class="theme-color">{{ $topSaveProduct->product_qty }}In Stock</h6>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="slider-1 product-wrapper no-arrow">
                        @if ($coupons->count() > 0)
                            @foreach($coupons as $coupon)
                                <a href="{{ route('show-coupon-product', ['id' => $coupon->id]) }}">
                                <div class="section-t-space section-b-space">
                                    <div class="banner-contain">
                                        <img src="{{ asset('frontend/assets/images/homepage/coupon.jpg') }}" class="bg-img blur-up lazyload" alt="">
                                        <div class="banner-details p-center p-4 text-white text-center">
                                            <div>
                                                <h3 class="lh-base fw-bold offer-text">{{ $coupon->name }}</h3>
                                                <h4 class="lh-base fw-bold offer-text">
                                                    Get ¥{{ $coupon->discount_amount }} Cashback! Min Order of
                                                        ¥{{ $coupon->mini_amount}}
                                                </h4>
                                                <h5 class="lh-base fw-bold offer-text">
                                                    {{ date('Y-m-d H:i', strtotime($coupon->startdate)) }} ~
                                                    {{ date('Y-m-d H:i', strtotime($coupon->enddate)) }}
                                                </h5>
                                                <h6 class="coupon-code">Use Code : {{ $coupon->coupon_code}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        @endif
                        </div>
                    @endif
                    @endif

                        <div class="title">
                            <h2>Bowse by Categories</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>Top Categories Of The Week</p>
                        </div>

                        <div class="category-slider-2 product-wrapper no-arrow">
                            @foreach($categories as $list)
                            <div>
                                <a href="{{ url("/categorysidebar/".$list->id ) }}" class="category-box category-dark">
                                    <div>
                                        <img src="{{ asset('images/'.$list->category_icon) }}" class="blur-up lazyload" alt="">
                                        <h5>{{ $list->category_name }}</h5>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <div class="section-t-space section-b-space">
                            <div class="row g-md-4 g-3">
                                <div class="col-md-6">
                                    <div class="banner-contain hover-effect">
                                        <img src="{{ asset('frontend/assets/images/homepage/freshmeat.jpg') }}" class="bg-img blur-up lazyload"
                                            alt="">
                                        <div class="banner-details p-center-left p-4">
                                            <div>
                                            @if($meatHalfDiscount != null)
                                                <h3 class="text-exo">50% offer</h3>
                                            @endif
                                                <h4 class="text-russo fw-normal theme-color mb-2">Fresh MEAT</h4>
                                            @if($meatHalfDiscount != null)
                                                <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $meatHalfDiscount]) }}';"
                                                    class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="banner-contain hover-effect">
                                        <img src="{{ asset('frontend/assets/images/homepage/freshvegetable.jpg') }}" class="bg-img blur-up lazyload"
                                            alt="">
                                        <div class="banner-details p-center-left p-4">
                                            <div>
                                            @if($vegetableHalfDiscount != null)
                                                <h3 class="text-exo">50% offer</h3>
                                            @endif
                                                <h4 class="text-russo fw-normal theme-color mb-2">Fresh Vegetable</h4>
                                            @if($vegetableHalfDiscount != null)
                                                <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $vegetableHalfDiscount]) }}';"
                                                    class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-t-space section-b-space">
                            <div class="row g-md-4 g-3">
                                <div class="col-xxl-8 col-xl-12 col-md-7">
                                    <div class="banner-contain hover-effect">
                                        <img src="{{ asset('frontend/assets/images/homepage/juice.jpg')}}" class="bg-img blur-up lazyload"
                                            alt="">
                                        <div class="banner-details p-center-left p-4">
                                            <div>
                                            @if ($productsGroupedByDiscount[25] != null)
                                                <h2 class="text-kaushan fw-normal text-danger">25% Off</h2>
                                            @endif
                                                <h2 class="text-kaushan fw-normal theme-color">Get Ready To</h2>
                                                <h3 class="mt-2 mb-3">TAKE ON THE DAY!</h3>
                                                <p class="text-content banner-text">In publishing and graphic design, Lorem
                                                    ipsum is a placeholder text commonly used to demonstrate.</p>
                                            @if ($productsGroupedByDiscount[25] != null)
                                                <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[25]]) }}';"
                                                    class="btn btn-animation btn-sm mend-auto">Shop Now <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-xl-12 col-md-5">
                                        <img src="{{ asset('frontend/assets/images/homepage/summerproduct.jpg')}}" class="bg-img blur-up lazyload"
                                            alt="">
                                @if ($productsGroupedByDiscount[20] != null)
                                    <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[20]]) }}" class="banner-contain hover-effect h-100">
                                        <div class="banner-details p-center-left p-4 h-100">
                                            <div>
                                                <h2 class="text-kaushan fw-normal text-danger">20% Off</h2>
                                                <h3 class="mt-2 mb-2 theme-color">SUMMRY</h3>
                                                <h3 class="fw-normal product-name text-title">Product</h3>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                                </div>
                            </div>
                        </div>

                        @php
                            $productCount = $bestSellerProducts->count();
                        @endphp
                        @if($productCount > 0)
                        <div class="title d-block">
                            <div>
                                <h2>Our best Seller</h2>
                                <span class="title-leaf">
                                    <svg class="icon-width">
                                        <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                    </svg>
                                </span>
                                <p>A virtual assistant collects the products from your list</p>
                            </div>
                        </div>

                        <div class="best-selling-slider product-wrapper wow fadeInUp">
                        @for ($i = 0; $i < ceil($productCount / 4); $i++)
                            @php
                                $index = $i * 4;
                            @endphp
                            <div>
                                <ul class="product-list">
                                 @for ($j = 0; $j < 4 && ($index + $j) < $productCount; $j++)
                                    @php
                                        $product = $bestSellerProducts[$index + $j];
                                    @endphp
                                    <li>
                                        <div class="offer-product">
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}" class="offer-image">
                                                <img src="{{ asset('upload/product_thambnail/'.$product->product_thambnail)}}"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}" class="text-title">
                                                        <h6 class="name">{{ $product->product_name }}</h6>
                                                    </a>
                                                    <span>{{ $product->product_size }}</span>
                                                    <h6 class="price theme-color">¥{{ number_format($product->selling_price, 0, '.', ',') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                                </ul>
                            </div>
                        </div>
                            @endfor
                            @endif

                        <div class="section-t-space">
                            <div class="banner-contain hover-effect">
                                <img src="{{ asset('frontend/assets/images/homepage/summer.jpg') }}" class="bg-img blur-up lazyload" alt="">
                                <div class="banner-details p-center banner-b-space w-100 text-center">
                                    <div>
                                        <h6 class="ls-expanded theme-color mb-sm-3 mb-1">SUMMER</h6>
                                        <h2 class="banner-title">VEGETABLE</h2>
                                    @if($vegetable != null)
                                        <button onclick="location.href = '{{ route('show-discount-product', ['ids' => $vegetable]) }}';"
                                            class="btn btn-animation btn-sm mx-auto mt-sm-3 mt-2">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="title section-t-space">
                            <h2>Featured Blog</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                </svg>
                            </span>
                            <p>A virtual assistant collects the products from your list</p>
                        </div>

                        <div class="slider-3-blog ratio_65 no-arrow product-wrapper">

                        @foreach($blogs as $list)
                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="{{ url('/blogdetail/'.$list->id ) }}" class="blog-image">
                                            <img src="{{ asset('images/'.($list->image)   ) }}" class="bg-img blur-up lazyload"
                                                alt="">
                                        </a>
                                    </div>

                                    <a href="{{ url('/blogdetail/'.$list->id ) }}" class="blog-detail">
                                        <h6>{{ date('Y\年m\月d\日', strtotime($list->created_at)) }} </h6>
                                        <h5>{{ $list->title }}</h5>
                                    </a>
                                </div>
                            </div>

                        @endforeach

                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="{{ url('/blogdetail/'.$list->id ) }}" class="blog-image">
                                            <img src="../assets/images/vegetable/blog/2.jpg" class="bg-img blur-up lazyload"
                                                alt="">
                                        </a>
                                    </div>

                                    <a href="{{ url('/blogdetail/'.$list->id ) }}" class="blog-detail">
                                        <h6>10 April, 2022</h6>
                                        <h5>Fresh Combo Fruit</h5>
                                    </a>
                                </div>
                            </div>

                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="blog-detail.html" class="blog-image">
                                            <img src="../assets/images/vegetable/blog/3.jpg" class="bg-img blur-up lazyload"
                                                alt="">
                                        </a>
                                    </div>

                                    <a href="blog-detail.html" class="blog-detail">
                                        <h6>10 April, 2022</h6>
                                        <h5>Nuts to Eat for Better Health</h5>
                                    </a>
                                </div>
                            </div>

                            <div>
                                <div class="blog-box">
                                    <div class="blog-box-image">
                                        <a href="blog-detail.html" class="blog-image">
                                            <img src="../assets/images/vegetable/blog/1.jpg" class="bg-img blur-up lazyload"
                                                alt="">
                                        </a>
                                    </div>

                                    <a href="blog-detail.html" class="blog-detail">
                                        <h6>20 March, 2022</h6>
                                        <h5>Fresh Vegetable Online</h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Product Section End -->

        <!-- Newsletter Section Start -->
        <section class="newsletter-section section-b-space">
            <div class="container-fluid-lg">
                <div class="newsletter-box newsletter-box-2">
                    <div class="newsletter-contain py-5">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                    <div class="newsletter-detail">
                                        <h2>Join our newsletter and get...</h2>
                                        <h5>$20 discount for your first order</h5>
                                        <div class="input-box">
                                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Enter Your Email">
                                            <i class="fa-solid fa-envelope arrow"></i>
                                            <button class="sub-btn  btn-animation">
                                                <span class="d-sm-block d-none">Subscribe</span>
                                                <i class="fa-solid fa-arrow-right icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter Section End -->
        @php
            $remainingTime = 0;
            if ($coupons->count() > 0)
            {
                $targetDate = strtotime($coupons[0]->enddate);
                $remainingTime = ($targetDate - time()) * 1000;
            }
            if ($remainingTime < 0) {
                $remainingTime = 0;
            }
        @endphp

        <!-- Timer Js -->
        <script src="{{ asset('frontend/assets/js/timer1.js') }}"></script>
        <script>
            var remainingTime = {{ $remainingTime }};
            var deadline = new Date(Date.parse(new Date()) + remainingTime);
            console.log(deadline);
            initializeClock('clockdiv-1', deadline);
        </script>


    </x-guest-layout>
