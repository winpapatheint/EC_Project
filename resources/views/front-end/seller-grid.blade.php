<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Seller Grid</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Seller Grid</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Grid Section Start -->
    <section class="seller-grid-section">
        <div class="container-fluid-lg">
            <div class="row g-4">
                @foreach($lists as $shop => $seller)
                <div class="col-xxl-4 col-md-6">

                    <a href="{{ url("/shopleftsidebar/".$seller->id ) }}" class="seller-grid-box">
                        <div class="grid-contain">
                            <div class="seller-contact-details">
                                <div class="seller-contact">
                                    <div class="seller-icon">
                                        <i class="fa-solid fa-map-pin"></i>
                                    </div>

                                    <div class="contact-detail">
                                        <h5>Address: <span> {{ $seller -> zip_code }} {{ $seller -> city }} {{ $seller -> chome }} {{ $seller -> building }} {{ $seller -> room }}</span></h5>
                                    </div>
                                </div>

                                <div class="seller-contact">
                                    <div class="seller-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>

                                    <div class="contact-detail">

                                        <h5>Contact Us: <span>{{ $seller -> phone }}</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="contain-name">
                                <div>
                                    <h6>Since {{ \Carbon\Carbon::parse($seller->shop_establish)->format('Y') }}
                                    </h6>
                                    <h3>{{ $seller->shop_name }}</h3>
                                    <div class="product-rating">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $ratingWithProductCount[$shop][0])
                                                    <li><i data-feather="star" class="fill"></i></li>
                                                @else
                                                    <li><i data-feather="star"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <span>({{ $ratingWithProductCount[$shop][1] }} Reviews)</span>
                                    </div>
                                    @if ($seller->productss->count() > 1)
                                    <span class="product-label">{{ $seller->productss->count() }} Products</span>
                                    @else
                                    <span class="product-label">{{ $seller->productss->count() }} Product</span>
                                    @endif
                                </div>

                                <div class="grid-image">
                                    <img src="{{ asset('upload/shop/'.($seller->shop_logo)   ) }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>

            @include('components.pagination')
        </div>
    </section>
    <!-- Grid Section End -->

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

</x-guest-layout>
