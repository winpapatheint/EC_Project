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
                                <h3>Create Account</h3>
                            </div>

                            <div class="input-box">
                                <form class="row g-4" action="{{route ('adduser')}}" method="POST">
                                @csrf
                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" id="fullname" placeholder="Type your shop name" required="">
                                            <label for="fullname">Name</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="email" class="form-control" id="email" placeholder="Email Address" required="">
                                            <label for="email">Email Address</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="password" placeholder="Password" required="">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" id="password" placeholder="Password">
                                            <label for="password">Confirm Password</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="forgot-box">
                                            <div class="form-check ps-0 m-0 remember-box">
                                                <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">I agree with <span>Terms</span> and <span>Privacy</span></label>
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
                                <a href="">Log In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>




</x-guest-layout>
