<x-guest-layout>

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
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="product-box-contain">
                                    
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href=" {{ url('/product-left-thumbnail') }}" class="product-image">
                                                    <img src="../assets/images/vegetable/product/1.png"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a href=" {{ url('/product-left-thumbnail') }} ">{{ $product->product_name }}</a>
                                                        </li>

                                                        <li class="text-content"><span class="text-title">Sold
                                                                By:</span>{{ $product->shop_name }}</li>

                                                        <li class="text-content"><span
                                                                class="text-title">Quantity</span>{{ $product->product_name }}</li>

                                                        <li>
                                                            <h5 class="text-content d-inline-block">Price :</h5>
                                                            <span>{{ $product->selling_price }}</span>
                                                            <span class="text-content"></span>
                                                        </li>
                                                        
                                                        <li>
                                                        
                                                            <h5 class="saving theme-color">Saving : 20</h5>
                                                        
                                                        </li>

                                                        <li class="quantity-price-box">
                                                            <div class="cart_qty">
                                                                <div class="input-group">
                                                                    <button type="button" class="btn qty-left-minus"
                                                                        data-type="minus" data-field="">
                                                                        <i class="fa fa-minus ms-0"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input"
                                                                        type="text" name="quantity" value="0">
                                                                    <button type="button" class="btn qty-right-plus"
                                                                        data-type="plus" data-field="">
                                                                        <i class="fa fa-plus ms-0"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <h5>Total: $35.10</h5>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($discountedPrices as $discountedPrice)
                                        <td class="price">
                                            <h4 class="table-title text-content">Price</h4>
                                            <h5>¥{{ $discountedPrices[$product->id]['discounted_price'] }}<del class="text-content">¥{{ $product->selling_price }}</del></h5>
                                            
                                            <h6 class="theme-color">You Save : ¥{{ $discountedPrices[$product->id]['save_amount'] }}</h6>
                                        </td>
                                       @endforeach
                                        <td class="quantity">
                                            <h4 class="table-title text-content">Qty</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group">
                                                        <button type="button" class="btn qty-left-minus"
                                                            data-type="minus" data-field="">
                                                            <i class="fa fa-minus ms-0"></i>
                                                        </button>
                                                        <input class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                        <button type="button" class="btn qty-right-plus"
                                                            data-type="plus" data-field="">
                                                            <i class="fa fa-plus ms-0"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="subtotal">
                                            <h4 class="table-title text-content">Total</h4>
                                            <h5>$35.10</h5>
                                        </td>

                                        <td class="save-remove">
                                            <h4 class="table-title text-content">Action</h4>
                                            <a class="save notifi-wishlist" href="javascript:void(0)">Save for later</a>
                                            <a class="remove close_button" href="javascript:void(0)">Remove</a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">$125.65</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-) 0.00</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Shipping</h4>
                                    <h4 class="price text-end">$6.90</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color">$132.58</h4>
                            </li>
                        </ul>
                        <form method="POST" action="{{ route('checkout') }}" >
                            @csrf
                            <div class="button-group cart-button">
                                <ul>
                                    <li>
                                        <button type="submit"
                                            class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                    </li>

                                    <li>
                                        <button onclick="location.href = 'index.html';"
                                            class="btn btn-light shopping-button text-dark">
                                            <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->

</x-guest-layout>