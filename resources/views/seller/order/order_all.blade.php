@extends('seller.seller_dashboard')
@section('seller')
<!-- Order section Start -->
<div class="page-body">
    <!-- Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Order List</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Order Image</th>
                                            <th>Order ID</th>
                                            <th>Payment Method</th>
                                            <th>Delivery Status</th>
                                            <th>Amount</th>
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
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <a class="d-block">
                                                        <span class="order-image">
                                                            <img width="100" src="{{ asset('upload/product_thambnail/'.$item-> product_thambnail) }}">
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->payment_type }}</td>
                                                <td class="@if($item->status == 'pending') status-danger @elseif(!empty($item->delivered_date)) order-success @else order-pending @endif">
                                                    <span>{{ $item->status }}</span>
                                                </td>
                                                <td>{{ $item->amount }}</td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('detail.order',$item->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#order-details{{ $item->id }}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="{{ route('invoice',$item->id) }}" >
                                                                <i class="icon-cloud-down"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a class="btn btn-sm btn-solid text-white"
                                                                href="{{ route('order.tracking',$item->id) }}">
                                                                Tracking
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $order->links() }}
        </div>
    </div>
    <!-- Table End -->
<!-- Order section End -->

<!-- Offcanvas Box Start -->
@foreach( $order as $key => $item )
    <div class="offcanvas offcanvas-end order-offcanvas" tabindex="-1" id="order-details{{ $item->id }}"
        aria-labelledby="offcanvasExampleLabel" aria-hidden="false">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">Order ID: {{ $item->id }}</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="order-date">
                <span>Ordered Date: {{ $item->created_at }}</span>
                <form action="{{ route('order.cancel') }}" method="GET">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-light">Cancel Order</button>
                </form>
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
                                @if($item->status === 'pending')
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
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="confirmed">Confirmed</button>
                                @elseif ($item->status === 'Confirmed')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="processing">Processing</button>
                                @elseif ($item->status === 'Processing')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="picked">Pick up</button>
                                @elseif ($item->status === 'Picked')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="shipped">Shipping</button>
                                @elseif ($item->status === 'Shipped')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="delivered">Delivered</button>
                                @endif
                                <button type="submit" class="btn btn-outline-primary w-100" name="status" value="cancel">Order Cancel</button>
                            </form>
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

@endsection
