<x-auth-layout>
<div class="page-body">
    <!-- Product Detail Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Product Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_code }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_name }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Brand</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->brand_name }}</p>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Category</label>
                                            <div class="col-sm-9">
                                                <p>Fruit</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Subcategory</label>
                                            <div class="col-sm-9">
                                                <p>-</p>
                                            </div>
                                        </div> --}}

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_tags }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_size }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_color }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->short_desc }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->long_desc }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Thumbnail
                                                Image</label>
                                            <div class="col-sm-9">
                                                <img width="100" src="{{ asset('upload/product_thambnail/'.$product-> product_thambnail) }}">
                                            </div>
                                        </div>



                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Price</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->selling_price }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Discount</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->discount_percent }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Product Quantity</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->product_qty }}</p>
                                            </div>
                                        </div>
                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Delivey Estimate Day</label>
                                            <div class="col-sm-9">
                                                <p>{{ $product->estimate_date }}</p>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Detail End -->
</div>
</x-auth-layout>
