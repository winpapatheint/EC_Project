<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Sign Up</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign Up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Shop Information</h3>
                        </div>

                        <div class="input-box">
                            <form method="POST" action="{{ route('seller.registered') }}" enctype="multipart/form-data" class="row g-4">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="shop_name" class="form-control" placeholder="Type your shop name" value=" {{ old('shop_name') }}">
                                        <label>Shop Name</label>
                                        @error('shop_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="date" name="shop_establish" class="form-control" value="{{ old('shop_establish') }}">
                                        <label>Established Year</label>
                                        @error('shop_establish')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="file" name="shop_logo" class="form-control" value="{{ old('shop_logo') }}">
                                        <label>Shop Logo</label>
                                        @error('shop_logo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="phone" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                                        <label>Phone</label>
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" name="zip_code" class="form-control" placeholder="Zip Code" max="7" value="{{ old('zip_code') }}">
                                        <label>Zip Code</label>
                                        @error('zip_code')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="url" class="form-control" placeholder="Shop Link" value="{{ old('url') }}">
                                        <label>Shop Link</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="prefecture" value="{{ old('prefecture') }}">
                                            <option>Choose Prefecture</option>
                                            @foreach ($prefecture as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="city" class="form-control" placeholder="Narita-shi,Furugome" value="{{ old('city') }}">
                                        <label>City, Ward, Town</label>
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="chome" class="form-control" placeholder="1-2-3" value="{{ old('chome') }}">
                                        <label>Chome, Banchi, Go</label>
                                        @error('chome')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="building" class="form-control" placeholder="Example Building" value="{{ old('building') }}">
                                        <label>Building / Apt / Company name</label>
                                        @error('building')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="room" class="form-control" placeholder="101" value="{{ old('room') }}">
                                        <label>Unit / Room no.</label>
                                        @error('room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <h3>Bank Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" value="{{ old('bank_name') }}">
                                        <label>Bank Name</label>
                                        @error('bank_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="bank_branch" class="form-control" placeholder="Branch Name" value="{{ old('bank_branch') }}">
                                        <label>Branch Name</label>
                                        @error('bank_branch')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="bank_acc_type" value="{{ old('bank_acc_type') }}">
                                            <option>Choose Bank Account Type</option>
                                            <option>普通</option>
                                            <option>当座</option>
                                            <option>貯蓄</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="bank_acc_name" class="form-control" placeholder="Bank Account Name" value="{{ old('bank_acc_name') }}">
                                        <label>Bank Account Name</label>
                                        @error('bank_acc_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="d" name="bank_acc_no" class="form-control" placeholder="Bank Account Number" value="{{ old('bank_acc_no') }}">
                                        <label>Bank Account Number</label>
                                        @error('bank_acc_no')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <h3>User Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                        <label>Username</label>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
                                        <label>Email Address</label>
                                        @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
                                        <label>Password</label>
                                        @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" name="confirmed" class="form-control" placeholder="Password" value="{{ old('confirmed') }}">
                                        <label>Confirm Password</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-animation theme-bg-color w-100" type="submit">Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="#">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
