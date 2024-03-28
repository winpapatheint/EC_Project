<x-guest-layout>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<div class="page-body">
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>User Dashboard</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">User Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-3 col-lg-4">
                    <div class="dashboard-left-sidebar">
                        <div class="close-button d-flex d-lg-none">
                            <button class="close-sidebar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="profile-box">
                            <div class="cover-image">
                                <img src="../assets/images/inner-page/cover-img.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <img src="../assets/images/inner-page/user/1.jpg"
                                            class="blur-up lazyload update_img" alt="">
                                        <div class="cover-icon">
                                            <i class="fa-solid fa-pen">
                                                <input type="file" onchange="readURL(this,0)">
                                            </i>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-name">
                                    <h3>Vicki E. Pope</h3>
                                    <h6 class="text-content">vicki.pope@gmail.com</h6>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" style="font-size: 12px; text-align: center;"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item active" role="presentation">
                                <a class="nav-link" id="pills-order-tab" 
                                    style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-order')}}"><i
                                        data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail" 
                                    type="button" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-delivery')}}"><i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                        data-feather="map-pin"></i>Address</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('user_cards')}}"><i
                                        data-feather="credit-card"></i>Payment Methods</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- User Dashboard Section End -->

                <div class="col-xxl-9 col-lg-8" class="tab-pane fade" id="pills-order" role="tabpanel">
                    <!-- Orders Details Start -->
                        <div class="page-body">
                <!-- tracking table start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header title-header-block package-card">
                                        <div>
                                            <h5>Order #36648</h5>
                                        </div>
                                        <div class="card-order-section">
                                            <ul>
                                                <li>October 21, 2021 at 9:08 pm</li>
                                                <li>6 items</li>
                                                <li>Total $5,882.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="bg-inner cart-section order-details-table">
                                        <div class="row g-4">
                                            <div class="col-xl-8">
                                                <div class="table-responsive table-details">
                                                    <table class="table cart-table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="2">Items</th>
                                                                <th class="text-end" colspan="2">
                                                                    <a href="javascript:void(0)"
                                                                        class="theme-color">Edit
                                                                        Items</a>
                                                                </th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <tr class="table-order">
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="assets/images/profile/1.jpg"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p>Product Name</p>
                                                                    <h5>Outwear & Coats</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Quantity</p>
                                                                    <h5>1</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Price</p>
                                                                    <h5>$63.54</h5>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="assets/images/profile/2.jpg"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p>Product Name</p>
                                                                    <h5>Slim Fit Plastic Coat</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Quantity</p>
                                                                    <h5>5</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Price</p>
                                                                    <h5>$63.54</h5>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="assets/images/profile/3.jpg"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p>Product Name</p>
                                                                    <h5>Men's Sweatshirt</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Quantity</p>
                                                                    <h5>1</h5>
                                                                </td>
                                                                <td>
                                                                    <p>Price</p>
                                                                    <h5>$63.54</h5>
                                                                </td>
                                                            </tr>
                                                        </tbody>

                                                        <tfoot>
                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Subtotal :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>$55.00</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Shipping :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>$12.00</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h5>Tax(GST) :</h5>
                                                                </td>
                                                                <td>
                                                                    <h4>$10.00</h4>
                                                                </td>
                                                            </tr>

                                                            <tr class="table-order">
                                                                <td colspan="3">
                                                                    <h4 class="theme-color fw-bold">Total Price :</h4>
                                                                </td>
                                                                <td>
                                                                    <h4 class="theme-color fw-bold">$6935.00</h4>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="col-xl-4">
                                                <div class="order-success">
                                                    <div class="row g-4">
                                                        <h4>summery</h4>
                                                        <ul class="order-details">
                                                            <li>Order ID: 5563853658932</li>
                                                            <li>Order Date: October 22, 2018</li>
                                                            <li>Order Total: $907.28</li>
                                                        </ul>

                                                        <h4>shipping address</h4>
                                                        <ul class="order-details">
                                                            <li>Gerg Harvell</li>
                                                            <li>568, Suite Ave.</li>
                                                            <li>Austrlia, 235153 Contact No. 48465465465</li>
                                                        </ul>

                                                        <div class="payment-mode">
                                                            <h4>payment method</h4>
                                                            <p>Pay on Delivery (Cash/Card). Cash on delivery (COD)
                                                                available. Card/Net banking acceptance subject to device
                                                                availability.</p>
                                                        </div>

                                                        <div class="delivery-sec">
                                                            <h3>expected date of delivery: <span>october 22, 2018</span>
                                                            </h3>
                                                            <a href="order-tracking.html">track order</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- section end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tracking table end -->
            <!-- tracking section End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->

<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(70).height(70);
            };
            reader.readAsDataURL(input.files[0]); // Corrected method name
        }
    }
</script>
<script>
    document.getElementById('multiImg').addEventListener('change', function(event) {
        const preview = document.getElementById('preview_img');
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

</x-guest-layout>
