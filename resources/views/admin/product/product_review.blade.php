<x-auth-layout>

    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>
<!-- product review section start -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>Product Reviews</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                                <th>Published</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )
                                            <tr>
                                                <td data-label="登録日" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                                <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>Outwear & Coats</td>
                                                @if ($list->stars_rated == NULL)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                No Rating
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 1)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 2)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 3)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 4)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @else
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @endif
                                                <td>{{ $list->comment }}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input data-width="80" data-id="{{$list->id}}" class="toggle-review" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle" data-on="Active" data-off="InActive"  {{ $list->status =='1' ? 'checked' : '' }}>
                                                    </label>
                                                </td>

                                                    @if ($list->status == 1)
                                                        <td class="td-check">
                                                            <i class="ri-checkbox-circle-line"></i>
                                                        </td>
                                                    @else
                                                        <td class="td-cross">
                                                            <i class="ri-close-circle-line"></i>
                                                        </td>
                                                    @endif
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
    <!-- product review section End -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.toggle-review').change(function() {
                var status = $(this).prop('checked') ? 1 : 0;
                var review_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: '{{ route('statusreview') }}',
                    data: {
                        'status': status,
                        'review_id': review_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
        });
        </script>
</x-auth-layout>
