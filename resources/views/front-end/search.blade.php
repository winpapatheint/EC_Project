<x-guest-layout>
    <style>
        ul.nav{
            list-style-type: none !important;
        }

    </style>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Search</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<body>
    <!-- Search Bar Section Start -->
    <section class="search-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="search-box">
                        <form id="mainSearchForm" action="{{ route('footer_search') }}" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="footerSearch" placeholder="">
                                <button class="btn theme-bg-color text-white m-0" type="submit" id="button-addon1">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar Section End -->
    <!-- Product Section Start -->
    <section class="section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="search-product product-wrapper category-slider-2 product-wrapper no-arrow">
                        @foreach ($products as $product)
                            @if ($product->status == 1)
                            <div>
                                @php
                                    $starRating = 0;
                                    $count = 0;
                                @endphp
                                @foreach ($reviews as $review)
                                    @if ($product->id == $review->product_id)
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
                                <div class="product-box-3 h-100">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}">
                                                <img width="100" src="{{ asset('upload/product_thambnail/'.$product->product_thambnail) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <ul class="product-option d-flex justify-content-center">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view-product{{ $product->id }}" data-product="{{ $product->id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="{{ route('show-comparelist', ['id' => $product->id ]) }}">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="{{ route('show-wishlist', ['id' => $product->id]) }}" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">Vegetable</span>
                                            <a href="{{ url('/product-left-thumbnail') }}">
                                                <h5 class="name">{{ $product->product_name }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{ $product->short_desc }}</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $starRating)
                                                            <li><i data-feather="star" class="fill"></i></li>
                                                        @else
                                                            <li><i data-feather="star"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                                <span>(<?php echo number_format($starRating, 1); ?>)</span>
                                            </div>
                                            <h6 class="unit">{{ $product->product_size }}</h6>
                                            <h5 class="price">
                                                <span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                                @if ($product->discount_percent != null)
                                                    <del>¥{{ number_format($product->selling_price, 0, '', ',') }}</del>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    </body>

    </x-guest-layout>