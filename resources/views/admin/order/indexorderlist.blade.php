<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<x-auth-layout>
    <style>
        .disabled-blue {
        color: #0b6d59 !important;
        }
    
        .break-line {
        width: 200px;
        word-wrap: break-word;
        white-space: normal;
        }
    </style>
<!-- Section start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('components.messagebox')
            <div class="col-sm-12">
                <div class="card card-table">
                    <!-- Table Start -->
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Order List</h5>
                        </div>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-home"
                                    type="button">List</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-profile"
                                    type="button">Cancelled Order</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table all-package order-table theme-table dataTable no-footer"
                                        id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Order Code</th>
                                                <th>Delivery Status</th>
                                                <th>Amount</th>
                                                <th>Payment</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($order->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                            @foreach($order as $key => $item)
                                                <tr>
                                                    <td>{{ ($ttl+1) - ($order->firstItem() + $key) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                    <td>{{ $item->order->order_code }}</td>
                                                    <td class="@if($item->status == 'Pending') status-danger @elseif(!empty($item->delivered_date)) order-success @else order-pending @endif">
                                                        <span>{{ $item->status }}</span>
                                                    </td>
                                                    <td>¥{{ number_format($item->amount) }}</td>
                                                    @if ($item->order->payment_approved == 1)
                                                        <td>{{ $item->order->payment_type }}</td>
                                                    @else
                                                        <td>
                                                            <button class="btn btn-sm add-button w-50" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#paymentReceived{{ $item->order->id }}"
                                                                    onclick="showDeleteModal('{{ $item->order->id }}')" style="background-color: #ff6b6b;margin-left: 35px;">Cash
                                                            </button>
                                                        </td>
                                                        <!-- Received Payment Modal Start -->
                                                        <div class="modal fade theme-modal remove-profile" id="paymentReceived{{ $item->order->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-block text-center">
                                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Confirm Payment Received</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    @php
                                                                    $bankInfo = DB::table('cash_bank_accounts')->leftjoin('bank_accounts', 'cash_bank_accounts.bank_account_id', 'bank_accounts.id')
                                                                                ->where('order_id',$item->order->id)->first();
                                                                    @endphp
                                                                    <div class="modal-body">
                                                                        <div class="remove-box">
                                                                            <p>Do you have received payment for this order?</p>
                                                                            <p>Check at your <span style="color:#ff6b6b;">{{ $bankInfo->bank_name }}</span> account 
                                                                                with account number <span style="color:#ff6b6b;">({{ $bankInfo->account_number}})</span></p>
                                                                            <p>Transfer person is <span style="color:#ff6b6b;">{{ $bankInfo->transfer_person_name }}</span></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('cash_payment_received', ['id' => $item->order->id]) }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-animation theme-bg-color btn-md fw-bold text-light">Yes</button>
                                                                        </form>
                                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Received Payment Modal End -->
                                                    @endif
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('orderdetail',['id' => $item->order_id]) }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#order-details{{ $item->id }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                            {{-- <li>
                                                                <a href="{{ route('invoice',$item->id) }}"
                                                                   @if($item->status === 'Cancel')
                                                                       onclick="return false;"
                                                                   @endif>
                                                                    <i class="icon-cloud-down"></i>
                                                                </a>
                                                            </li> --}}

                                                            {{-- <li>
                                                                <a class="btn btn-sm btn-solid text-white"
                                                                    href="{{ route('ordertracking', $item->order_id)}}"
                                                                    @if($item->status === 'Cancel')
                                                                       onclick="return false;"
                                                                    @endif>
                                                                    Tracking
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table all-package order-table theme-table dataTable no-footer"
                                        id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Order Code</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($cancelledOrder->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                            @foreach($cancelledOrder as $key => $item)
                                                <tr>
                                                    <td>{{ ($cancelttl+1) - ($cancelledOrder->firstItem() + $key) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                    <td>{{ $item->order->order_code }}</td>
                                                    <td><a href="{{ route('detailproduct',$item->product->id) }}">{{ $item->product->product_code }}</a> </td>
                                                    <td>
                                                        <div class="break-line">
                                                            <h6>
                                                                {!! $item->product_name !!}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>¥{{ number_format($item->amount) }}</td>
                                                    <td>{{ $item->cancelled_reason }}</td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table End -->
                </div>
            </div>
        <!--pagination -->
        @include('components.pagination')
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Section End -->

<!-- Offcanvas Box Start -->
@foreach( $order as $key => $item )
    <div class="offcanvas offcanvas-end order-offcanvas" tabindex="-1" id="order-details{{ $item->id }}"
        aria-labelledby="offcanvasExampleLabel" aria-hidden="false">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">Order Code: {{ $item->order->order_code }}</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="order-date">
                <span>Ordered Date: {{ $item->created_at }}</span>
            </div>

            <div class="accordion accordion-flush custome-accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Status
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="{{ route('order.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                @if($item->status === 'Pending')
                                    <h6>Choose which date will be delivered this order</h6>
                                    <p>Between :</p>
                                    <input type="date" name="expected_from" class="form-control">
                                    @error('expected_from')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <p>and :</p>
                                    <input type="date" name="expected_to" class="form-control mb-3 ">
                                    @error('expected_to')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Confirmed">Confirmed</button>
                                @elseif ($item->status === 'Confirmed')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Processing">Processing</button>
                                @elseif ($item->status === 'Processing')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Picked">Pick up</button>
                                @elseif ($item->status === 'Picked')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Shipped">Shipping</button>
                                @elseif ($item->status === 'Shipped')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Delivered">Delivered</button>
                                @endif
                            </form>

                            @if($item->status === 'Pending')
                                <form action="{{ route('order.cancel') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-outline-primary w-100 {{ $item->status === 'Cancel' || $item->status === 'Delivered' ? 'disabled-blue' : '' }}" name="status" value="Cancel" {{ $item->status === 'Cancel' || $item->status === 'Delivered' ? 'disabled' : '' }}>Order Cancel</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Offcanvas Box End -->

<!-- Modal Start -->
@foreach( $order as $key => $item )
    <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Order Cancellation</h5>
                    <p>Type the reason why cancellation this order:</p>
                    @if(isset($item->id))
                        <form action="{{ route('order.cancel')}}" method="POST">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @csrf
                            <textarea class="form-control" name="comment" rows="6"></textarea>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="button-box">
                                <button type="button" class="btn btn--no" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn--yes btn-primary">OK</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal End -->

<script>
$(document).ready(function() {
    $('.status-link').click(function(event) {
        event.preventDefault();

        var orderId = $(this).data('id');
        var status = $(this).data('status');

        $.ajax({
            url: "{{ route('order.status') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                id: orderId,
                confirmed: status
            },
            success: function(response) {
                console.log(response.success);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('a.disabled').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
});
</script>

</x-auth-layout>
