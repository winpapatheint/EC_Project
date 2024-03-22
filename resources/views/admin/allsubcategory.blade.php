
<x-auth-layout>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
                                                        <a href="" data-toggle="modal" data-target="#deleteConfirmModal{{ $list->id }}">
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

            @foreach( $lists as $key => $list )
            <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title" id="deleteConfirmModalLabel">{{ __('auth.newsdeleteconfirmtitle') }}</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <p>{{ __('auth.deleteaskconfirm') }}</p>
                  </div>
                  <div class="modal-footer">
                   <form method="POST" action="{{ route('deletecategory') }}" >
                     @csrf
                     <input type="hidden" name="id" value="{{ $list->id }}">
                     <button type="submit" class="btn btn-danger">{{ __('auth.dodelete') }}</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('auth.close') }}</button>
                   </form>
                  </div>
               </div>
               </div>
            </div>
            @endforeach
        <!-- All User Table Ends-->

    </div>

</x-auth-layout>
