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
                        <h2>Profile</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Profile</li>
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
                                    <h3>{{ $user->name }}</h3>
                                    <h6 class="text-content">{{ $user->email }}</h6>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-dashboard-tab"
                                    type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_dashboard')}}"><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab" 
                                    style="font-size: 14px; text-align: center;" href="{{route ('user_order')}}"><i
                                        data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail" 
                                    type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_deivery_status')}}"><i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                        data-feather="map-pin"></i>Addresses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                        data-feather="credit-card"></i>Payment Methods</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- User Dashboard Section End -->

                <!-- Show Profile Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-profile">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Profile</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                        
                                    <div class="profile-detail dashboard-bg-box">
                                        <div class="profile-name-detail">
                                            <div class="d-sm-flex align-items-center d-block">
                                                <h3>{{ $user->name}}</h3>
                                            </div>

                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#editProfile">Edit</a>
                                        </div>
                                    </div>

                                    <div class="profile-about dashboard-bg-box">
                                        <div class="row">
                                            <div class="dashboard-title mb-3">
                                                <h3>Your Account</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Phone Number  :</td>
                                                            <td><a href="javascript:void(0)"> +91 {{ $user->phone }}</a></td>      
                                                        </tr>
                                                        <tr>
                                                            <td>Address  :</td>
                                                            <td>{{ $user->address }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="dashboard-title mb-3">
                                                <h3>Login Details</h3>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Email  :</td>
                                                            <td><a href="javascript:void(0)">{{ $user->email }}<span data-bs-toggle="modal"
                                                                        data-bs-target="#editProfile">Edit</span></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Password :</td>
                                                            <td>
                                                                <!-- <a href="javascript:void(0)">●●●●●●
                                                                    <span data-bs-toggle="modal"
                                                                        data-bs-target="#editProfile">Edit</span></a> -->

                                                                <a data-bs-toggle="modal"
                                                                href="javascript:void(0)">{{ $maskedPassword }}<span data-bs-toggle="modal"
                                                                        data-bs-target="#editPassword">Edit</span></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div>  
                    </div>  
                </div>
                <!-- User Profile View End -->
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
    <!-- Edit Profile Modal Box Start -->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                    <form method="post" action="{{ route('edit_profile') }}" class="row g-4" >
                    @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="buyer_id" value="{{ $buyer->id }}">
                        
                        <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                <label for="name">Name</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                <label for="email">Place</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ $user->address }}">
                                <label for="address">Enter Address</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{ $user->phone }}">
                                <label for="phone">Enter Phone Number</label>
                            </div>
                        </div>
                   
                        <div class="modal-footer">
                            <button type="close" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>

                            <button type="submit" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal" id="saveChanges">Save
                                changes</button>
                        </div>
                    </form> 
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal Box End -->

    <!-- Change Password Start -->
    <div class="modal fade theme-modal" id="editPassword" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Edit Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="post" action="{{ route('edit_password') }}" class="row g-4">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <input type="hidden" name="buyer_id" value="{{ $buyer->id }}">
    <div class="modal-body">
        <div class="row g-4">
            <div class="col-xxl-6">
                <div class="form-floating theme-form-floating">
                    <input type="text" class="form-control" id="email" value="{{ $user->email }}" disabled>
                    <label for="email">Email Address</label>
                </div>
            </div>

            <div class="col-xxl-6">
                <div class="form-floating theme-form-floating">
                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
                    <label for="oldpassword">Old Password</label>
                </div>
            </div>

            <div class="col-xxl-4">
                <div class="form-floating theme-form-floating">
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                    <label for="newpassword">New Password</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn theme-bg-color btn-md text-white edit-btn" id="changePassword">Save changes</button>
    </div>
</form>

            </div>
        </div>
    </div>
    <!-- Change Password End -->
</x-guest-layout>
<!-- Edit Profile Script-->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var profileData = JSON.parse($(this).data('profile'));
        $('#id').val(profileData.id);
        $('#name').val(profileData.name);
        $('#email').val(profileData.email);
        $('#password').val(profileData.password);
        $('#address').val(profileData.address);
        $('#phone').val(profileData.phone);
    });

    $('#editPassword').on('click', function() {
        var newId = $('#id').val();
        var newName = $('#name').val();
        var newEmail = $('#email').val();
        var newPassword = $('#password').val();
        var newAddress = $('#address').val();
        var newPhone = $('#phone').val();

        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_profile") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: newId,
                name: newName,
                email: newEmail,
                password: newPassword,
                address: newAddress,
                phone: newPhone,
            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#editPassword').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<!-- Edit Password Script -->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var passData = JSON.parse($(this).data('password'));
        $('#id').val(passData.id);
        $('#email').val(passData.email);
        $('#password').val(passData.password);

    });

    $('#changePassword').on('click', function() {
        var passId = $('#id').val();
        var newEmail = $('#email').val();
        var newPassword = $('#password').val();


        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_password") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: addressId,
                email: newEmail,
                password: newPassword,

            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#changePassword').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
