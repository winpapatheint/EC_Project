
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
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="log-in-box center">
                            <div class="log-in-title">
                                <h3>Create Account</h3>
                            </div>

                                @if(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success')}}
                                    </div>
                                @endif

                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail')}}
                                    </div>
                                @endif

                                <form method="post" action="{{ route('adduser') }}" class="row g-4" >
                                @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fullname">Name</label>
                                            <input type="text" class="form-control" name="name" id="fullname" placeholder="Type your name" value="{{ old('name') }}">
                                            <span style="color:red">@error('name'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}">
                                            <span style="color:red">@error('email'){{ $message }} @enderror</span>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                                            <span style="color:red">@error('password'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="role" value="buyer">

                                    <div class="col-md-12">
                                        <button class="btn btn-animation theme-bg-color w-100" type="submit">Sign Up</button>
                                    </div>
                                </form>
                        

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
