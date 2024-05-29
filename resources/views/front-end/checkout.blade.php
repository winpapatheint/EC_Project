<x-guest-layout>
<script src="https://www.paypal.com/sdk/js?client-id=AWssbr_5JCWSdK6IogXTxXSw8cVBeb_7gdVCtEue95EqSGYXuATz1fYcAduzXdf8e0k3713fP3tmuW7o&currency=JPY"> // Replace YOUR_CLIENT_ID with your sandbox client ID
      </script>
    <!-- Breadcrumb Section Start -->

    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Delivery Address</h4>
                                        </div>
                                        @if($buyerAddress->count() > 0)
                                        @foreach($buyerAddress as $index => $buyeraddress)
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="jack"
                                                                    id="flexRadioDefault2" {{ $buyeraddress->default == 1 ? 'checked' : '' }}>
                                                            </div>
                                                            <input type="hidden" id="buyeraddress_id" name="buyeraddress_id" value="{{ $buyeraddress->id }}">
                                                            <input type="hidden" name="buyer_id" value="{{ $buyeraddress->userid }}">

                                                            <div class="label">
                                                                <label>{{ $buyeraddress->place }}</label>
                                                            </div>

                                                            <ul class="delivery-address-detail">
                                                                <li>
                                                                    <h4 class="fw-500">{{ $buyeraddress->name }}</h4>
                                                                </li>

                                                                <li>
                                                                    <p class="text-content">{{ $buyeraddress->post_code }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->prefecture->name }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->city }} {{ $buyeraddress->chome }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->building }} {{ $buyeraddress->room_no }}</p>

                                                                </li>

                                                                <li>
                                                                    <h6 class="text-content mb-0"><span
                                                                            class="text-title">Phone
                                                                            :</span>{{ $buyeraddress->phone }}</h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </li>

                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Payment Option</h4>
                                        </div>

                                        <div class="row" style="margin-bottom: 50px;" id="paypaldiv">
                                            <div class="col-lg-8 mx-auto">
                                                <div class="text-center">
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @php
                    $amount = 0;
                    $amount1 = 0;
                    $total = 0;
                    $subTotal = 0;
                    $totalqty = 0;
                    $productIds = [];
                    $sellerIds = [];
                    $productColors = [];
                    $productSizes = [];
                    $productQuantities = [];
                    $buyerId = $buyerAddress[0]->buyer_id;
                    $buyerAddressIdFirst = $buyerAddress[0]->id;
                @endphp
                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Order Summery</h3>
                            </div>
                            @foreach($cartLists as $cartlist)

                            <ul class="summery-contain">
                                @php
                                    $productIds[] = $cartlist->product_id;
                                    $sellerIds[] = $cartlist->seller_id;
                                    $productColors[] = $cartlist->product_color;
                                    $productSizes[] = $cartlist->product_size;
                                    $productQuantities[] = $cartlist->quantity;
                                    $productAmounts[] = $cartlist->selling_price * $cartlist->quantity;
                                @endphp

                                <li>
                                <img src="{{ asset('upload/product_thambnail/'.$cartlist-> product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="" style="width: 50px; height: 50px;">
                                    <h4>{{ $cartlist->product_name }} <span>X {{ $cartlist->quantity }}</span></h4>
                                            @php
                                                $sellingPrice = $cartlist->selling_price;
                                                $quantity = $cartlist->quantity;
                                                $amount1 = $sellingPrice * $quantity;
                                                $subTotal += $amount1;
                                                $totalqty += $quantity
                                            @endphp
                                            <h4 class="price" style="color: black;">¥{{ number_format($amount1 , 0, '.', ',') }}</h4>
                                </li>
                            </ul>
                            <input type="hidden" name="totalqty" value="{{ $totalqty }}">

                            @endforeach
                            <ul class="summery-total">
                                <li>

                                    <h4>Subtotal</h4>
                                    <h4 class="price">¥ {{ number_format($subTotal , 0, '.', ',') }}</h4>

                                </li>

                                <li>
                                    <h4>Shipping</h4>
                                    <h4 class="price">¥ {{ number_format($shippingFee , 0, '.', ',') }}</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-)¥ {{ number_format($couponDiscount , 0, '.', ',') }}</h4>
                                </li>

                                <li class="list-total">
                                    <h4>Total (JPY)</h4>
                                    <h4 class="price">¥ {{ number_format($total1 , 0, '.', ',') }}</h4>
                                </li>
                            </ul>
                        
                            
                        </div>


                        <!-- Place Order button (initially hidden) -->
                        <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" id="placeOrderButton" style="display: none;">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->
