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
                            <form method="POST" action="{{ route('seller.register') }}" enctype="multipart/form-data" class="row g-4">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Type your shop name" required>
                                        <label>Shop Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="date" class="form-control" id="date" required>
                                        <label>Established Year</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="file" class="form-control" id="shop_logo" required>
                                        <label>Shop Logo</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" class="form-control" id="phone" placeholder="Phone" required>
                                        <label>Phone</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="zip" placeholder="Zip Code" required>
                                        <label>Zip Code</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="url" placeholder="Shop Link">
                                        <label>Shop Link</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="address" placeholder="Address" required>
                                        <label>Address</label>
                                    </div>
                                </div>

                                <h3>Bank Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="address" placeholder="Bank Name" required>
                                        <label>Bank Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="state">
                                            <option>普通</option>
                                            <option>当座</option>
                                            <option>貯蓄</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="branch" placeholder="Branch Name" required>
                                        <label>Branch Name</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="bank_acc_name" placeholder="Bank Account Name" required>
                                        <label>Bank Account Name</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" class="form-control" id="bank_acc" placeholder="Bank Account Number" required>
                                        <label>Bank Account Number</label>
                                    </div>
                                </div>

                                <h3>User Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" id="fullname" placeholder="Name" required>
                                        <label>Username</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Email Address" required>
                                        <label>Email Address</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                                        <label>Password</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" id="password" placeholder="Password" required>
                                        <label>Confirm Password</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" >I agree with <span>Terms</span> and <span>Privacy</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-animation theme-bg-color w-100" type="submit">Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="login.html">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</x-guest-layout>
