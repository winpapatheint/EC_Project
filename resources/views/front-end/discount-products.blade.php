<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Product List</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Discounted Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    @if($products->count() < 1)
        <h1 class="text-center">No Products Found</h1>
    @else
    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid active">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/assets/svg/grid-3.svg') }}" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/assets/svg/grid-4.svg') }}"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="{{ asset('frontend/assets/svg/grid.svg') }}"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block" alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="{{ asset('frontend/assets/svg/list.svg') }}" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div
                        class="row g-sm-4 g-3 product-list-section row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2">
                        @foreach ($products as $product)
                            @if ($product->status == 1)
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
                        <div>
                            <div class="product-box-3 h-100 wow fadeInUp" data-wow-delay="{{ $loop->index * 0.05 }}s">
                                <div class="product-header">
                                    <div class="product-image">
                                   
                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}">
                                        <img width="100" src="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}"
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
    <!-- Shop Section End -->
    @endif

    @foreach ($products as $product)
    @if ($product->status == 1)
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
    <!-- Quick View Modal Box Start -->
     <div class="modal fade theme-modal view-modal" id="view-product{{ $product->id }}" tabindex="-1">
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
                                <img src="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{ $product->product_name }}</h4>
                                @if ($product->discount_percent != null)
                                    <h4 class="price"><span class="theme-color">${{ $product->selling_price - ($product->selling_price * $product->discount_percent)/100 }}</span> <del>${{ $product->selling_price }}</del>
                                @else
                                    <h4 class="price"><span class="theme-color">${{ $product->selling_price }}</span>
                                @endif
                                <div class="product-rating">
                                    <ul class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $starRating)
                                                <li><i data-feather="star" class="fill"></i></li>
                                            @else
                                                <li><i data-feather="star"></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                    <span class="ms-2">{{ $count}} Reviews</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{{ $product->long_desc }}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>
                                                @php
                                                    $brand = DB::table('brands')->where('id',$product->brand_id)->first();
                                                @endphp
                                                {{ $brand->brand_name }}
                                            </h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{ $product->product_code }}</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Category:</h5>
                                            <h6>
                                                @php
                                                    $category = DB::table('categories')->where('id',$product->category_id)->first();
                                                @endphp
                                                {{ $category->category_name }}
                                            </h6>
                                        </div>
                                    </li>
                                </ul>
                                {{-- remain --}}
                                <div class="modal-button">
                                    <form method="GET" action="{{ route('show_carts', ['id' => $product->id]) }}" >
                                        @csrf
                                        <button onclick="location.href = 'cart.html';"
                                            class="btn btn-md add-cart-button icon">Add
                                            To Cart</button>
                                    </form>
                                    
                                    <button onclick="location.href = '{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}';"
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
    @endif
    @endforeach
</x-guest-layout>