@extends('seller.seller_dashboard')
@section('seller')
<!-- tracking section start -->
<div class="page-body">
    <!-- tracking table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                {{-- <h5>Order ID: {{ $orderDetails->first()->order->order_code }}</h5> --}}
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Items</th>
                                                    <th class="text-end" colspan="2"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderDetails as $orderDetail)
                                                <tr class="table-order">
                                                    <td>
                                                        <a href="javascript:void(0)">
                                                            <img width="80" src="{{ asset('upload/product_thambnail/' . $orderDetail->product->product_thambnail) }}">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <p>Product Name</p>
                                                        <h5>{{ $orderDetail->product->product_name }}</h5>
                                                    </td>
                                                    <td>
                                                        <p>Quantity</p>
                                                        <h5>{{ $orderDetail->qty }}</h5>
                                                    </td>
                                                    <td>
                                                        <p>Price</p>
                                                        <h5>¥{{ number_format($orderDetail->product->selling_price) }}</h5>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                @php
                                                    $subtotal = $orderDetails->sum(function($orderDetail) {
                                                        return $orderDetail->product->selling_price * $orderDetail->qty;
                                                    });
                                                    $shipping = $orderDetails->first()->product->delivery_price;
                                                    $commission = $orderDetails->first()->product->commission;
                                                    $total = ($subtotal - ($subtotal * ($commission / 100))) + $shipping;
                                                @endphp
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Subtotal :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($subtotal) }}</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Shipping :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($shipping) }}</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Commission</h5>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $commission }}%</h4>
                                                    </td>
                                                </tr>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">¥{{ number_format($total) }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>Summary</h4>
                                            <ul class="order-details">
                                                <li>Order ID: {{ $orderDetails->first()->order->order_code }}</li>
                                                <li>Order Date: {{ \Carbon\Carbon::parse($orderDetails->first()->created_at)->format('Y/m/d H:i') }}</li>
                                                <li>Order Total: ¥{{ number_format($total) }}</li>
                                            </ul>

                                            <h4>Shipping Address</h4>
                                            <ul class="order-details">
                                                <li>{{ $orderDetails->first()->prefecture->name }}</li>
                                                <li>{{ $orderDetails->first()->city }}{{ $orderDetails->first()->chome }}</li>
                                                <li>{{ $orderDetails->first()->building }} {{ $orderDetails->first()->room }}</li>
                                            </ul>

                                            <div class="delivery-sec">
                                                <h3>Expected date of delivery:</h3>
                                                <span>{{ \Carbon\Carbon::parse($orderDetails->first()->expected_from)->format('Y/m/d') }} - {{ \Carbon\Carbon::parse($orderDetails->first()->expected_to)->format('Y/m/d') }}</span>
                                                <a href="{{ route('order.tracking', $orderDetails->first()->id) }}">Track order</a>
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
