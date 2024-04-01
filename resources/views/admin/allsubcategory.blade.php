
<x-auth-layout>

    <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
    <!-- bootstrap  css -->
    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <!-- All User Table Start -->
            <div class="container-fluid mt-5">
                <div class="row mt-5">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>All  SubCategory</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{ route('admin.all.addcategory') }}"
                                        class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Add Main Category
                                       </a>&nbsp;&nbsp;
                                       <a href="{{ route('admin.all.addsubtitle') }}"
                                       class="align-items-center btn btn-theme d-flex">
                                       <i data-feather="plus-square"></i>Add SubTitle Category
                                      </a>&nbsp;&nbsp;
                                        <a href="{{ route('admin.all.addsubcategory') }}"
                                            class="align-items-center btn btn-theme d-flex">
                                            <i data-feather="plus-square"></i>Add SubCategory
                                        </a>
                                    </form>
                                </div>
                                @include('components.messagebox')
                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Main Category Name</th>
                                                    <th>SubTitle Category Name</th>
                                                    <th>SubCategory Name</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach( $lists as $key => $list )

                                            <tr>
                                              <th data-label="登録日" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                              <td data-label="タイトル" style="font-size:14px;">{{ $list->category }}</td>
                                              <td data-label="タイトル" style="font-size:14px;">{{ $list->sub_category_titlename }}</td>
                                              <td data-label="タイトル" style="font-size:14px;">{{ $list->sub_category_name }}</td>

                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/editsubcategory/".$list->id ) }}'>
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        @if(empty($list->sub_category_name))
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>

                                                        @endif
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




                </div>

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
                <form method="POST" action="{{ route('deletecategory') }}" style="display:flex;">
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
        <!-- All User Table Ends-->

    </div>

</x-auth-layout>
