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
                                <a class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    type="button" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-dashboard')}}"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab" data-bs-toggle="pill"
                                    type="button" style="font-size: 12px; text-align: center;"><i
                                        data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail" data-bs-toggle="pill"
                                    type="button" style="font-size: 12px; text-align: center;"><i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab" data-bs-toggle="pill"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;"><i
                                        data-feather="map-pin"></i>Address</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab" data-bs-toggle="pill"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;"><i
                                        data-feather="credit-card"></i>Payment Method</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                    type="button" role="tab" style="font-size: 12px; text-align: center;"><i data-feather="user"></i>
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
                            <div class="tab-content" id="pills-tabContent">
                                        <!-- Order Details Section Start -->
                                        <div class="tab-pane fade" role="tabpanel">
                                            <div class="dashboard-order">
                                                <div class="order-contain">
                                                    <div class="order-box dashboard-bg-box">
                                                        <div class="order-container">
                                                            <div class="order-icon">
                                                                <i data-feather="box"></i>
                                                            </div>

                                                            <div class="order-detail">
                                                                <h4>Delivers <span>Pending</span></h4>
                                                                <h6 class="text-content">Gouda parmesan caerphilly mozzarella
                                                                    cottage cheese cauliflower cheese taleggio gouda.</h6>
                                                            </div>
                                                        </div>

                                                        <div class="product-order-detail">
                                                            <a href="product-left-thumbnail.html" class="order-image">
                                                                <img src="../assets/images/vegetable/product/1.png"
                                                                    class="blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="order-wrap">
                                                                <a href="product-left-thumbnail.html">
                                                                    <h3>Fantasy Crunchy Choco Chip Cookies</h3>
                                                                </a>
                                                                <p class="text-content">Cheddar dolcelatte gouda. Macaroni cheese
                                                                    cheese strings feta halloumi cottage cheese jarlsberg cheese
                                                                    triangles say cheese.</p>
                                                                <ul class="product-size">
                                                                    <li>
                                                                        <div class="size-box">
                                                                            <h6 class="text-content">Price : </h6>
                                                                            <h5>$20.68</h5>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="size-box">
                                                                            <h6 class="text-content">Rate : </h6>
                                                                            <div class="product-rating ms-2">
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
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="size-box">
                                                                            <h6 class="text-content">Sold By : </h6>
                                                                            <h5>Fresho</h5>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="size-box">
                                                                            <h6 class="text-content">Quantity : </h6>
                                                                            <h5>250 G</h5>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Order Details Section End -->
                            
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
