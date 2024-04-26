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
                        <h2>Addresses</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Addresses</li>
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
                                <a class="nav-link active" id="pills-address-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                        data-feather="map-pin"></i>Addresses</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                        data-feather="credit-card"></i>Payment Methods</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- User Dashboard Section End -->
                <!-- Address View Start -->
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
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Add New Address</button>
                                    </div>
                                    <div class="row g-sm-4 g-3">
                                        @foreach($data as $item)
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="selected_address" 
                                                            value="{{ $item->id }}" id="address_{{ $item->id }}">
                                                    </div>
                                                    </div>
                                                    <div class="col-md-10">    
                                                            <label>{{ $item->place }}</label>
                                                    </div>
                                                </div>
                                            <div class="table-responsive address-table">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name:</td>
                                                                <td>
                                                                    <p>{{ $item->name }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address:</td>
                                                                <td>
                                                                    <p>{{ $item->post_code }},{{ $item->city }}</p>
                                                                    <p>{{ $item->chome }},{{ $item->building }},{{ $item->room_no }}</p>
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
                                                    <button class="btn btn-sm add-button w-100 edit-address-btn"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editAddress{{ $item->id }}"
                                                            onclick="">
                                                            <i data-feather="edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm add-button w-100" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#removeProfile"
                                                            onclick="showDeleteModal('{{ $item->id }}')">
                                                        <i data-feather="trash-2"></i> Remove
                                                    </button>
                                                    <!-- <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#removeProfile"
                                                    onclick="showDeleteModal('{{ $item->id }}')">
                                                        <i data-feather="trash-2"></i> Remove
                                                    </button> -->

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
        </div>
    </section>
    <!-- User Dashboard Section End -->

    <!-- Add Address Modal Box Start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('add_newaddress') }}" class="row g-4" >
                @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            <label for="name">Name</label>
                            <span style="color:red">@error('Name'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code">
                            <label for="post_code">Post Code</label>
                            <span style="color:red">@error('post_code'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <select class="form-control" name="prefectures" value="{{ old('prefecture') }}">
                                <option>Choose Prefecture</option>
                                @foreach ($prefecture as $item)
                                    <option value="{{ $item->id }}" name="prefectures">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City, Ward, Town">
                            <label for="city">City</label>
                            <span style="color:red">@error('city'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="chome" name="chome" placeholder="Chome, Banchi, Go">
                            <label for="chome">Chome</label>
                            <span style="color:red">@error('chome'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="building" name="building" placeholder="Building, Apartment, Company Name">
                            <label for="building">Building</label>
                            @error('building')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Unit, Room No">
                            <label for="roomno">Room No</label>
                            @error('room')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="place" name="place" placeholder="Home, Office or Others">
                            <label for="place">Place</label>
                            <span style="color:red">@error('place'){{ $message }}@enderror</span>
                        </div>

                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                            <label for="phone">Enter Phone Number</label>
                            <span style="color:red">@error('phone'){{ $message }}@enderror</span>
                        </div>
                        @foreach ($data as $item)
                        <input type="hidden" name="buyer_id" value="{{ $item->userid }}">
                        @endforeach
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
    <!-- Add Address Modal Box End -->
    <!-- Edit Address Modal Box Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal" id="editAddress{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
               
                    <form method="post" action="{{ route('edit_address') }}" class="row g-4" >
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        
                        <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                value="{{ $item->name }}">
                                <label for="name">Name</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code" value="{{ $item->post_code }}">
                                <label for="post_code">Post Code</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <select class="form-control" name="prefectures" value="{{ old('prefecture') }}">
                                    <option>Choose Prefecture</option>
                                    @foreach ($prefecture as $item)
                                        <option value="{{ $item->id }}" name="prefectures">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City, Ward, Town" value="{{ $item->city }}">
                                <label for="city">City</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="chome" name="chome" placeholder="Chome, Banchi, Go" value="{{ $item->chome }}">
                                <label for="chome">Chome</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="building" name="building" placeholder="Building, Apartment, Company Name" value="{{ $item->building }}">
                                <label for="building">Building</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Unit, Room No" value="{{ $item->room_no }}">
                                <label for="roomno">Room No</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="place" name="place" placeholder="Home, Office or Others" value="{{ $item->place }}">
                                <label for="place">Place</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{ $item->phone }}">{{ $item->phone }}
                                <label for="phone">Enter Phone Number</label>
                            </div>
                            @foreach ($data as $item)
                            <input type="hidden" name="buyer_id" value="{{ $item->userid }}">
                            @endforeach
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
    <!-- Edit Address Modal Box End -->
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
                    <form action="{{ route('remove_address', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Remove Address Modal End -->
</x-guest-layout>
<!-- Edit Address Script-->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var addressData = JSON.parse($(this).data('address'));
        alert(addressData);
        $('#address_id').val(addressData.id);
        $('#name').val(addressData.name);
        $('#post_code').val(addressData.post_code);
        $('#prefectures').val(addressData.prefectures);
        $('#city').val(addressData.city);
        $('#chome').val(addressData.chome);
        $('#building').val(addressData.building);
        $('#roomno').val(addressData.roomno);
        $('#place').val(addressData.place);
        $('#phone').val(addressData.phone);
    });

    $('#saveChanges').on('click', function() {
        var addressId = $('#address_id').val();
        var newName = $('#name').val();
        var newPostCode = $('#post_code').val();
        var newPrefectures = $('#prefectures').val();
        var newCity = $('#city').val();
        var newChome = $('#chome').val();
        var newBuilding = $('#building').val();
        var newRoomNo = $('#roomno').val();
        var newPlace = $('#place').val();
        var newPhone = $('#phone').val();

        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_address") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: addressId,
                name: newName,
                post_code: newPostCode,
                prefectures: newPrefectures,
                city: newCity,
                chome: newChome,
                building: newBuilding,
                room_no: newRoomNo,
                place: newPlace,
                phone: newPhone
            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#editAddress').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<!-- Remove Address Script -->
<script>
    function showDeleteModal(id) {
        $('#removeProfile').modal('show');
        // Update the form action URL dynamically with the selected address id
        $('#deleteForm').attr('action', '/user/remove-address/' + id);
    }
</script>
