<x-auth-layout>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- bootstrap  css -->
    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <!-- All User Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>All Category</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{ route('admin.all.addcategory') }}"
                                            class="align-items-center btn btn-theme d-flex">
                                            <i data-feather="plus-square"></i>Add New
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
                                                    <th>Date</th>
                                                    <th>Category Name</th>
                                                    <th>Icon</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach( $lists as $key => $list )
                                            <tr>
                                              <th data-label="登録日" >{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                              <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                              <td data-label="タイトル">{{ $list->category_name }}</td>
                                              <td data-label="{{ __('auth.image') }}"><img src="{{ asset('images/'.($list->category_icon)   ) }}" alt="thumb" style="width: 200px;"></td>
                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/editcategory/".$list->id ) }}'>
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>



                                                    <li>
                                                        <a class="" href="" role="button" data-toggle="modal"  data-target="#deleteConfirmModal{{ $list->id }}">
                                                             <i class="ri-delete-bin-line"></i></a>
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
                    <div style="bottom:28px">
                        <nav class="custom-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    @foreach( $lists as $key => $list )
                    <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                       <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title" id="deleteConfirmModalLabel">新着情報を削除</h4>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             </button>
                          </div>
                          <div class="modal-body">
                             <p>削除しますか？</p>
                          </div>
                          <div class="modal-footer">
                           <form method="POST" action="{{ route('deletecategory') }}" >
                             @csrf
                             <input type="hidden" name="id" value="{{ $list->id }}">
                             <button type="submit" class="btn btn-danger">削除する</button>
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                           </form>
                          </div>
                       </div>
                       </div>
                    </div>
                    @endforeach
                </div>

            </div>
        <!-- All User Table Ends-->

    </div>

</x-auth-layout>
