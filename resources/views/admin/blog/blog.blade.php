<x-auth-layout>

    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>News</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{ route('admin.addblog') }}"
                                            class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add New
                                        </a>
                                    </form>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>News Name</th>
                                                <th>Image</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )

                                                <tr>
                                                    <th data-label="登録日" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                                    <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                    <td data-label="タイトル">{{ $list->title }}</td>
                                                    <td data-label="{{ __('auth.image') }}"><img src="{{ asset('images/'.($list->image)   ) }}" alt="thumb" style="width: 200px;"></td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ url("/blog/".$list->id ) }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href='{{ url("/editblog/".$list->id ) }}'>
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--pagination -->
                    @include('components.pagination')

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
        <!-- Delete Modal Box Start -->
            @foreach( $lists as $key => $list )
                <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header d-block text-center">
                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <div class="remove-box">
                                    <p>The permission for the use/group, preview is inherited from the object, object will create a
                                        new permission for this object</p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <form method="POST" action="{{ route('deleteblog') }}" style="display:flex;">
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
                                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="remove-box text-center">
                                <div class="wrapper">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                    </svg>
                                </div>
                                <h4 class="text-content">It's Removed.</h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Delete Modal Box End -->
</x-auth-layout>
