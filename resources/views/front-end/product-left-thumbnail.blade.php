<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Product details</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <img src="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}" id="img-1"
                                                        data-zoom-image="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                            @foreach($multiImages as $image)
                                            <div>
                                                <div class="slider-image">
                                                    <img src="{{ asset('upload/multiImg/'.$image->photo_name) }}"
                                                        data-zoom-image="{{ asset('upload/multiImg/'.$image->photo_name) }}"
                                                        class="img-fluid image_zoom_cls-1 blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                            @foreach($multiImages as $image)
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ asset('upload/multiImg/'.$image->photo_name) }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                @if($product->discount_percent != null)
                                <h6 class="offer-top">{{ $product-> discount_percent }}% Off</h6>
                                @endif
                                <h2 class="name">{{ $product-> product_name }}</h2>
                                <div class="price-rating">
                                    @if ($product->discount_percent != null)
                                            <h5 class="price"><span class="theme-color">¥{{ $product->selling_price - ($product->selling_price * $product->discount_percent)/100 }}</span> 
                                            <del>¥ {{ $product->selling_price }}</del>
                                            <span class="offer theme-color">({{ $product-> discount_percent }}% off)</span></h3>
                                    @else
                                            <h5 class="price"><span class="theme-color">¥{{ $product->selling_price }}</span>
                                    @endif
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
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $starRating)
                                                    <li><i data-feather="star" class="fill"></i></li>
                                                @else
                                                    <li><i data-feather="star"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <span class="review"><?php echo $count; ?> Customer Review</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p>
                                        {{ $product->short_desc }}
                                    </p>
                                </div>

                                <div class="note-box product-package">
                                     <a type="button "                              
                                        class="btn btn-md bg-dark cart-button text-white w-100" href="{{route ('show_carts', ['id' => $id]) }}">
                                        Add To Cart</a>
                                   
                                </div>

                                <div class="progress-sec">
                                    <div class="left-progressbar">
                                    @php
                                        $orderedCount = 0;
                                    @endphp
                                    @foreach ($productOrdered as $ordered)
                                        @php
                                            $orderedCount += $ordered->qty;
                                        @endphp
                                    @endforeach
                                        <h6>Please hurry! Only {{ $product->product_qty - $orderedCount }} left in stock</h6>
                                        <div role="progressbar" class="progress warning-progress">
                                            <?php
                                            $percentage = ($orderedCount / $product->product_qty) * 100;
                                            ?>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?php echo $percentage; ?>%;"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="buy-box">
                                    <a href="{{ route('show-wishlist', ['id' => $id]) }}">
                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>
                                    <a href="{{ route('show-comparelist', ['id' => $id]) }}">
                                        <i data-feather="shuffle"></i>
                                        <span>Add To Compare</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab">Description</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                            data-bs-target="#info" type="button" role="tab">Additional info</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="care-tab" data-bs-toggle="tab"
                                            data-bs-target="#care" type="button" role="tab">Care
                                            Instructions</button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab">Review</button>
                                    </li>
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p>{{ $product->long_desc}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="info" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table info-table">
                                                <tbody>
                                                    <tr>
                                                        <td>Brand</td>
                                                        <td>
                                                            @php
                                                                $brand = DB::table('brands')->where('id',$product->brand_id)->first();
                                                            @endphp
                                                            {{ $brand->brand_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Form</td>
                                                        <td>
                                                            @php
                                                                $country = DB::table('countries')->where('id',$product->country_id)->first();
                                                            @endphp
                                                            {{ $country->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Category</td>
                                                        <td>
                                                            @php
                                                                $category = DB::table('categories')->where('id',$product->category_id)->first();
                                                            @endphp
                                                            {{ $category->category_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Seller</td>
                                                        <td>
                                                            @php
                                                                $seller = DB::table('sellers')->where('id',$product->seller_id)->first();
                                                                $seller_name = DB::table('users')->where('id',$seller->user_id)->first();
                                                            @endphp
                                                            {{ $seller_name->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Date</td>
                                                        <td>{{ $product->estimate_date }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="care" role="tabpanel">
                                        <div class="information-box">
                                            <ul>
                                                <li>Store cream cakes in a refrigerator. Fondant cakes should be
                                                    stored in an air conditioned environment.</li>

                                                <li>Slice and serve the cake at room temperature and make sure
                                                    it is not exposed to heat.</li>

                                                <li>Use a serrated knife to cut a fondant cake.</li>

                                                <li>Sculptural elements and figurines may contain wire supports
                                                    or toothpicks or wooden skewers for support.</li>

                                                <li>Please check the placement of these items before serving to
                                                    small children.</li>

                                                <li>The cake should be consumed within 24 hours.</li>

                                                <li>Enjoy your cake!</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="review" role="tabpanel">
                                        <div class="review-box">
                                            <div class="row">
                                                <div class="col-xl-5">
                                                    <div class="product-rating-box">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="product-main-rating">
                                                                @php
                                                                    $starRating = 0;
                                                                    $count = 0;
                                                                    $rate1 = 0;
                                                                    $rate2 = 0;
                                                                    $rate3 = 0;
                                                                    $rate4 = 0;
                                                                    $rate5 = 0;
                                                                    $reviews = DB::table('reviews')->where('product_id',$product->id)->get();
                                                                @endphp
                                                                @foreach ($reviews as $review)
                                                                    @php
                                                                        $count += 1;
                                                                        $starRating += $review->stars_rated;
                                                                        if ($review->stars_rated == 1) {
                                                                            $rate1 += 1;
                                                                        } elseif ($review->stars_rated == 2) {
                                                                            $rate2 += 1;
                                                                        } elseif ($review->stars_rated == 3) {
                                                                            $rate3 += 1;
                                                                        } elseif ($review->stars_rated == 4) {
                                                                            $rate4 += 1;
                                                                        } elseif ($review->stars_rated == 5) {
                                                                            $rate5 += 1;
                                                                        }
                                                                    @endphp

                                                                @endforeach
                                                                @if ($count != 0)
                                                                    @php
                                                                        $starRating = $starRating / $count;
                                                                    @endphp
                                                                @endif
                                                                    <h2>{{ $starRating }}
                                                                        <i data-feather="star"></i>
                                                                    </h2>

                                                                    <h5>5 Overall Rating</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <ul class="product-rating-list">
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>5<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" style="width: {{ ($count != 0) ? ($rate5 * 100 / $count) . '%' : '0%'}};">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">{{ $rate5 }}</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>4<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" style="width: {{ ($count != 0) ? ($rate4 * 100 / $count) . '%' : '0%'}};">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">{{ $rate4 }}</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>3<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" style="width: {{ ($count != 0) ? ($rate3 * 100 / $count) . '%' : '0%'}};">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">{{ $rate3 }}</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>2<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" style="width: {{ ($count != 0) ? ($rate2 * 100 / $count) . '%' : '0%'}};">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">{{ $rate2 }}</h5>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="rating-product">
                                                                            <h5>1<i data-feather="star"></i></h5>
                                                                            <div class="progress">
                                                                                <div class="progress-bar" style="width: {{ ($count != 0) ? ($rate1 * 100 / $count) . '%' : '0%'}};">
                                                                                </div>
                                                                            </div>
                                                                            <h5 class="total">{{ $rate1 }}</h5>
                                                                        </div>
                                                                    </li>

                                                                </ul>

                                                                <div class="review-title-2">
                                                                    <h4 class="fw-bold">Review this product</h4>
                                                                    <p>Let other customers know what you think</p>
                                                                    <button class="btn" type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#writereview">Write a
                                                                        review</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-7">
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                        @foreach ($reviews as $review)
                                                            @php
                                                                $user = DB::table('users')->where('id',$review->user_id)->first();
                                                            @endphp
                                                            <li>
                                                                <div class="people-box">
                                                                    <div>
                                                                        <div class="people-image people-text">
                                                                            <img alt="user" class="img-fluid "
                                                                                src="{{ asset('upload/product_thambnail/'.$user->user_photo) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="people-comment">
                                                                        <div class="people-name"><a
                                                                                href="javascript:void(0)"
                                                                                class="name">{{ $user->name }}</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content"> {{ \Carbon\Carbon::parse($review->updated_at)->format('d M Y h:i:s A') }}
                                                                                </h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                                            @if ($i <= $review->stars_rated)
                                                                                                <li><i data-feather="star" class="fill"></i></li>
                                                                                            @else
                                                                                                <li><i data-feather="star"></i></li>
                                                                                            @endif
                                                                                        @endfor
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="reply">
                                                                            <p>{{ $review->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-image">
                                    <img src="{{ asset('upload/shop/'.$product->seller->shop_logo) }}" class="blur-up lazyload" alt="">
                                </div>

                                <div class="vendor-name">
                                    <h5 class="fw-500">{{ $product->seller->shop_name }}</h5>

                                    <div class="product-rating mt-1">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $ratingWithProductCount[0])
                                                    <li><i data-feather="star" class="fill"></i></li>
                                                @else
                                                    <li><i data-feather="star"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <span>({{ $ratingWithProductCount[1] }} Reviews)</span>
                                    </div>

                                </div>
                            </div>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>Address: <span class="text-content">{{ $product->seller->zip_code }}</span><br>
                                            <span class="text-content">{{ $product->seller->city }}</span>
                                            <span class="text-content">{{ $product->seller->chome }}</span>
                                            <span class="text-content">{{ $product->seller->building }}</span>
                                            <span class="text-content">{{ $product->seller->room }}</span></h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>Contact Seller: <span class="text-content">{{ $product->seller->phone }}</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Trending Product -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Trending Products</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                @foreach ($topProducts as $topProduct)
                                    @php
                                        $prod = DB::table('products')->where('id',$topProduct->product_id)->first();
                                    @endphp
                                    @if ($prod)
                                    <li>
                                        <div class="offer-product">
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $prod->id]) }}" class="offer-image">
                                                <img src="{{ asset('upload/product_thambnail/'.$prod-> product_thambnail) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ asset('upload/product_thambnail/'.$prod-> product_thambnail) }}">
                                                        <h6 class="name">{{ $prod->product_name }}</h6>
                                                    </a>
                                                    @if ($prod->discount_percent != null)
                                                        <h6 class="price"><span class="theme-color">¥{{ $prod->selling_price - ($prod->selling_price * $prod->discount_percent)/100 }}</span> <del>¥{{ $prod->selling_price }}</del>
                                                    @else
                                                        <h5 class="price"><span class="theme-color">¥{{ $prod->selling_price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                        </div>

                    

                        <!-- Banner Section -->
                        {{-- <div class="ratio_156 pt-25">
                            <div class="home-contain">
                                <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                    alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h6 class="text-yellow home-banner">Seafood</h6>
                                        <h3 class="text-uppercase fw-normal"><span
                                                class="theme-color fw-bold">Freshes</span> Products</h3>
                                        <h3 class="fw-light">every hour</h3>
                                        <button onclick="location.href = 'shop-left-sidebar.html';"
                                            class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->

        <!-- Review Modal Start -->
        <div class="modal fade" id="writereview" tabindex="-1" aria-labellabedby="exambleModelLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('reviews') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="seller_id" value="{{ $product->seller_id }}">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                                <div class="product-wrapper">
                                        <div class="product-image">
                                            <img class="img-fluid" alt="Solid Collared Tshirts"
                                                src="">
                                        </div>
                                        <div class="product-content">
                                            <h5 class="name">{{ $product->product_name }}</h5>
                                            <div class="product-review-rating">
                                                <div class="product-rating">
                                                    <h6 class="price-number">{{ $product->price }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rating-css">
                                        <div class="star-icon">
                                            <input type="radio" value="1" name="rating" checked id="rating1">
                                            <label for="rating1" class="fa fa-star"></label>
                                            <input type="radio" value="2" name="rating" id="rating2">
                                            <label for="rating2" class="fa fa-star"></label>
                                            <input type="radio" value="3" name="rating" id="rating3">
                                            <label for="rating3" class="fa fa-star"></label>
                                            <input type="radio" value="4" name="rating" id="rating4">
                                            <label for="rating4" class="fa fa-star"></label>
                                            <input type="radio" value="5" name="rating" id="rating5">
                                            <label for="rating5" class="fa fa-star"></label>
                                        </div>
                                    </div>
                                    <div class="review-box">
                                        <label for="content" class="form-label">Comments</label>
                                        <textarea id="comment" name="comment" rows="3" class="form-control" placeholder="Comments"></textarea>
                                    </div>
                                </form>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-md btn-theme-outline fw-bold btn-close"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Review Modal End -->
            <!-- Bg overlay Start -->
</div>
    <!-- Bg overlay End -->

    </x-guest-layout>