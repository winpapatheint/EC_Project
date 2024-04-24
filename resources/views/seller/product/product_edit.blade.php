@extends('seller.seller_dashboard')
@section('seller')
<style>
    .btn-group {
        display: flex;
        border
    }

    .btn-group input[type="submit"],
    .btn-group a {
        flex: 1;
        border-radius: 0%;
    }
    .btn-group input,
    .btn-group button {

        border-radius: 0%;
    }
</style>
<div class="page-body">
<!-- New Product Add Start -->
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

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('update.product') }}" enctype="multipart/form-data" id="tagsForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $products->id }}">
                                    <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">
                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" value="{{ $products->product_name }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country_id">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" {{ $country->id == $products->country_id  ? 'selected' : '' }}> {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="custom-select" name="brand_id">
                                                    <option>Choose brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id  ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <a href="{{ route('add.brand') }}">
                                                    <button type="button" class="btn btn-light" >
                                                        <i data-feather="plus-square"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id">
                                                <option>Choose Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $products->category_id  ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname">
                                                {{-- <option>{{ $products->subcategory->sub_category_name }}</option> --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="{{ $products->product_tags  }}" value="{{ old('product_tags') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="{{ $products->product_size }}" value="{{ old('product_size') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="{{ $products->product_color }}" value="{{ old('product_color') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc">{{ $products->short_desc }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="ckeditor">{!! $products->long_desc !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Thambnail Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail">
                                            <img id="prev_thambnail" src="{{ asset('upload/product_thambnail/'.$products->product_thambnail)}}" width="80">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Original Price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="original_price" id="original_price" type="number" min="1" value="{{  $products->original_price }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="discount_percent" id="discount_percent" type="number" min="0" max="100" value="{{ $products->discount_percent }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="selling_price" id="selling_price" type="number" value="calculated_selling_price" disabled>
                                            <input type="hidden" name="calculated_selling_price" id="calculated_selling_price">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" min="1" value="{{ $products->product_qty }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" min="1" value="{{ $products->estimate_date }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Delivery Price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="delivery_price" type="number" min="1" value="{{ $products->delivery_price }}">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation">Update</button>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Multiple Image</h5>
                                </div>
                                <table class="table variation-table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Change Image</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form class="theme-form theme-form-2 mega-form" method="POST" action="{{ route('update.multiImg') }}" enctype="multipart/form-data">
                                            @csrf
                                            @foreach ($multiImgs as $key => $img)
                                                <tr>
                                                    <th>{{ $key+1 }}</th>
                                                    <td><img src="{{ asset('upload/multiImg/'.$img->photo_name) }}" width="80"></td>
                                                    <td><input type="file" class="form-control" name="multi_img[{{ $img->id }}]"></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <input type="submit" class="btn btn-primary px-4" value="Update">
                                                            <a href="{{ route('delete.multiImg', $img->id) }}" class="btn btn-secondary px-3 ms-2">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Product Add End -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var categoryId = '{{ $products->category_id }}';
        var subcategorySelect = document.getElementById('subcategory');
        if (subcategorySelect) {
            subcategorySelect.innerHTML = '<option value="">Choose SubCategoryTitle</option>';

            if (categoryId) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var subcategories = JSON.parse(xhr.responseText);
                            subcategories.forEach(function(subcategory) {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.sub_category_titlename;
                                subcategorySelect.appendChild(option);
                            });

                            subcategorySelect.value = '{{ $products->sub_category_title_id }}';
                        } else {
                            console.error('Failed to fetch subcategories');
                        }
                    }
                };
                xhr.open('GET', '/get-subtitle/' + categoryId);
                xhr.send();
            }
        } else {
            console.error('Subcategory select element not found');
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedSubcategoryTitleId = '{{ $products->sub_category_title_id }}';

        var subcategorySelect = document.getElementById('subcategory');
        subcategorySelect.addEventListener('change', function() {
            var subcategoryTitleId = this.value;

            var subcategoryNameSelect = document.getElementById('subname');
            subcategoryNameSelect.innerHTML = '<option value="">{{ $products->subcategory->sub_category_name }}</option>';

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var subcategories = JSON.parse(xhr.responseText);
                        subcategories.forEach(function(subcategory) {
                            var option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.sub_category_name;
                            subcategoryNameSelect.appendChild(option);
                        });

                        subcategoryNameSelect.value = '{{ $products->sub_category_id }}';
                    } else {
                        console.error('Failed to fetch subcategories');
                    }
                }
            };
            xhr.open('GET', '/get-subcategories-by-title/' + subcategoryTitleId);
            xhr.send();
        });

        var event = new Event('change');
        subcategorySelect.dispatchEvent(event);
    });
</script>




<script>
    const originalPriceInput = document.getElementById('original_price');
    const discountPercentInput = document.getElementById('discount_percent');
    const sellingPriceInput = document.getElementById('selling_price');
    const calculatedSellingPriceInput = document.getElementById('calculated_selling_price');

    function calculateSellingPrice() {
        const originalPrice = parseFloat(originalPriceInput.value);
        const discountPercent = parseFloat(discountPercentInput.value);

        if (!isNaN(originalPrice) && !isNaN(discountPercent)) {
            const discountAmount = originalPrice * (discountPercent / 100);
            const sellingPrice = originalPrice - discountAmount;
            sellingPriceInput.value = Math.round(sellingPrice);
            calculatedSellingPriceInput.value = Math.round(sellingPrice);
        } else {
            sellingPriceInput.value = '';
            calculatedSellingPriceInput.value = '';
        }
    }

    originalPriceInput.addEventListener('input', calculateSellingPrice);
    discountPercentInput.addEventListener('input', calculateSellingPrice);
    calculateSellingPrice();
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>


@endsection
