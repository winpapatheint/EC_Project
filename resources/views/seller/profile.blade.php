@extends('seller.seller_dashboard')
@section('seller')

<!-- Settings Section Start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Details Start -->
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Profile</h5>
                                </div>
                                <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <input type="hidden" name="old_img" value="{{ $user->user_photo }}">
                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Username</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" name="email" value="{{ $user->email }}" >
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="password" value="{{ $user->password}}">
                                                @error('password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="confirmed" value="{{ $user->password }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="form-label-title col-sm-2 mb-0">Photo</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" id="formFile" name="photo">
                                                <img src="{{ asset(!empty($user->user_photo)) ? url('upload/profile/'.$user->user_photo) : url('upload/profile/profile.jpg') }}" width="100">
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-block">
                                            <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimBox_{{ $user->id }}">Update Profile</button>

                                            <!-- Confirm Modal Box -->
                                            <div class="modal fade theme-modal remove-coupon" id="confrimBox_{{ $user->id }}" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-block text-center">
                                                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="remove-box">
                                                                <p>The data will be added permanently.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-animation btn-md fw-bold" >Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Confirm Modal Box End-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Shop Information</h5>
                                </div>
                                <form method="POST" action="{{ route('update.shop')}}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif
                                    <input type="hidden" name="old_img" value="{{ $data->shop_logo }}">
                                    <input type="hidden" name="seller_id" value="{{ $data->id }}">
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Shop Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="shop_name" value="{{ $data->shop_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Shop Logo</label>
                                            <div class="col-sm-10">
                                                @if(empty(Auth::user()->created_by))
                                                    <input class="form-control" type="file" name="shop_logo">
                                                @endif
                                                <img src="{{ asset('upload/shop/'.$data->shop_logo) }}" width="100">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Establilshed</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="date" name="shop_establish" value="{{ $data->shop_establish }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Phone
                                                Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="phone" value="{{ $data->phone }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Zip Code</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="zip_code" value="{{ $data->zip_code }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Prefecture</label>
                                            <div class="col-sm-10">
                                                <select class="js-example-basic-single w-100" name="category_id" @if(!empty(Auth::user()->created_by)) disabled @endif>
                                                    @foreach ($prefecture as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $data->prefecture_id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">City, Ward, Town</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="city" value="{{ $data->city }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Chome, Banchi, Go</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="chome" value="{{ $data->chome }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Building / Apt / Company name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="building" value="{{ $data->building }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Unit / Room no.</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="room" value="{{ $data->room }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">URL</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="url" value="{{ $data->url }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_name" value="{{ $data->bank_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account Type</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_type" value="{{ $data->bank_acc_type }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Branch</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_branch" value="{{ $data->bank_branch }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_name" value="{{ $data->bank_acc_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account No</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_no" value="{{ $data->bank_acc_no }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            </div>
                                        </div>

                                        @if(empty(Auth::user()->created_by))
                                            <div class="d-grid gap-2 d-md-block">
                                                <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimBox_{{ $data->id }}">Update Profile</button>

                                                <!-- Confirm Modal Box -->
                                                <div class="modal fade theme-modal remove-coupon" id="confrimBox_{{ $data->id }}" aria-hidden="true" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header d-block text-center">
                                                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="remove-box">
                                                                    <p>The data will be added permanently.</p>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-animation btn-md fw-bold" >Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Confirm Modal Box End-->
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Settings Section End -->
@endsection
