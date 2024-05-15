@extends('seller.seller_dashboard')
@section('seller')
@if (session('flash_message'))
<div class="flash_message bg-gradient-success text-center py-3 my-0">
    {{ session('flash_message') }}
</div>
@endif
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
                                        <div class="card-header-1">
                                            <h5>{{ $help->subject }}</h5>
                                        </div>

                                        <div class="row">
                                            <div class="row align-items-center">
                                                <label
                                                    class="col-lg-2 col-md-3 col-form-label form-label-title">Me
                                                    </label>
                                                <div class="col-md-9 col-lg-10">
                                                    <p>{{ $help->body }}</p>
                                                </div>
                                            </div>

                                            @if (!empty($help->img))
                                                <div class="mb-4 row align-items-center">
                                                    <label class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <img width="100" src="{{ asset('upload/shop/'.$helps->img) }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <form method="POST" action="{{ route('reply.sent') }}" class="theme-form theme-form-2 mega-form" >
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $help->id}}">
                                            <input type="hidden" name="subject" value="{{ $help->subject}}">
                                            <div class="row">
                                                <div class="card-header-1">
                                                    <h5>Reply</h5>
                                                </div>
                                                <div class="mb-2 row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" type="file" name="image" onchange="mainThamUrl(this)">
                                                        <img src="" id="mainThmb">
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">Body
                                                        </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <textarea class="form-control" name="body" id="" rows="5"></textarea>
                                                        <p style="display:none" class="body error text-danger"></p>
                                                        @if (!empty($error['body']))
                                                            @foreach ($error['body'] as  $key => $value)
                                                                <p class="body error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-block"  style="margin-top: 20px;">
                                                <a href="#">
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

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
