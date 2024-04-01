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
                                    data-bs-target="#pills-dashboard" type="button" style="font-size: 12px; text-align: center;"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
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
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('showAddress')}}"><i
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

                <!-- Dashboard view Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>DashBoard</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello, <b class="text-title">Vicki E. Pope</b></h6>
                                        <p class="text-content">From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information.</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="../assets/images/svg/order.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="../assets/images/svg/order.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Order</h5>
                                                        <h3>3658</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="../assets/images/svg/pending.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="../assets/images/svg/pending.svg" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Pending Order</h5>
                                                        <h3>254</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="../assets/images/svg/wishlist.svg"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="../assets/images/svg/wishlist.svg"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Wishlist</h5>
                                                        <h3>32158</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dashboard-title">
                                        <h3>Account Information</h3>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-xxl-6">
                                            <div class="dashboard-content-title">
                                                <h4>Contact Information <a href="javascript:void(0)"
                                                        data-bs-toggle="modal" data-bs-target="#editProfile">Edit</a>
                                                </h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">MARK JECNO</h6>
                                                
                                                <h6 class="text-content">vicki.pope@gmail.com</h6>
                                                <a data-bs-toggle="modal" data-bs-target="#changePassword"
                                                        href="javascript:void(0)">Change Password</a>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6">
                                            <div class="dashboard-content-title">
                                                <h4>Newsletters <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</a></h4>
                                            </div>
                                            <div class="dashboard-detail">
                                                <h6 class="text-content">You are currently not subscribed to any
                                                    newsletter</h6>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="dashboard-content-title">
                                                <h4>Address Book <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</a></h4>
                                            </div>

                                            <div class="row g-4">
                                                <div class="col-xxl-6">
                                                    <div class="dashboard-detail">
                                                        <h6 class="text-content">Default Billing Address</h6>
                                                        <h6 class="text-content">You have not set a default billing
                                                            address.</h6>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#editProfile">Edit Address</a>
                                                    </div>
                                                </div>

                                                <div class="col-xxl-6">
                                                    <div class="dashboard-detail">
                                                        <h6 class="text-content">Default Shipping Address</h6>
                                                        <h6 class="text-content">You have not set a default shipping
                                                            address.</h6>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#editProfile">Edit Address</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard View End -->

                            

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
</x-guest-layout>

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Add address modal box start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="fname" placeholder="Enter First Name">
                            <label for="fname">First Name</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name">
                            <label for="lname">Last Name</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address">
                            <label for="email">Email Address</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="address"
                                style="height: 100px"></textarea>
                            <label for="address">Enter Address</label>
                        </div>
                    </form>

                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="pin" placeholder="Enter Pin Code">
                            <label for="pin">Pin Code</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->

    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Edit Profile Start -->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="pname" value="Jack Jennas">
                                    <label for="pname">Full Name</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="email" class="form-control" id="email1" value="vicki.pope@gmail.com">
                                    <label for="email1">Email Address</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input class="form-control" type="tel" value="4567891234" name="mobile" id="mobile"
                                        maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);">
                                    <label for="mobile">Phone No</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address1"
                                        value="8424 James Lane South San Francisco">
                                    <label for="address1">Add Address</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-12">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address2" value="CA 94080">
                                    <label for="address2">Add Address 2</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect1">
                                        <option selected>Choose Your Country</option>
                                        <option value="kingdom">United Kingdom</option>
                                        <option value="states">United States</option>
                                        <option value="fra">France</option>
                                        <option value="china">China</option>
                                        <option value="spain">Spain</option>
                                        <option value="italy">Italy</option>
                                        <option value="turkey">Turkey</option>
                                        <option value="germany">Germany</option>
                                        <option value="russian">Russian Federation</option>
                                        <option value="malay">Malaysia</option>
                                        <option value="mexico">Mexico</option>
                                        <option value="austria">Austria</option>
                                        <option value="hong">Hong Kong SAR, China</option>
                                        <option value="ukraine">Ukraine</option>
                                        <option value="thailand">Thailand</option>
                                        <option value="saudi">Saudi Arabia</option>
                                        <option value="canada">Canada</option>
                                        <option value="singa">Singapore</option>
                                    </select>
                                    <label for="floatingSelect">Country</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect">
                                        <option selected>Choose Your City</option>
                                        <option value="kingdom">India</option>
                                        <option value="states">Canada</option>
                                        <option value="fra">Dubai</option>
                                        <option value="china">Los Angeles</option>
                                        <option value="spain">Thailand</option>
                                    </select>
                                    <label for="floatingSelect">City</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address3" value="94080">
                                    <label for="address3">Pin Code</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" data-bs-dismiss="modal"
                        class="btn theme-bg-color btn-md fw-bold text-light">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile End -->

     <!-- Change Password Start -->
     <div class="modal fade theme-modal" id="changePassword" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="finame" value="markjohn@gmail.com">
                                    <label for="finame">Email Address</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="laname" value="********">
                                    <label for="laname">Old Password</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="laname" value="********">
                                    <label for="laname">New Password</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Update Password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password End -->

    <!-- Edit Card Start -->
    <div class="modal fade theme-modal" id="editCard" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Edit Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="finame" value="Mark">
                                    <label for="finame">First Name</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-6">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="laname" value="Jecno">
                                    <label for="laname">Last Name</label>
                                </div>
                            </form>
                        </div>

                        <div class="col-xxl-4">
                            <form>
                                <div class="form-floating theme-form-floating">
                                    <select class="form-select" id="floatingSelect12">
                                        <option selected>Card Type</option>
                                        <option value="kingdom">Visa Card</option>
                                        <option value="states">MasterCard Card</option>
                                        <option value="fra">RuPay Card</option>
                                        <option value="china">Contactless Card</option>
                                        <option value="spain">Maestro Card</option>
                                    </select>
                                    <label for="floatingSelect12">Card Type</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light">Update Card</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Card End -->

    <!-- Remove Profile Modal Start -->
    <div class="modal fade theme-modal remove-profile" id="removeProfile" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>The permission for the use/group, preview is inherited from the object, object will create a
                            new permission for this object</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                        data-bs-target="#removeAddress" data-bs-toggle="modal">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade theme-modal remove-profile" id="removeAddress" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box text-center">
                        <h4 class="text-content">It's Removed.</h4>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Remove Profile Modal End -->