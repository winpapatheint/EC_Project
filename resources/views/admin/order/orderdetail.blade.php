<x-auth-layout>
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
                                <h5>Order ID: {{ $order->id }}</h5>
                            </div>
                            {{-- <div class="card-order-section">
                                <ul>
                                    <li>{{ $order->created_at }}</li>
                                    <li>{{ $order->qty }}</li>
                                    <li>{{ $order->amount }}</li>
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
                                                        <h5>¥{{ $order['product']['selling_price'] }}</h5>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Subtotal :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ $price = $order['product']['selling_price'] * $order->qty }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="3">
                                                        <h5>Shipping :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>{{ $deli = $order['product']['delivery_price'] }}</h4>
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
                                                        <h4 class="theme-color fw-bold">¥{{ $total = ($price - ($price * ($com / 100)))+ $deli }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>summery</h4>
                                            <ul class="order-details">
                                                <li>Order ID: {{ $order->id }}</li>
                                                <li>Order Date: {{ $order->created_at }}</li>
                                                <li>Order Total: ¥{{ $total }}</li>
                                            </ul>

                                            <h4>shipping address</h4>
                                            <ul class="order-details">
                                                <li>{{ $order['prefecture']['name'] }}</li>
                                                <li>{{ $order->city }}{{ $order->chome }}</li>
                                                <li>{{ $order->building }} {{ $order->room }}</li>
                                            </ul>

                                            <div class="payment-mode">
                                                <h4>Payment method</h4>
                                                <p>{{$order->payment_method}}</p>
                                            </div>

                                            <div class="delivery-sec">
                                                <h3>Expected date of delivery: </h3>
                                                <span>{{ $order->expected_date }}</span>
                                                <a href="order-tracking.html">Track order</a>
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
</x-auth-layout>
