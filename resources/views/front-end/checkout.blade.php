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
                                                            <input type="hidden" name="buyer_id" value="{{ $buyeraddress->shop_name }}">
                                                            
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
                    $totalAmount = 0;
                    $totalAmount1 = 0;
                @endphp
                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Order Summery</h3>
                            </div>
                            @foreach($cartLists as $cartlist)
                            <ul class="summery-contain">
                                <input type="hidden" name="product_id" value="{{ $cartlist->product_id }}">
                                <input type="hidden" name="product_id" value="{{ $cartlist->seller_id }}">
                                <input type="hidden" name="product_id" value="{{ $cartlist->product_color }}">
                                <input type="hidden" name="product_id" value="{{ $cartlist->product_size }}">
                                <li>
                                    <img src="../assets/images/vegetable/product/1.png"
                                        class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                    <h4>{{ $cartlist->product_name }} <span>X {{ $cartlist->quantity }}</span></h4>
                                    @if($cartlist->discount_percent)
                                            @php
                                                $discountedPrice = $discountedPrices[$cartlist->id]['discounted_price'];
                                                $quantity = $cartlist->quantity;
                                                $totalAmount = $discountedPrice * $quantity;
                                            @endphp
                                            <h4 class="price">¥ {{ $totalAmount }} </h4>
                                        @else
                                            @php
                                                $sellingPrice = $cartlist->selling_price;
                                                $quantity = $cartlist->quantity;
                                                $totalAmount1 = $sellingPrice * $quantity;
                                            @endphp
                                            <h4 class="price">¥ {{ $totalAmount1 }} </h4>
                                        @endif
                                </li>
                            </ul>
                            @endforeach
                            <ul class="summery-total">
                                <li>
                                    @php
                                        $subTotal = $totalAmount + $totalAmount1
                                    @endphp
                                    <h4>Subtotal</h4>
                                    <h4 class="price">¥ {{ $subTotal }} </h4>
                                </li>

                                <li>
                                    <h4>Shipping</h4>
                                    <h4 class="price">¥ 500</h4>
                                </li>

                                <li>
                                @php 
                                    $discountPrice  =  $subTotal * ($discount / 100);
                                @endphp
                                    <h4>Coupon/Code</h4>
                                    <h4 class="price">¥ - {{ $discountPrice }}</h4>
                                </li>
                                @php 
                                    $total  =  $subTotal + 500 + $discountPrice
                                @endphp

                                <li class="list-total">
                                    <h4>Total (JPY)</h4>
                                    <h4 class="price">¥ {{ $total }}</h4>
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
            layout: 'vertical', // Set the button layout (horizontal or vertical)
            color: 'blue', // Set the button color (blue, gold, silver, black, white)
            shape: 'rect', // Set the button shape (rect, pill)
            label: 'pay', // Set the button label (checkout, pay, buy, donate)
            height: 50 // Set the button height (in pixels)
            },

            createOrder: function(data, actions) {
            // Set up the transaction details
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{ $total }}' // Sample amount
                    }
                }]
            });
            },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
          
              if (details.status == 'COMPLETED') {

                var Newproductid = <?php echo json_encode($cartlist->product_id ); ?>; 
                var Newbuyerid = <?php echo json_encode($buyeraddress->userid); ?>; 
                var Newsellerid = <?php echo json_encode($cartlist->seller_id); ?>; 
                var Newtotalamount = <?php echo json_encode($total ); ?>; 
                var Newcolor = <?php echo json_encode($cartlist->product_color ); ?>; 
                var Newsize = <?php echo json_encode($cartlist->product_size); ?>; 
                var Newqty = <?php echo json_encode($cartlist->quantity); ?>;
                var Newpostcode = <?php echo json_encode($buyeraddress->post_code); ?>;
                var Newcity = <?php echo json_encode($buyeraddress->city); ?>;
                var Newchome = <?php echo json_encode($buyeraddress->chome); ?>;
                var Newbuilding = <?php echo json_encode($buyeraddress->building); ?>;
                var Newroom = <?php echo json_encode($buyeraddress->room_no); ?>;
  
                $.ajax({
                    
                        url: "/payment/complete",
                        type:'POST',
                        
                        data: {
                            _token: '{{ csrf_token() }}',
                            productid: Newproductid,
                            buyerid: Newbuyerid,
                            sellerid: Newsellerid,
                            totalamount: Newbuyerid,
                            Newcolor: Newcolor,
                            Newsize: Newsize,
                            Newpostcode: Newpostcode,
                            Newcity: Newcity,
                            Newchome: Newchome,
                            Newbuilding: Newbuilding,
                            Newroom: Newroom,
                          
                    },

                    success: function(response) {
                     alert(JSON.stringify(response.success));
                        if ($.isEmptyObject(response.error)) {
                            console.log(response.success);
                            if (response.success) {
                             alert(JSON.stringify(response.success));
                                // If the payment is successful, you can pass a success message to the callback
                                //callback("支払いが正常に完了されました。");
                                callback("1");
                            }
                            } else {
                                    alert(JSON.stringify(response.error));
                                    callback("0");
                                    console.log(response.error);
                                
                                    callback("支払いが失敗しました。");
                            }
                        },

                        fail: function(data) {

                            alert(JSON.stringify(response.error));
                            alert("支払いが失敗しました。");
                        }
                    });

       
                // $.ajax({
                //         url: '/payment/complete',
                //         method: 'POST',
                //         data: {
                //             _token: '{{ csrf_token() }}',
                //             addressId: '{{ $buyeraddress->id }}',
                //             productid: '{{ $cartlist->product_id }}',
                //             buyerid: '{{ $buyeraddress->userid }}',
                //             sellerid: '{{ $cartlist->seller_id }}',
                //             totalamount: '{{ $total }}',
                //             color: '{{ $cartlist->product_color }}',
                //             size: '{{ $cartlist->product_size }}',
                //             qty: '{{ $cartlist->quantity }}',
                //             postcode: '{{ $buyeraddress->post_code }}',
                //             city: '{{ $buyeraddress->city }}',
                //             chome: '{{ $buyeraddress->chome }}',
                //             building: '{{ $buyeraddress->building }}',
                //             room: '{{ $buyeraddress->room_no }}'
                //         },
                //         success: function(response) {
                        
                //             // Handle success response
                //             console.log('Payment data inserted successfully:', response);
                //             $('#paymentsuccessModal').modal('show');
                //         },
                //         error: function(xhr, status, error) {
                           
                //             // Handle error
                //             console.error('Error inserting payment data:', error);
                //             $('#paymentfailModal').modal('show');
                //         }
                //     });
              } else {
                  $('#paymentfailModal').modal('show');
              }
              // alert('Transaction co/mpleted by ' + details.payer.name.given_name);
            });
          },
          style: {
            layout:  'vertical',
            color:   'blue',
            shape:   'rect',
            label:   'paypal'
          }
        }).render('#paypal-button-container'); 
    </script>

</x-guest-layout>