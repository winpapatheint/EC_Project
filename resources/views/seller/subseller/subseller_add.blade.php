@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
<!-- New Subseller Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Subseller Information</h5>
                                </div>

                                <form method="POST" action="{{ route('store.subseller') }}" class="theme-form theme-form-2 mega-form" >
                                    @csrf
                                    <input type="hidden" name="seller_id" value="{{ Auth::user()->id }}">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirmed" class="form-control" value="{{ old('confirmed') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Phone
                                            Number</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Subseller Add End -->
</div>
@endsection
