@extends('seller.seller_dashboard')
@section('seller')
<!-- Page Sidebar Start -->
<div class="page-body">
    <!-- New User start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                        <form method="POST" action="{{ route('seller.help.add') }}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" >
                                            @csrf
                                            <div class="card-header-1">
                                                <h5>Order ID: {{ $helps->id }}</h5>
                                            </div>

                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="form-label-title col-lg-2 col-md-3 mb-0">Title</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <p>{{ $helps->title }}</p>
                                                    </div>
                                                </div>

                                                @if (!empty($helps->img))
                                                    <div class="mb-4 row align-items-center">
                                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                                                        <div class="col-md-9 col-lg-10">
                                                            <img width="200" src="{{ asset('upload/shop/'.$helps->img) }}">
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">Message
                                                        </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <p>{{ $helps->reason }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-block"  style="margin-top: 20px;">
                                                <a href="{{ route('seller.help.add') }}">
                                                    <button class="btn btn-animation" type="submit">Reply</button>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User End -->
</div>
<!-- Page Sidebar End -->
@endsection
