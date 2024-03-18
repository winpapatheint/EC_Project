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
                            <a class="nav-link" id="pills-dashboard-tab"
                                    type="button" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-dashboard')}}"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-order-tab" 
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
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-address')}}"><i
                                        data-feather="map-pin"></i>Address</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-payment')}}"><i
                                        data-feather="credit-card"></i>Payment Method</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-profile')}}"><i data-feather="user"></i>
                                    Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- User Dashboard Section End -->
               
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                        <div class="dashboard-right-sidebar">
                            <!-- <div class="tab-content" id="pills-tabContent"> -->
                                <!-- <div class="tab-pane fade show active" id="pills-order" role="tabpanel"> -->

                                        <!-- Order Tracking Section Start -->
                                        <section class="order-detail">
                                            <div class="container-fluid-lg">
                                                <div class="row g-sm-4 g-3">
                                                    <div class="col-xxl-3 col-xl-4 col-lg-6">
                                                        <div class="order-image">
                                                            <img src="../assets/images/vegetable/product/6.png" class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-9 col-xl-8 col-lg-6">
                                                        <div class="row g-sm-4 g-3">
                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i data-feather="package" class="text-content"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">Tracking Code</h5>
                                                                        <h2 class="theme-color">MH4285UY</h2>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i data-feather="truck" class="text-content"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">Service</h5>
                                                                        <img src="../assets/images/inner-page/brand-name.svg"
                                                                            class="img-fluid blur-up lazyload" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i class="text-content" data-feather="info"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">Package Info</h5>
                                                                        <h4>Letter</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i class="text-content" data-feather="crosshair"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">From</h5>
                                                                        <h4>STR. Smardan 9, Bucuresti, romania.</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i class="text-content" data-feather="map-pin"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">Destination</h5>
                                                                        <h4>Flokagata 24, 105 Reykjavik, Iceland</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-4 col-sm-6">
                                                                <div class="order-details-contain">
                                                                    <div class="order-tracking-icon">
                                                                        <i class="text-content" data-feather="calendar"></i>
                                                                    </div>

                                                                    <div class="order-details-name">
                                                                        <h5 class="text-content">Estimated Time</h5>
                                                                        <h4>7 Frb, 05:05pm</h4>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 overflow-hidden">
                                                                <ol class="progtrckr">
                                                                    <li class="progtrckr-done">
                                                                        <h5>Order Processing</h5>
                                                                        <h6>05:43 AM</h6>
                                                                    </li>
                                                                    <li class="progtrckr-done">
                                                                        <h5>Pre-Production</h5>
                                                                        <h6>01:21 PM</h6>
                                                                    </li>
                                                                    <li class="progtrckr-done">
                                                                        <h5>In Production</h5>
                                                                        <h6>Processing</h6>
                                                                    </li>
                                                                    <li class="progtrckr-todo">
                                                                        <h5>Shipped</h5>
                                                                        <h6>Pending</h6>
                                                                    </li>
                                                                    <li class="progtrckr-todo">
                                                                        <h5>Delivered</h5>
                                                                        <h6>Pending</h6>
                                                                    </li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                         <!-- Order Detail Section End -->

                                        <!-- Order Table Section Start -->
                                        <section class="order-table-section section-b-space">
                                            <div class="container-fluid-lg">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table order-tab-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Description</th>
                                                                        <th>Date</th>
                                                                        <th>Time</th>
                                                                        <th>Location</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Order Placed</td>
                                                                        <td>26 Sep 2021</td>
                                                                        <td>12:00 AM</td>
                                                                        <td>California</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Preparing to Ship</td>
                                                                        <td>03 Oct 2021</td>
                                                                        <td>12:00 AM</td>
                                                                        <td>Canada</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Shipped</td>
                                                                        <td>04 Oct 2021</td>
                                                                        <td>12:00 AM</td>
                                                                        <td>America</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Delivered</td>
                                                                        <td>10 Nav 2021</td>
                                                                        <td>12:00 AM</td>
                                                                        <td>Germany</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- Order Table Section End -->
                                        <!-- Order Tracking Section End -->
                                   
                            <!--  </div> -->
                        <!-- </div> -->
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
