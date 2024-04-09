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
                @foreach($lists as $data)
                <div class="col-xxl-4 col-md-6">

                    <a href="{{ url("/shopleftsidebar/".$data->user_id ) }}" class="seller-grid-box">
                        <div class="grid-contain">
                            <div class="seller-contact-details">
                                <div class="seller-contact">
                                    <div class="seller-icon">
                                        <i class="fa-solid fa-map-pin"></i>
                                    </div>

                                    <div class="contact-detail">
                                        <h5>Address: <span> {{ $data -> zip_code }} {{ $data -> city }} {{ $data -> chome }} {{ $data -> building }} {{ $data -> room }}</span></h5>
                                    </div>
                                </div>

                                <div class="seller-contact">
                                    <div class="seller-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>

                                    <div class="contact-detail">

                                        <h5>Contact Us: <span>{{ $data -> phone }}</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="contain-name">
                                <div>
                                    <h6>Since {{ date('Y') }}
                                    </h6>
                                    <h3>{{ $data->shop_name }}</h3>
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
                                        <h6 class="theme-color ms-2">(26)</h6>
                                    </div>
                                    <span class="product-label">{{ $data->product_count }}</span>
                                </div>

                                <div class="grid-image">
                                    <img src="{{ asset('upload/shop/'.($data->shop_logo)   ) }}" alt="" class="img-fluid">
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
