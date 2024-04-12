@extends('seller.seller_dashboard')
@section('seller')
 <!-- Order Tracking Seation starts-->
 <div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Order Tracking</h5>
                                </div>
                                <div class="row">
                                    <div class="col-12 overflow-hidden">
                                        <div class="order-left-image">
                                            <div class="tracking-product-image">
                                                <img src="{{ asset('upload/product_thambnail/'.$order->product-> product_thambnail) }}"
                                                    class="img-fluid w-100 blur-up lazyload" >
                                            </div>

                                            <div class="order-image-contain">
                                                <h4>{{ $order->product->product_name }}</h4>
                                                <div class="tracker-number">
                                                <p>Order Number : <span>{{ $order->id }}</span></p>
                                                    <p>Brand : <span>{{ $order->product->brand->brand_name }}</span></p>
                                                    <p>Order Placed : <span>{{ $order->created_at }}</span></p>
                                                </div>
                                                <h5>Your items is on the way. Tracking information will be
                                                    available within 24 hours.</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <ol class="progtrckr">
                                        <li class="{{ !empty($order->confirmed_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                            <h5>Order Confirmed</h5>
                                        </li>
                                        <li class="{{ !empty($order->processing_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                            <h5>Processing</h5>
                                        </li>
                                        <li class="{{ !empty($order->picked_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                            <h5>Pick-up</h5>
                                        </li>
                                        <li class="{{ !empty($order->shipped_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                            <h5>Shipped</h5>
                                        </li>
                                        <li class="{{ !empty($order->delivered_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                            <h5>Delivered</h5>
                                        </li>
                                    </ol>

                                    <div class="col-12 overflow-visible">
                                        <div class="tracker-table">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr class="table-head">
                                                            <th scope="col">No</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Name</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if ($process->isEmpty())
                                                            <tr>
                                                                <td colspan="4" style="text-align: center">No data available</td>
                                                            </tr>
                                                        @else
                                                        @foreach ($process as $key => $item)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $item->created_at }}</td>
                                                                @if (!empty($item->confirmed_date))
                                                                    <td><p class="fw-bold">Confirmed</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @elseif (!empty($item->processing_date))
                                                                    <td><p class="fw-bold">Processing</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @elseif (!empty($item->picked_date))
                                                                    <td><p class="fw-bold">Picked</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @elseif (!empty($item->shipped_date))
                                                                    <td><p class="fw-bold">Shipped</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @elseif (!empty($item->delivered_date))
                                                                    <td><p class="fw-bold">Delivered</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @else
                                                                    <td><p class="fw-bold">Cancelled</p></td>
                                                                    <td><p class="fw-bold">{{ $item->order->updated_by }}</p></td>
                                                                @endif
                                                                <!-- Display other columns as needed -->
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
                            <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                                <a href="{{ route('invoice',$order->id) }}">
                                    <button class="btn btn-primary me-3">Invoice</button>
                                </a>
                                <a href="{{ route('all.order') }}">
                                    <button class="btn btn-outline">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Order Tracking Seation End-->
@endsection
