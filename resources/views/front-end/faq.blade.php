
 <x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="faq-breadcrumb pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>FAQ</h2>
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
                                                <i class="fa-solid fa-angle-down"></i>
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

                <div class="col-xl-5">
                @php $error = $errors->toArray(); @endphp
                    <div class="faq-contain">
                    <div class="col-lg-10">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    <form class="register-form" method="POST" action="{{ route('contact') }}">
                    @csrf
                    <input type="hidden" name="from" value="faq">
                    <div class="right-sidebar-box">
                        <div class="row">
                            <div class="col-xxl-6 col-lg-12 col-sm-6">
                            <div class="single-input mb-30">
                                   <label for="usernameOne">名前</label>
                                   <input type="text" name="name" placeholder="名前" id="ts_contact_name">
                                   @if (!empty($error['name']))
                                         @foreach ($error['name'] as  $key => $value)
                                             <p class="error text-danger">{{ $value }}</p>
                                         @endforeach
                                   @endif
                               </div>
                                
                            </div>

                        </div>
                        <button class="btn btn-animation btn-md fw-bold ms-auto"  type="submit">Send Message</button>
                    </div>
</form>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    <!-- Faq Section End -->

</x-guest-layout>


