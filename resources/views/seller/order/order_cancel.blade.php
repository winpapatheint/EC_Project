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
                                <h5>Order Code:{{ $order->order_code }}</h5>
                            </div>
                            {{-- <div class="card-order-section">
                                <ul>
                                    <li>Order ID:{{ $order->id }}</li>
                                </ul>
                            </div> --}}
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
                                                <tr class="table-order">
                                                    <td>
                                                        <a href="javascript:void(0)">
                                                            <img src="assets/images/profile/1.jpg"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <p>Product Name</p>
                                                        <h5>{{ $order['product']['product_name'] }}</h5>
                                                    </td>
                                                    <td>
                                                        <p>Quantity</p>
                                                        <h5>{{ $order->qty }}</h5>
                                                    </td>
                                                    <td>
                                                        <p>Price</p>
                                                        <h5>¥{{number_format($order['product']['selling_price']) }}</h5>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Subtotal :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{number_format($price = $order['product']['selling_price'] * $order->qty) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Shipping :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>{{number_format($deli = $order['product']['delivery_price']) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Commission</h5>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $com = $order['product']['commission'] }}%</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h4 class="theme-color fw-bold">Total Price :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">¥{{number_format($total = ($price - ($price * ($com / 100)))+ $deli) }}</h4>
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
                                                <h4>Reason for order cancellation:</h4>
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
