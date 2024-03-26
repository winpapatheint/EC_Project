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
                                    <h3>{{ $user->name }}</h3>
                                    <h6 class="text-content">{{ $user->email }}</h6>
                                </div>
                            </div>
                            
                        </div>
                        <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-dashboard-tab"
                                    type="button" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-dashboard')}}">
                                    <i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab" 
                                    style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-order')}}"><i
                                        data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail" 
                                    type="button" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-delivery')}}">
                                    <i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-address-tab"
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
                                    type="button" role="tab" style="font-size: 12px; text-align: center;" href="{{route ('front-end.user-profile')}}">
                                    <i data-feather="user"></i>
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
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="../assets/svg/leaf.svg#leaf"></use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Add New Address</button>
                                    </div>   
                                </div>   
                            </div>

                        <div class="row g-sm-4 g-3">
                            @foreach($data as $item)
                            <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                <div class="address-box">
                                        <div class="form-check">
                                       
                                                <input class="form-check-input" type="radio" name="selected_address" 
                                                value="{{ $item->id }}" id="address_{{ $item->id }}">
                                        </div>

                                        <div class="table-responsive address-table">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">{{ $item->name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Address:</td>
                                                        <td>
                                                            <p>{{ $item->address }}</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td>{{ $item->phone }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                  

                                    <div class="button-group">
                                            <button class="btn btn-sm add-button edit-btn w-100" data-bs-toggle="modal" 
                                            data-bs-target="#editModal{{ $item->id }}" ><i data-feather="edit"></i>Edit</button>

                                        <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#removeProfile" 
                                        onclick="showDeleteModal('{{ $item->id }}')">
                                            <i data-feather="trash-2"></i> Remove
                                        </button>

                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
                <!-- Address View End -->
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->


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

                    <form method="post" action="{{ route('updateUserInfo') }}" class="row g-4" >
                    @csrf
                        <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                <label for="name">Name</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="division" name="division" placeholder="Division">
                                <label for="division">Division</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="district" name="district" placeholder="District">
                                <label for="district">District</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code">
                                <label for="post_code">Post Code</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <textarea class="form-control" placeholder="Leave a comment here" id="address" name="address"
                                    style="height: 100px"></textarea>
                                <label for="address">Enter Address</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="place" name="place" placeholder="Home, Office or Others">
                                <label for="place">Place</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                                <label for="phone">Enter Phone Number</label>
                            </div>
                            <input type="hidden" name="buyer_id" value="1">
                        </div>
                   
                        <div class="modal-footer">
                            <button type="close" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                                changes</button>
                        </div>
                    </form> 
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->


    <!-- Edit Address Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal" id="editModal{{ $item->id }}" >
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                    <form method="post" action="{{ route('updateAddress') }}" class="row g-4" >
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $item->name }}">
                                <label for="name">Name</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="division" name="division" placeholder="Division" value="{{ $item->division }}">
                                <label for="division">Division</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="district" name="district" placeholder="District" value="{{ $item->district }}">
                                <label for="district">District</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="post_code" name="post_code" value="{{ $item->post_code }}">
                                <label for="post_code">Post Code</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <textarea class="form-control"  id="address" name="address"
                                    style="height: 100px" value="{{ $item->address }}"></textarea>
                                <label for="address">Enter Address</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="place" name="place" value="{{ $item->place }}">
                                <label for="place">Place</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input class="form-control" id="phone" name="phone" value="{{ $item->phone }}">
                                <label for="phone">Enter Phone Number</label>
                            </div>
                            <input type="hidden" name="buyer_id" value="1">
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
    @endforeach
    <!-- Edit Address End -->

    <!-- Remove Address Modal Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal remove-profile" id="removeProfile" tabindex="-1" aria-hidden="true">
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
                        <p>You cannot see this address nomore in your address book.</p>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('user-removeAddress', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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
    <!-- Remove Address Modal End -->
    
<!-- Delete -->
<script>
    function showDeleteModal(id) {
        $('#removeProfile').modal('show');
        // Update the form action URL dynamically with the selected address id
        $('#removeProfile form').attr('action', '/remove-address/' + id);
    }
</script>
<!-- Edit -->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var addressData = JSON.parse($(this).data('address'));
        $('#address_id').val(addressData.id);
        $('#edit_name').val(addressData.name);
        $('#edit_division').val(addressData.division);
        $('#edit_district').val(addressData.district); // Corrected field name
        $('#edit_post_code').val(addressData.post_code);
        $('#edit_address').val(addressData.address);
        $('#edit_place').val(addressData.place);
        $('#edit_phone').val(addressData.phone);
    });

    $('#saveChanges').on('click', function() {
        var addressId = $('#address_id').val();
        var newName = $('#edit_name').val();
        var newDivision = $('#edit_division').val();
        var newDistrict = $('#edit_district').val();
        var newPostCode = $('#edit_post_code').val();
        var newAddress = $('#edit_address').val();
        var newPlace = $('#edit_place').val();
        var newPhone = $('#edit_phone').val();

        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("updateAddress") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: addressId,
                name: newName,
                division: newDivision,
                district: newDistrict, // Corrected field name
                post_code: newPostCode,
                address: newAddress,
                place: newPlace,
                phone: newPhone
            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#editModal').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});

</script>

<script>
</script>
   <!-- latest jquery-->
   <script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- jquery ui-->
<script src="../assets/js/jquery-ui.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap-notify.min.js"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/feather/feather.min.js"></script>
<script src="../assets/js/feather/feather-icon.js"></script>

<!-- Lazyload Js -->
<script src="../assets/js/lazysizes.min.js"></script>

<!-- Slick js-->
<script src="../assets/js/slick/slick.js"></script>
<script src="../assets/js/slick/custom_slick.js"></script>

<!-- Quantity js -->
<script src="../assets/js/quantity-2.js"></script>

<!-- Nav & tab upside js -->
<script src="../assets/js/nav-tab.js"></script>

<!-- script js -->
<script src="../assets/js/script.js"></script>

<!-- theme setting js -->
<script src="../assets/js/theme-setting.js"></script>

</x-guest-layout>
