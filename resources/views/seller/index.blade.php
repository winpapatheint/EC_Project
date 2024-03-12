@extends('seller.seller_dashboard')
@section('seller')
<!-- index body start -->
 <div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <!-- chart card section start -->
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Revenue</span>
                                <h4 class="mb-0 counter">$6659
                                    <span class="badge badge-light-primary grow">
                                        <i data-feather="trending-up"></i>8.5%</span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-2-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Orders</span>
                                <h4 class="mb-0 counter">9856
                                    <span class="badge badge-light-danger grow">
                                        <i data-feather="trending-down"></i>8.5%</span>
                                </h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Products</span>
                                <h4 class="mb-0 counter">893
                                    <a href="add-new-product.html" class="badge badge-light-secondary grow">
                                        ADD NEW</a>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-chat-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Customers</span>
                                <h4 class="mb-0 counter">4.6k
                                    <span class="badge badge-light-success grow">
                                        <i data-feather="trending-down"></i>8.5%</span>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-user-add-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- chart card section End -->

            <!-- Sales / Purchase Return star-->
            <div class="col-12">
                <div class="card o-hidden">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>Sales / Purchase Return</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="sales-purchase-return-cart"></div>
                    </div>
                </div>
            </div>
            <!-- Sales / Purchase Return end-->

            <!-- Best Selling Product Start -->
            <div class="col-xl-6 col-md-12">
                <div class="card o-hidden card-hover">
                    <div class="card-header card-header-top card-header--2 px-0 pt-0">
                        <div class="card-header-title">
                            <h4>Best Selling Product</h4>
                        </div>

                        <div class="best-selling-box d-sm-flex d-none">
                            <span>Short By:</span>
                            <div class="dropdown">
                                <button class="btn p-0 dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                    data-bs-auto-close="true">Today</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div>
                            <div class="table-responsive">
                                <table class="best-selling-table w-image
                                w-image
                                w-image table border-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-image">
                                                        <img src="{{ asset('backend/assets/images/product/1.png') }}"
                                                            class="img-fluid" alt="Product">
                                                    </div>
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$29.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Orders</h6>
                                                    <h5>62</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Stock</h6>
                                                    <h5>510</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Amount</h6>
                                                    <h5>$1,798</h5>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-image">
                                                        <img src="{{ asset('backend/assets/images/product/2.png') }}"
                                                            class="img-fluid" alt="Product">
                                                    </div>
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$29.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Orders</h6>
                                                    <h5>62</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Stock</h6>
                                                    <h5>510</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Amount</h6>
                                                    <h5>$1,798</h5>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-image">
                                                        <img src="{{ asset('backend/assets/images/product/3.png') }}"
                                                            class="img-fluid" alt="Product">
                                                    </div>
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$29.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Orders</h6>
                                                    <h5>62</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Stock</h6>
                                                    <h5>510</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Amount</h6>
                                                    <h5>$1,798</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Best Selling Product End -->


            <!-- Recent orders start-->
            <div class="col-xl-6">
                <div class="card o-hidden card-hover">
                    <div class="card-header card-header-top card-header--2 px-0 pt-0">
                        <div class="card-header-title">
                            <h4>Recent Orders</h4>
                        </div>

                        <div class="best-selling-box d-sm-flex d-none">
                            <span>Short By:</span>
                            <div class="dropdown">
                                <button class="btn p-0 dropdown-toggle" type="button"
                                    id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                    data-bs-auto-close="true">Today</button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div>
                            <div class="table-responsive">
                                <table class="best-selling-table table border-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>#64548</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Date Placed</h6>
                                                    <h5>5/1/22</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$250.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Order Status</h6>
                                                    <h5>Completed</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Payment</h6>
                                                    <h5 class="text-danger">Unpaid</h5>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Date Placed</h6>
                                                    <h5>5/1/22</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$250.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Order Status</h6>
                                                    <h5>Completed</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Payment</h6>
                                                    <h5 class="theme-color">Paid</h5>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Date Placed</h6>
                                                    <h5>5/1/22</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$250.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Order Status</h6>
                                                    <h5>Completed</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Payment</h6>
                                                    <h5 class="theme-color">Paid</h5>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="best-product-box">
                                                    <div class="product-name">
                                                        <h5>Aata Buscuit</h5>
                                                        <h6>26-08-2022</h6>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Date Placed</h6>
                                                    <h5>5/1/22</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Price</h6>
                                                    <h5>$250.00</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Order Status</h6>
                                                    <h5>Completed</h5>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="product-detail-box">
                                                    <h6>Payment</h6>
                                                    <h5 class="theme-color">Paid</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent orders end-->

            <!-- Booking history start-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>Transfer History</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table class="user-table list-table table">
                                    <thead>
                                        <tr>
                                            <th>Transfer Id</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>14783112</td>
                                            <td>Gray Brody</td>
                                            <td>20-05-2020</td>
                                            <td>$369</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="ri-eye-line"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>87541221</td>
                                            <td>Perez Alonzo</td>
                                            <td>07-12-2020</td>
                                            <td>$546</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="ri-eye-line"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>213514462</td>
                                            <td>woters maxine</td>
                                            <td>12-12-2020</td>
                                            <td>$369</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="ri-eye-line"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>235896144</td>
                                            <td>christian</td>
                                            <td>16-05-2020</td>
                                            <td>$4699</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="ri-eye-line"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>461178242</td>
                                            <td>Lane Skylar</td>
                                            <td>25-10-2020</td>
                                            <td>$1342</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <span class="ri-eye-line"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-pencil"></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <span class="lnr lnr-trash"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Booking history  end-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- index body end -->
@endsection
