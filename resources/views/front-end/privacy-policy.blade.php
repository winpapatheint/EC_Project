
 <x-guest-layout>

    <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>Privacy Policy</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Privacy Policy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Breadcrumb Section End -->

    <!-- Faq Section Start -->
    <section class="contact-box-section faq-box-contain section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="faq-accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p></p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p style="color: #111111;">Asia Human Development, Inc.(hereinafter referred to as "our company") 
                                        recognizes the importance of protecting personal information, observes 
                                        relevant laws and norms, establishes the following personal information 
                                        protection policy, and strives for reliable implementation. increase.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p style="color: var(--theme-color);margin-left: 15px;">1. Collection, Use And Provision Of Personal Information</p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p>In consideration of the fact that we keep customer information in our business 
                                        activities, we have established a management system for personal information 
                                        protection according to the actual business situation of each business, and at the 
                                        same time, we have established a management system for personal information. We will 
                                        handle it properly in accordance with the prescribed rules in collection, use and 
                                        provision.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p style="color: var(--theme-color);margin-left: 15px;">2. Compliance With Laws And Norms</p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p>We will comply with the laws and regulations applicable to the protection of 
                                        personal information and other norms in the handling of personal information.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p style="color: var(--theme-color);margin-left: 15px;">3. Implementation Of Safety Measures</p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p>In order to ensure the accuracy and safety of personal information, we will 
                                        control access to personal information, limit the means of taking out personal 
                                        information, and unauthorized access from the outside, in accordance with various 
                                        rules regarding information security. We will take measures such as prevention of 
                                        personal information and strive to prevent loss, destruction, falsification, leakage, 
                                        etc. of personal information.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p style="color: var(--theme-color);margin-left: 15px;">4. Observance Of Personal Rights Regarding Personal Information</p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p>When the person in question regarding personal information requests disclosure, 
                                        correction or deletion, or refusal to use or provide personal information, we will 
                                        respect the person's rights regarding personal information and respond in good faith. 
                                        increase.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <p style="color: var(--theme-color);margin-left: 15px;">5. Formulation And Continuous Improvement Of Compliance Programs</p>
                                </h2>
                                <div class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <p>We have established and implemented a personal information protection compliance 
                                        program to make officers and employees aware of the importance of personal information
                                         protection, and to properly use and protect personal information. We will maintain 
                                         and make continuous improvements.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block" id="alert-success">
                                <!-- <button type="button" class="close" data-dismiss="alert">×</button>     -->
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @php $error = $errors->toArray(); @endphp
                    <div class="right-sidebar-box">
                        <form class="contact-form" method="POST" action="{{ route('contact') }}"  id="contact-form">
                            @csrf
                            <input type="hidden" name="from" value="privacy">
                            <div class="row">
                                <div class="col-xxl-12 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">First Name</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter First Name" name="name"  value="{{ old('name') }}">
                                            <i class="fa-solid fa-user"></i>

                                            @if (!empty($error['name']))
                                                @foreach ($error['name'] as  $key => $value)
                                                    <p class="error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">Email Address</label>
                                        <div class="custom-input">
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter Email Address" name="email"  value="{{ old('email') }}">
                                            <i class="fa-solid fa-envelope"></i>

                                            @if (!empty($error['email']))
                                                @foreach ($error['email'] as  $key => $value)
                                                    <p class="error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
                                        <div class="custom-input">
                                            <input type="tel" class="form-control" id="phone"
                                                placeholder="Enter Your Phone Number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                                this.value.slice(0, this.maxLength);" name="phone"  value="{{ old('phone') }}">
                                            <i class="fa-solid fa-mobile-screen-button"></i>

                                            @if (!empty($error['phone']))
                                                @foreach ($error['phone'] as  $key => $value)
                                                    <p class="error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Message</label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="message"
                                                placeholder="Enter Your Message" rows="6" name="message"  value="{{ old('message') }}">{{ old('message') }}</textarea>
                                            <i class="fa-solid fa-message"></i>

                                            @if (!empty($error['message']))
                                                @foreach ($error['message'] as  $key => $value)
                                                    <p class="error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <button class="btn btn-animation theme-bg-color ms-auto fw-bold"  type="submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    <!-- Faq Section End -->

</x-guest-layout>


