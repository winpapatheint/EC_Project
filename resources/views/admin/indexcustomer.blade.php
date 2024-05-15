
<x-auth-layout>
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
                                    <h5>All Customer</h5>
                                </div>

                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th >Image</th>
                                                    <th>Title</th>
                                                    <th style="min-width: 200px">Sub Title</th>
                                                    <th style="min-width: 300px">Content</th>
                                                    <th style="min-width: 200px">Name</th>
                                                    <th style="min-width: 200px">Position</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach( $lists as $key => $list )

                                            <tr>
                                              <th style="text-align:center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                              <td data-label="{{ __('auth.image') }}"><img src="{{ asset('images/'.($list->image)   ) }}" alt="thumb" style="width: 200px;"></td>
                                              <td data-label="タイトル">{{ $list->title }}</td>
                                              <td data-label="タイトル">{{ $list->subtitle }}</td>
                                              <td data-label="タイトル"> {!! strlen($list->content) > 50 ? substr($list->content, 0, 50) . '...' : $list->content !!}</td>
                                              <td data-label="タイトル">{{ $list->name }}</td>
                                              <td data-label="タイトル">{{ $list->position }}</td>

                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/editcustomer/".$list->id ) }}'>
                                                            <i class="ri-pencil-line"></i>
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
                    @include('components.pagination')
            </div>
        <!-- All User Table Ends-->

    </div>

</x-auth-layout>
