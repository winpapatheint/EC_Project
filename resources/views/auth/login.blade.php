<x-guest-layout>


    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Log In</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Log In</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    @php $subtitle=__('auth.userlogin'); @endphp

    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">

          <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                <div class="image-contain">
                    <img src="{{ asset('frontend/assets/images/inner-page/log-in.png') }}" class="img-fluid" alt="">
                </div>
            </div>

            <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                <div class="log-in-box">
                    <div class="log-in-title">
                        <h3>Welcome To Fastkart</h3>
                        <h4>Log In Your Account</h4>
                    </div>
                      @php $error = $errors->toArray(); @endphp
                      <div class="input-box">
                <form id="contact-form" class="contact-form" method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="error-container"></div>
                            <div class="row g-4">
                                <div class="col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="email"><b>{{ __('auth.mailaddress') }}</b></label>
                                        <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                            type="text" value="{{ old('email') }}" autofocus>
                                            @if (!empty($error['inflhide']))
                                                @foreach ($error['inflhide'] as  $key => $value)
                                                    <p class="inflhide error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @elseif (!empty($error['email']))
                                                @foreach ($error['email'] as  $key => $value)
                                                    <p class="email error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                    </div>
                                </div>

                                <div class="col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="pwd"><b>{{ __('auth.password') }}</b></label>
                                        <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" name="password" id="password"
                                            type="password" autocomplete="current-password">
                                            @if (!empty($error['password']))
                                                @foreach ($error['password'] as  $key => $value)
                                                    <p class="password error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                        </div>
                                       <a href="{{ route('password.request') }}"><i class="fa fa-key"></i>Forgot Password?</a>
                                    </div>
                                </div>

                            <div class="text-center">
                                <button class="btn btn-animation w-100 justify-content-center" type="submit">Log
                                In</button>
                            </div>
                        </div>
                    </div>
                </form><!-- Contact form end -->
             </div>
          </div>
       </div>
       <div class="speaker-shap">
          <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
       </div>
    </section>
</x-guest-layout>

