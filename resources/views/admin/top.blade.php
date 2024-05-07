
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
                                    <h5>All Top</h5>
                                </div>

                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Discount</th>
                                                    <th style="min-width: 200px">PhaseOne</th>
                                                    <th style="min-width: 300px">PhaseTwo</th>
                                                    <th style="min-width: 200px">PhaseThree</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach( $lists as $key => $list )

                                            <tr>
                                              <th style="text-align:center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                              <td data-label="タイトル">{{ $list->discount }}</td>
                                              <td data-label="タイトル">{{ $list->phaseone }}</td>
                                              <td data-label="タイトル">{{ $list->phasetwo }}</td>
                                              <td data-label="タイトル">{{ $list->phasethree }}</td>

                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/edittop/".$list->id ) }}'>
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
