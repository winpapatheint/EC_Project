<x-auth-layout>
    <div class="page-body">
        <!-- Product Detail Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-8 m-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header-2">
                                            <h5>Shop Information</h5>
                                        </div>

                                        <form class="theme-form theme-form-2 mega-form">
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Shop Name</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->shop_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Shop Logo
                                                    </label>
                                                <div class="col-sm-9">
                                                    <img width="100" src="{{ asset('/upload/shop/'.$shop-> shop_logo) }}">
                                                </div>
                                            </div>
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Shop Establish</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->shop_establish }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->phone }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Zip Code</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->zip_code }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">City</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->city }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Chome</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->chome }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Building</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->building }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Room</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $shop->room }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Coupon Code</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon_code }}</p>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Detail End -->
    </div>
    </x-auth-layout>
