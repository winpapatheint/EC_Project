
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

                                <form method="POST" action="{{ route('adduser') }}" class="row g-4" >
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" name="name" id="fullname" placeholder="Type your name" value="{{ old('name') }}" required>
                                            <label for="fullname">Name</label>
                                            <span style="color:red">@error('name'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email') }}" required>
                                            <label for="email">Email Address</label>
                                            <span style="color:red">@error('email'){{ $message }} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{ old('password') }}" required>
                                            <label for="password">Password</label>
                                            <span style="color:red">@error('password'){{$message}} @enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                                            <label>Confirm Password</label>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Email Address" required>
                                            <span style="color:red">@error('birthday'){{ $message }} @enderror</span>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}" required>
                                            <label for="phone">Phone</label>
                                            <span style="color:red">@error('phone'){{$message}} @enderror</span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <select class="form-control" name="prefecture">
                                                <option>Choose Prefecture</option>
                                                @foreach ($prefecture as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" max="7">
                                            <label>Zip Code</label>
                                            <span style="color:red">@error('zip_code'){{ $message }}@enderror</span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" name="city" class="form-control" placeholder="Narita-shi,Furugome" >
                                            <label>City, Ward, Town</label>
                                            <span style="color:red">@error('city'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" name="chome" class="form-control" placeholder="1-2-3" >
                                            <label>Chome, Banchi, Go</label>
                                            @error('chome')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" name="building" class="form-control" placeholder="Example Building" >
                                            <label>Building / Apt / Company name</label>
                                            @error('building')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" name="room" class="form-control" placeholder="101" >
                                            <label>Unit / Room no.</label>
                                            @error('room')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating theme-form-floating">
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ old('address') }}" required>
                                            <label for="address">Address</label>
                                            <span style="color:red">@error('address'){{$message}} @enderror</span>
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
