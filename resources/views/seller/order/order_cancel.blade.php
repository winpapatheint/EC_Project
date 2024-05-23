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
                        @if($orderDetails->isNotEmpty())
                            @php
                                $orders = $orderDetails->first();
                                $subTotalAmount = $orders->sub_total_amount;
                                $totalAmount = $orders->total_amount;
                                $couponDiscountAmount = $orders->coupon_discount_amout;
                                $shippingFee = $orders->shipping_fee;
                            @endphp
                        @endif
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order Code: {{ $orders->order_code }}</h5>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Items</th>
                                                    <th class="text-end" colspan="3"></th>
                                                </tr>
                                            </thead>

                                            @if($orderDetails->isNotEmpty())
                                                @php
                                                    $orders = $orderDetails->first();
                                                    $subTotalAmount = $orderDetails->sum('amount');
                                                @endphp
                                            @endif
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td><h5>Product Name</h5></td>
                                                    <td><h5>Quantity</h5></td>
                                                    <td><h5>Price(tax inc)</h5></td>
                                                    <td><h5>Commission</h5></td>
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
                                                            $lines = array_chunk($words,3);
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
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Subtotal(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($subTotalAmount) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Shipping(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($shippingFee) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Commission(tax inc):</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ $commission = $order['product']['commission'] }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h4 class="theme-color fw-bold">Total Price(tax inc) :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">¥{{ number_format($totalAmount) }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <form action="{{ route('order.cancel.reason') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $order->id }}">
                                                <div>
                                                    <h3>Order Cancellation</h3>
                                                </div>
                                                <h5>Reason for order cancellation:</h5>
                                                <textarea name="cancelled_reason" class="form-control mt-3" rows="10" placeholder="Type why cancellation of this order..."></textarea>
                                                <button type="submit" class="btn btn-animation w-100 mt-3">Submit</button>
                                            </form>
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
