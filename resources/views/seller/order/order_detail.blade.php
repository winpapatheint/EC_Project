@extends('seller.seller_dashboard')
@section('seller')

<!-- tracking section start -->
<div class="page-body">
    <!-- tracking table start -->
    @if($orderDetails->isNotEmpty())
        @php
            $orders = $orderDetails->first();
            $totalCommission = 0;
            $subTotalAmount = 0;
            $deliveryPrice =0;
            foreach ($orderDetails as $order) {
                if ($order->used_delivery_price == 1) {
                    $deliveryPrice = $order->delivery_price;
                }
            }
        @endphp
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order Code: {{ $orders->order_code }}</h5>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">

                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Items</th>
                                                    <th class="text-end" colspan="3"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-order">
                                                    <td></td>
                                                    <td><h5>Product Name</h5></td>
                                                    <td><h5>Quantity</h5></td>
                                                    <td><h5>Price(tax inc)</h5></td>
                                                    <td><h5>Commission</h5></td>
                                                    <td><h5>Option</h5></td>
                                                </tr>
                                                @foreach($orderDetails as $index => $order)
                                                    <tr class="table-order">
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <img width="80" src="{{ asset('upload/product_thambnail/'.$order->product-> product_thambnail) }}">
                                                            </a>
                                                        </td>

                                                        @php
                                                            $comment = $order->product_name;
                                                            $words = explode(' ', $comment);
                                                            $lines = array_chunk($words,13);
                                                        @endphp

                                                        <td style="width: 100%;">
                                                            <h6>
                                                                @foreach ($lines as $line)
                                                                {{ implode(' ', $line) }}<br>
                                                            @endforeach
                                                            </h6>
                                                        </td>

                                                        <td>
                                                            <h6>{{ $order->qty }}</h6>
                                                        </td>

                                                        <td>
                                                            <h6>¥{{ number_format($order->amount) }}</h6>
                                                        </td>

                                                        <td>
                                                            <h6>{{ $order->commission }}%</h6>
                                                        </td>

                                                        <td>
                                                            <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimModal">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $totalCommission += $order->commission_amount;
                                                        $subTotalAmount += $order->amount;
                                                    @endphp
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="5">
                                                        <h5>Subtotal(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($subTotalAmount) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="5">
                                                        <h5>Shipping(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($deliveryPrice) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="5">
                                                        <h5>Commission(tax inc):</h5>
                                                    </td>
                                                    <td>
                                                        <h4>- ¥{{ number_format($totalCommission) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="5">
                                                        <h4 class="theme-color fw-bold">Total Price(tax inc) :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">¥{{ number_format($subTotalAmount-$totalCommission) }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                </div>

                                <div class="container">
                                    <div class="order-success">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4>Summary</h4>
                                                <ul class="order-details">
                                                    <li>Order Code: {{ $orders->order_code }}</li>
                                                    <li>Order Date: {{ \Carbon\Carbon::parse($orders->order_created_at)->format('Y/m/d H:i') }}</li>
                                                    <li>Order Total: ¥{{ number_format($subTotalAmount-$totalCommission) }}</li>
                                                </ul>
                                            </div>

                                            <div class="col-md-4">
                                                <h4>Shipping Address</h4>
                                                <ul class="order-details">
                                                    <li>{{ $order->order_details_name }}</li><br>
                                                    <li>〒{{ $order->post_code }}</li><br>
                                                    <li>{{ $order->prefecture->name }}, {{ $order->city }}</li>
                                                    <li>{{ $order->chome }}, {{ $order->building }} {{ $order->room_no }}</li>
                                                    <li>{{ $order->order_details_phone }}</li>
                                                </ul>
                                            </div>

                                            <div class="col-md-4">
                                                <h4>Expected date of delivery</h4>
                                                <ul class="order-details">
                                                    <li>{{ \Carbon\Carbon::parse($order->expected_from)->format('Y/m/d') }} - {{ \Carbon\Carbon::parse($order->expected_to)->format('Y/m/d') }}</li><br>
                                                    <li><a href="{{ route('order.tracking', $order->id) }}">Track order</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- section end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tracking table end -->
</div>
<!-- tracking section End -->
@endsection
