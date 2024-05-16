@php $error = $errors->toArray();  @endphp
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
                                        <form method="POST" action="{{ route('help.store') }}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" >
                                            @csrf
                                            <div class="card-header-1">
                                                <h5>Contact Us</h5>
                                            </div>

                                            <div class="row">
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="form-label-title col-lg-2 col-md-3 mb-0">Subject</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <input class="form-control" type="text" name="subject">
                                                        <p style="display:none" class="subject error text-danger"></p>
                                                        @if (!empty($error['subject']))
                                                            @foreach ($error['subject'] as  $key => $value)
                                                                <p class="subject error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-4 row align-items-center">
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
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-animation" type="submit">Send</button>
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
