
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
                                        <a href="{{ url('/') }}">
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

    <!-- Faq Section Start -->
    <section class="faq-box-contain section-b-space">
        <div class="container">
            <div class="row">

                <div class="col-xl-7">
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


                <div class="col-xl-5 right-sidebar-box" id="ts-form">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" id="alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @php $error = $errors->toArray(); @endphp
                        <div class="right-sidebar-box">
                            <h3 class="title">お問い合わせ</h3>
                            <form class="contact-form" method="POST" action="{{ route('contact') }}"  id="ts-form">
                            @csrf
                                <input type="hidden" name="from" value="faq">
                                <div class="row">
                                    <div class="col-xxl-12 col-lg-12 col-sm-6">
                                        <div class="mb-md-4 mb-3 custom-form">
                                            <label for="exampleFormControlInput" class="form-label" >First Name</label>
                                                <div class="custom-input">
                                                    <input type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}"
                                                        placeholder="Enter First Name">
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
                                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" id="exampleFormControlInput2"
                                                        placeholder="Enter Email Address">
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
                                                    <input type="tel" id="tel" class="form-control" id="exampleFormControlInput3" name="phone" value="{{ old('phone') }}"
                                                        placeholder="Enter Your Phone Number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                                        this.value.slice(0, this.maxLength);">
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
                                                <textarea id="message" class="form-control" id="exampleFormControlTextarea" name="message" value="{{ old('message') }}"
                                                    placeholder="Enter Your Message" rows="6">{{ old('message') }}</textarea>
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
                                <button class="btn btn-animation btn-md fw-bold ms-auto" type="submit">Send Message</button>

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


