<x-auth-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                <h5>Shop</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Shop Image</th>
                                                <th>Shop Name</th>
                                                <th>Shop establish</th>
                                                <th>Phone</th>
                                                <th>Coupon Code</th>
                                                <th>Status</th>
                                                <th>Coupon</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )

                                                <tr>
                                                    <th data-label="" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                                    <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                    <td data-label="{{ __('auth.image') }}"><img src="{{ asset('upload/shop/'.($list->shop_logo)   ) }}" alt="thumb" style="width: 200px;"></td>
                                                    <td data-label="">{{ $list->shop_name }}</td>
                                                    <td data-label="">{{ $list->shop_establish }}</td>
                                                    <td data-label="">{{ $list->phone }}</td>
                                                    <td data-label="">{{ $list->coupon_code }}</td>
                                                    <td data-label=""><a class="btnlist btn-primary" href='{{ url("/coupon/".$list->coupon_id ) }}'>{{ $list->coupon_code }}</a></td>
                                                    <td class="col-sm-9">
                                                        <label class="switch">
                                                            <input data-width="100" data-id="{{$list->id}}" class="toggle-class" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive"  {{ $list->status ? 'checked' : '' }}>
                                                        </label>
                                                    </td>

                                                    <td class="col-sm-9">

                                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="toggle-class btn btn-animation" data-offstyle="outline-secondary"
                                                        data-bs-target="#couponModal{{ $list->id }}">
                                                        Coupon
                                                    </a>
                                                    </td>

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ url("/shop/".$list->id ) }}">
                                                                    <i class="ri-eye-line"></i>
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

    <!-- Modal -->
    @foreach( $lists as $key => $list )
        <div class="modal fade theme-modal remove-coupon" id="couponModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-block text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel22">Select Coupon</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- Add class "js-example-basic-single" to select element to initialize Select2 -->
                            <select class="form-control js-example-basic-single" id="coupon-select">
                                <option value="0">select Coupon List</option>
                                @foreach($coupons as $coupon)
                                    <option value="{{ $coupon->id }}">{{ $coupon->coupon_code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form id="coupon-form" method="POST" action="{{ route('updatecoupon') }}" style="display:flex;">
                            @csrf
                            <input type="hidden" id="coupon-id" name="couponid" value="">
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

   <!-- Modal -->
@foreach($lists as $key => $list)
<div class="modal fade" id="coupondetailModal{{ $list->coupon_id }}" tabindex="-1" role="dialog" aria-labelledby="coupondetailModalLabel{{ $list->coupon_id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coupondetailModalLabel{{ $list->coupon_id }}">Coupon Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> {{ $list->name }}</p>
                <p><strong>Coupon Code:</strong> {{ $list->coupon_code }}</p>
                <p><strong>Discount Amount:</strong> {{ $list->discount_amount }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach
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
                                <form method="POST" action="{{ route('deleteproduct') }}" style="display:flex;">
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(function() {
                $('.toggle-class').change(function() {

                    var status = $(this).prop('checked') ? 1 : 0;

                    var shop_id = $(this).data('id');

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('shopstatus') }}",
                        data: {
                            'status': status,
                            'shop_id': shop_id,
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            alert('2');
                            console.log(data.success);
                        }
                    });
                });
            });
            </script>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
                $(document).ready(function() {
                    // When the value of the select box changes
                    $('#coupon-select').change(function() {
                        // Get the selected value from the select box
                        var selectedValue = $(this).val();

                        // Set the selected value into the hidden input field
                        $('#coupon-id').val(selectedValue);
                    });
                });
            </script>

</x-auth-layout>