<script type="text/javascript">
    var Newbuyeraddressid = <?php echo json_encode($buyerAddressIdFirst ); ?>; 
    document.querySelectorAll('input[name="jack"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.checked) {
                // Get the value of buyeraddress_id using id attribute
                Newbuyeraddressid = this.closest('.checkout-detail').querySelector('input[name="buyeraddress_id"]').value;console.log(Newbuyeraddressid);
            }
        });
    });
paypal.Buttons({

    style: {
        layout: 'vertical',
        color: 'blue',
        shape: 'rect',
        label: 'paypal',
        height: 50
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '{{ $total1 }}'
                    
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            if (details.status == 'COMPLETED') {

                purchasepaymentdone('{{ $total1 }}', function(result) {
                    if(result==1){ 
                      $('#paymentsuccessModal').modal('show');
                    }
                    else{
                      $('#paymentfailModal').modal('show');
                    }
                  });

        } else {
                $('#paymentfailModal').modal('show');
            }
        });
    }
}).render('#paypal-button-container');

function purchasepaymentdone(total1, callback) {console.log(Newbuyeraddressid);
    var Newproductid = <?php echo json_encode($productIds ); ?>; 
    var Newbuyerid = <?php echo json_encode($buyerId ); ?>; 
    var Newsellerid = <?php echo json_encode($sellerIds ); ?>; 
    var Newcolor = <?php echo json_encode($productColors ); ?>; 
    var Newsize = <?php echo json_encode($productSizes ); ?>; 
    var Newquantity = <?php echo json_encode($productQuantities ); ?>;
    var Newproductamount = <?php echo json_encode($productAmounts ); ?>;
    var Newtotalqty = <?php echo json_encode($totalqty ); ?>;
    var Newamount = <?php echo json_encode($amount ); ?>;
    var Newamount1 = <?php echo json_encode($amount1 ); ?>;
    var Newtotalamount = <?php echo json_encode($total1 ); ?>;
    var Newsubtotalamount = <?php echo json_encode($subTotal ); ?>;
    var Newshippingfee = <?php echo json_encode($shippingFee ); ?>;
    var Newcoupondiscount = <?php echo json_encode($couponDiscount ); ?>;
    var NewshopIds = <?php echo json_encode($shop ); ?>;
    var NewMaxDelis = <?php echo json_encode($maxDeli ); ?>;
    var NewCouponUsedSellerId = <?php echo json_encode($couponUsedSellerId ); ?>;
    var NewCouponUsedProductId = <?php echo json_encode($couponUsedProductId ); ?>;
    var NewCouponId = <?php echo json_encode($couponId ); ?>;

    $.ajax({
    url: '{{ route("payment_completed") }}',
    type: 'POST',
    data: {
        _token: '{{ csrf_token() }}',
        productid: Newproductid,
        buyerid: Newbuyerid,
        sellerid: Newsellerid,
        color: Newcolor,
        size: Newsize,
        quantity: Newquantity,
        productamount: Newproductamount,
        totalqty: Newtotalqty,
        amount: Newamount,
        amount1: Newamount1,
        totalamount: Newtotalamount,
        subtotalamount: Newsubtotalamount,
        shippingfee: Newshippingfee,
        coupondiscountamount: Newcoupondiscount,
        buyeraddressid : Newbuyeraddressid,
        shopIds : NewshopIds,
        maxDelis : NewMaxDelis,
        couponUsedSellerId : NewCouponUsedSellerId,
        couponUsedProductId : NewCouponUsedProductId,
        couponId : NewCouponId,
        payment: "PayPal"
    },
    async : false,
    success: function(response) {
        window.location.href = "{{ route('order_success', '') }}" + "/" + response.orderId;
    },
    error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        alert('Error - ' + errorMessage);
        // You can log the error to console for debugging purposes
        console.error('Error: ' + errorMessage + 'error:' + response);
    }
});
}
</script>
</x-guest-layout>
