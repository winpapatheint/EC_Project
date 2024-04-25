<x-guest-layout>
!
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    @php
                        $totalAmount = 0;
                        $totalAmount1 = 0;
                        $subTotal = 0;
                        $total = 0;
                    @endphp
                    @foreach($cartLists as $cartlist)
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="{{ route('show-product-left-thumbnail', ['id' => $cartlist->product_id]) }}">
                                                    <img src="{{ asset('upload/product_thambnail/'.$cartlist-> product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="" style="width: 60px; height: 60px;">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a href=" {{ url('/product-left-thumbnail') }} ">{{ $cartlist->product_name }}</a>
                                                        </li>

                                                        <li class="text-content"><span class="text-title">Sold
                                                                By:</span>{{ $cartlist->shop_name }}
                                                        </li>

                                                        <li class="text-content"><span
                                                                class="text-title">Quantity</span>{{ $cartlist->product_name }}
                                                        </li>

                                                        <li class="text-content"><span
                                                                class="text-title">Color</span>{{ $cartlist->product_color }}
                                                        </li>
                                                        <li class="text-content"><span
                                                                class="text-title">Color</span>{{ $cartlist->product_size }}
                                                        </li>
                                                    
                                                        <li>

                                                            <h5 class="text-content d-inline-block">Price :</h5>
                                                            <span>{{ $cartlist->selling_price }}</span>
                                                            <span class="text-content"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        
                                        <td class="price">
                                            <h4 class="table-title text-content">Price</h4>
                                        @if($cartlist->discount_percent)
                                            <h5>¥ {{ number_format($discountedPrices[$cartlist->id]['discounted_price'], 0, '.', ',') }}<del class="text-content">¥ {{ number_format($cartlist->selling_price, 0, '.', ',') }}</del></h5>
                                            <h6 class="theme-color">You Save : ¥ {{ number_format($discountedPrices[$cartlist->id]['save_amount'], 0, '.', ',') }}</h6>  
                                        @else
                                            <h5>¥ {{ number_format($cartlist->selling_price, 0, '.', ',') }}</h5>
                                        @endif
                                        </td>
                      
                
                                        <td class="quantity">
                                            <h4 class="table-title text-content">Qty</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <form id="updateCartForm" method="POST" action="{{ route('update_cart_qty', $cartlist->cart_id, $cartlist->product_id) }}">
                                                        @csrf
                                                        <div class="input-group qty-box">
                                                            <button type="submit" class="btn qty-left-minus" data-type="minus" data-field="">
                                                                <i class="fa fa-minus ms-0"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input" type="text" name="quantity" value="{{ $cartlist->quantity }}">
                                                            <button type="submit" class="btn qty-right-plus" data-type="" data-field="">
                                                                <i class="fa fa-plus ms-0"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="subtotal">
                                            <h4 class="table-title text-content">Total</h4>
                                        @if($cartlist->discount_percent != 0)
                                            @php
                                                $discountedPrice = $discountedPrices[$cartlist->id]['discounted_price'];
                                                $quantity = $cartlist->quantity;
                                                $totalAmount = $discountedPrice * $quantity;
                                                $subTotal += $totalAmount;
                                            @endphp
                                            <h5>¥ {{ number_format($totalAmount , 0, '.', ',') }}</h5>
                                        @else
                                            @php
                                                $sellingPrice = $cartlist->selling_price;
                                                $quantity = $cartlist->quantity;
                                                $totalAmount1 = $sellingPrice * $quantity;
                                                $subTotal += $totalAmount1;
                                            @endphp
                                            <h5>¥ {{ number_format($totalAmount1 , 0, '.', ',') }} </h5>
                                        @endif
                                        </td>
                                           
                                        <td class="save-remove">
                                            <form method="POST" action="{{ route('remove_cart', ['id' => $cartlist->cart_id]) }}">
                                                @csrf
                                                <button type="submit" class="btn-sm btn-animation proceed-btn fw-bold" style="background-color: #0da487; border:0.5px solid #0da487; margin-left:0.5em; color:white;">Remove</button>
                                            </form>
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
                </div>
                
                <div class="col-xxl-3">
                <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                        <div class="summery-box p-sticky">
                            <div class="summery-header">
                                <h3>Cart Total</h3>
                            </div>
                            @if ($couponapplycheck == 1)
                            <div class="alert alert-success alert-block" id="alert-success">
                                <strong>Invalid Coupon Code</strong>
                            </div>
                            @endif
                            <div class="summery-contain" id="ts-form">
                                               
                                    <div class="coupon-cart">
                                        <input type="hidden" name="buyer_id" value="{{ $cartlist->buyer_id }}">
                                        <h6 class="text-content mb-2">Coupon Apply</h6>
                                        <div class="mb-3 coupon-box input-group">
                                            <input type="text" class="form-control" name="coupon" id="exampleFormControlInput1"
                                                placeholder="Enter Coupon Code Here...">
                                            <button id="applyButton" class="btn-apply">Apply</button>
                                        </div>
                                    </div>
                                
                                <ul>
                                    <li>
                                        <h4>Subtotal</h4> 
                                        <h4 class="price">¥ {{ number_format($subTotal , 0, '.', ',') }}</h4>
                                    </li>
                                    
                                    
                                    <li>
                                        <h4>Coupon Discount</h4>   
                                        @if ($couponapplycheck != 1)  
                                        <h4 class="price"> (-) ¥ {{ number_format($discount , 0, '.', ',') }}</h4>
                                        @else
                                        <h4 class="price"> (-) ¥ 0</h4>
                                        @endif
                                    </li>
                                   
                                    
                                    <li class="align-items-start">
                                        <h4>Shipping</h4>
                                        <h4 class="price text-end">¥ 500</h4>
                                    </li>
                                   
                                </ul>
                            </div>

                            <ul class="summery-total">
                                <li class="list-total border-top-0">
                                    <h4>Total (JPY)</h4>
                                    @if($discount)
                                        @php 
                                            $Total  = $subTotal + 500 - $discount
                                        @endphp
                                    @else
                                        @php
                                            $Total  = $subTotal + 500
                                        @endphp
                                    @endif
                                    <h4 class="price theme-color">¥ {{ number_format($Total , 0, '.', ',') }}</h4>
                                </li>
                                
                            </ul>              
                            
                                <input type="hidden" name="subTotal" value="{{ $subTotal }}">
                                <input type="hidden" name="shipping" value="500">
                                <input type="hidden" name="coupon_discount" value="{{ $discount }}">
                                <input type="hidden" name="total" value="{{ $Total }}">
                                
                            <div class="button-group cart-button">
                                <ul>
                                    <li>
                                        <button type="submit"
                                            class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        </form>
                </div>

            </div>
        </div>
    </section>
    <!-- Cart Section End -->
<script>
    document.getElementById('applyButton').addEventListener('click', function() {
        window.location.href = "{{ route('apply_coupon_code') }}";
    });
</script>
</x-guest-layout>