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
                                        @foreach($buyerAddress as $buyeraddress)
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="jack"
                                                                    id="flexRadioDefault2" checked="checked">
                                                            </div>
                                                            <input type="hidden" name="buyeraddress_id" value="{{ $buyeraddress->id }}">
                                                            <input type="hidden" name="buyer_id" value="{{ $buyeraddress->userid }}">
                                                            <div class="label">
                                                                <label>{{ $buyeraddress->place }}</label>
                                                            </div>

                                                            <ul class="delivery-address-detail">
                                                                <li>
                                                                    <h4 class="fw-500">{{ $buyeraddress->name }}</h4>
                                                                </li>

                                                                <li>
                                                                    <p class="text-content"><span
                                                                            class="text-title">Address
                                                                            :</span>{{ $buyeraddress->post_code }}
                                                                    </p>
                                                                    <p class="text-content">{{ $buyeraddress->city }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->chome }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->building }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->room_no }}</p>

                                                                </li>

                                                                <li>
                                                                    <h6 class="text-content mb-0"><span
                                                                            class="text-title">Phone
                                                                            :</span> + 380 {{ $buyeraddress->phone }}</h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
                    
                    $subTotal = 0;
                    $totalqty = 0;
                    $productIds = [];
                    $sellerIds = [];
                    $productColors = [];
                    $productSizes = [];
                    $productQuantities = [];
                    $buyerId = $buyerAddress[0]->userid;
                    $buyerPostCode = $buyerAddress[0]->post_code;
                    $buyerCity = $buyerAddress[0]->city;
                    $buyerChome = $buyerAddress[0]->chome;
                    $buyerBuilding = $buyerAddress[0]->building;
                    $buyerRoomCode = $buyerAddress[0]->room_no;
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
                                @endphp

                                <li>
                                <img src="{{ asset('upload/product_thambnail/'.$cartlist-> product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="" style="width: 50px; height: 50px;">
                                    <h4>{{ $cartlist->product_name }} <span>X {{ $cartlist->quantity }}</span></h4>
                                    @if($cartlist->discount_percent)
                                            @php
                                                $discountedPrice = $discountedPrices[$cartlist->id]['discounted_price'];
                                                $quantity = $cartlist->quantity;
                                                $amount = $discountedPrice * $quantity;
                                                $subTotal += $amount; 
                                                $totalqty += $quantity
                                            @endphp
                                            <h4 class="price">¥ {{ number_format($amount , 0, '.', ',') }}</h4>
                                        @else
                                            @php
                                                $sellingPrice = $cartlist->selling_price;
                                                $quantity = $cartlist->quantity;
                                                $amount1 = $sellingPrice * $quantity;
                                                $subTotal += $amount1;
                                                $totalqty += $quantity
                                            @endphp
                                            <h4 class="price">¥ {{ number_format($amount1 , 0, '.', ',') }}</h4>
                                        @endif
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
                                    <h4 class="price">¥ 500</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">¥ - {{ number_format($couponDiscount , 0, '.', ',') }}</h4>
                                </li>
                                
                                <li class="list-total">
                                    <h4>Total (JPY)</h4>
                                    <h4 class="price">¥ {{ number_format($total , 0, '.', ',') }}</h4>
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
                    value: '{{ $total }}'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            if (details.status == 'COMPLETED') {

                purchasepaymentdone('{{ $total }}', function(result) {
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

function purchasepaymentdone(total, callback) {
    var Newproductid = <?php echo json_encode($productIds ); ?>; 
    var Newbuyerid = <?php echo json_encode($buyerId ); ?>; 
    var Newsellerid = <?php echo json_encode($sellerIds ); ?>; 
    var Newcolor = <?php echo json_encode($productColors ); ?>; 
    var Newsize = <?php echo json_encode($productSizes ); ?>; 
    var Newquantity = <?php echo json_encode($productQuantities ); ?>;
    var Newtotalqty = <?php echo json_encode($totalqty ); ?>;
    var Newamount = <?php echo json_encode($amount ); ?>;
    var Newamount1 = <?php echo json_encode($amount1 ); ?>;
    var Newtotalamount = <?php echo json_encode($total ); ?>;
    var Newbuyerpostcode = <?php echo json_encode($buyerPostCode ); ?>; 
    var Newbuyercity = <?php echo json_encode($buyerCity ); ?>; 
    var Newbuyerchome = <?php echo json_encode($buyerChome ); ?>; 
    var Newbuyerbuilding = <?php echo json_encode($buyerBuilding ); ?>; 
    var Newbuyerroomcode = <?php echo json_encode($buyerRoomCode ); ?>;

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
        totalqty: Newtotalqty,
        amount: Newamount,
        amount1: Newamount1,
        totalamount: Newtotalamount,
        postcode: Newbuyerpostcode,
        city: Newbuyercity,
        chome: Newbuyerchome,
        building: Newbuyerbuilding,
        room: Newbuyerroomcode,
        payment: "PayPal"
    },
    async : false,
    success: function(response) {
        alert(response.message);
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