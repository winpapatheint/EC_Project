

<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>FAQ</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">FAQ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Box Section Start -->
    <section class="contact-box-section faq-box-contain section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="faq-accordion">
                            <div class="accordion" id="accordionExample">
                                @foreach( $lists as $key => $list )
                                    @if ($loop->first)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                                    aria-expanded="true" aria-controls="collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                    {!! $list->que !!}
                                                    <i class="fa-solid fa-angle-down"></i>
                                                </button>
                                            </h2>
                                            <div  id="collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                                class="accordion-collapse collapse show"
                                                aria-labelledby="heading{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>{!! $list->ans !!}</p>

                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                                    aria-expanded="false" aria-controls="collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                    {!! $list->que !!}
                                                    <i class="fa-solid fa-angle-up"></i>
                                                </button>
                                            </h2>
                                            <div  id="collapse{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                                class="collapse"
                                                aria-labelledby="heading{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>{!! $list->ans !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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
                            <input type="hidden" name="from" value="faq">
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
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.5229059407397!2d139.7105441!3d35.7379503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601892a013f7dbb3%3A0x5366f1c6bc45f33f!2z44CSMTcxLTAwMTQgVG9reW8sIFRvc2hpbWEgQ2l0eSwgSWtlYnVrdXJvLCA0LWNoxY1tZeKIkjI34oiSNSDlkoznlLDjg5Pjg6s!5e0!3m2!1sen!2sjp!4v1713423525200!5m2!1sen!2sjp"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->

</x-guest-layout>








