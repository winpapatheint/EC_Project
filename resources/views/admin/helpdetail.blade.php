<x-auth-layout>
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
                                        <form method="GET" action="{{ route('help.add') }}" class="theme-form theme-form-2 mega-form" >
                                            @csrf
                                            <div class="card-header-1">
                                                <h5>Contact Detail</h5>
                                            </div>

                                            <div class="mb-4 row">
                                                <div class="mb-4 row align-items-center">
                                                    <label
                                                        class="form-label-title col-lg-2 col-md-3 mb-0">Subject</label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <p>{{ $start->subject }}</p>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <label
                                                        class="col-lg-2 col-md-3 col-form-label form-label-title">
                                                        @if ($start->help_id==null)
                                                            Content
                                                        @else
                                                            Reply Message
                                                        @endif
                                                    </label>
                                                    <div class="col-md-9 col-lg-10">
                                                        <p>{{ $start->body }}</p>
                                                    </div>
                                                    @if (!empty($start->img))
                                                    <div class="mb-4 row align-items-center image-container">
                                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">Images</label>
                                                        <div class="col-md-9 col-lg-10">
                                                            <img width="100" src="{{ asset('images/'.$start->img) }}">
                                                        </div>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>

                                            {{-- @if(isset($reply))
                                                @foreach ($reply as $item)
                                                <div class="mb-4 row">
                                                    @if (!empty($item->img))
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title"></label>
                                                            <div class="col-md-9 col-lg-10">
                                                                <img width="100" src="{{ asset('upload/shop/'.$item->img) }}">
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row align-items-center">
                                                        <label
                                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Me
                                                            </label>
                                                        <div class="col-md-9 col-lg-10">
                                                            <p>{{ $item->body }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
{{-- --}}

                                            {{-- <div class="d-grid gap-2 d-md-block"  style="margin-top: 20px;">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#replyModal">
                                                    <button class="btn btn-animation" type="submit">Reply</button>
                                                </a>
                                            </div> --}}
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

<!-- Reply Modal -->
@if(isset($reply))
    @foreach ($reply as $item)
    <div class="modal fade theme-modal remove-coupon" id="replyModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title" >Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('review.update')}}" method="POST">
                        <input type="hidden" name="review_id" value="{{ $item->id }}">
                        @csrf
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
                                <textarea class="form-control" name="body" id="" rows="8"></textarea>
                                <p style="display:none" class="body error text-danger"></p>
                                @if (!empty($error['body']))
                                    @foreach ($error['body'] as  $key => $value)
                                        <p class="body error text-danger">{{ $value }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('reply.sent') }}">
                        @csrf
                        <button type="submit" class="btn btn-animation">Reply</button>
                    </form>
                    <button type="button" class="btn btn-animation" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

<style>
    .image-container img {
        transition: transform 0.3s ease;
    }

    .image-container:hover img {
        transform: scale(1.5); /* Increase the size to 110% */
    }
</style>
<!-- Reply Modal End-->
</x-auth-layout>
