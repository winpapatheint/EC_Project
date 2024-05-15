<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@php $error = $errors->toArray();  @endphp

@extends('seller.seller_dashboard')
@section('seller')

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

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('store.product') }}" enctype="multipart/form-data" id="tagsForm">
                                    @csrf

                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name" value="{{ old('product_name') }}" id="product_name">
                                            <p style="display:none" class="product_name error text-danger"></p>
                                            @if (!empty($error['product_name']))
                                                @foreach ($error['product_name'] as  $key => $value)
                                                    <p class="product_name error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country_id" id="country_id">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p style="display:none" class="country_id error text-danger"></p>
                                            @if (!empty($error['country_id']))
                                                @foreach ($error['country_id'] as  $key => $value)
                                                    <p class="country_id error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="custom-select" name="brand_id" id="brand_id">
                                                    <option>Choose brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <a href="{{ route('add.brand') }}">
                                                    <button type="button" class="btn btn-light" >
                                                        <i data-feather="plus-square"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <p style="display:none" class="brand_id error text-danger"></p>
                                            @if (!empty($error['brand_id']))
                                                @foreach ($error['brand_id'] as  $key => $value)
                                                    <p class="brand_id error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id" id="category">
                                                <option>Choose Category</option>
                                                @foreach ($categories as $category)
                                                    @if ($category->category_name === "Special Corner")
                                                        <option value="{{ $category->id }}" disabled>{{ $category->category_name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p style="display:none" class="category error text-danger"></p>
                                            @if (!empty($error['category']))
                                                @foreach ($error['category'] as  $key => $value)
                                                    <p class="category error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory">

                                            </select>
                                            <p style="display:none" class="subcategory error text-danger"></p>
                                            @if (!empty($error['subcategory']))
                                                @foreach ($error['subcategory'] as  $key => $value)
                                                    <p class="subcategory error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname">

                                            </select>
                                            <p style="display:none" class="subname error text-danger"></p>
                                            @if (!empty($error['subname']))
                                                @foreach ($error['subname'] as  $key => $value)
                                                    <p class="subname error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="New product,New" placeholder="Type tag & hit enter" value="{{ old('product_tags') }}">
                                            <p style="display:none" class="product_tags error text-danger"></p>
                                            @if (!empty($error['product_tags']))
                                                @foreach ($error['product_tags'] as  $key => $value)
                                                    <p class="product_tags error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,Medium,Large" placeholder="Type size & hit enter" value="{{ old('product_size') }}" id="product_size">
                                            <p style="display:none" class="product_size error text-danger"></p>
                                            @if (!empty($error['product_size']))
                                                @foreach ($error['product_size'] as  $key => $value)
                                                    <p class="product_size error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type color & hit enter" value="{{ old('product_color') }}" id="product_color">
                                            <p style="display:none" class="product_color error text-danger"></p>
                                            @if (!empty($error['product_color']))
                                                @foreach ($error['product_color'] as  $key => $value)
                                                    <p class="product_color error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc" id="short_desc">{{ old('short_desc') }}</textarea>
                                            <p style="display:none" class="short_desc error text-danger"></p>
                                            @if (!empty($error['short_desc']))
                                                @foreach ($error['short_desc'] as  $key => $value)
                                                    <p class="short_desc error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="long_desc">{{ old('long_desc') }}</textarea>
                                            <input type="hidden" name="content" id="content_long_desc">
                                            <p style="display:none" class="content_long_desc error text-danger"></p>
                                            @if (!empty($error['content_long_desc']))
                                                @foreach ($error['content_long_desc'] as  $key => $value)
                                                    <p class="content_long_desc error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Care Instructions</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="care_instructions" id="care_instructions">{{ old('care_instructions') }}</textarea>
                                            <input type="hidden" name="content" id="content_care_instructions">
                                            <p style="display:none" class="content_care_instructions error text-danger"></p>
                                            @if (!empty($error['content_care_instructions']))
                                                @foreach ($error['content_care_instructions'] as  $key => $value)
                                                    <p class="content_care_instructions error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Thambnail Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)" value="{{ old('product_thambnail') }}">
                                            <img src="" id="mainThmb">
                                            <p style="display:none" class="formFile error text-danger"></p>
                                            @if (!empty($error['formFile']))
                                                @foreach ($error['formFile'] as  $key => $value)
                                                    <p class="formFile error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" multiple name="multi_img[]" id="multiImg">
                                            <div>&ast;Attach images with using shift key.</div>
                                            <div id="preview_img"></div>
                                            <p style="display:none" class="multiImg error text-danger"></p>
                                            @if (!empty($error['multiImg']))
                                                @foreach ($error['multiImg'] as  $key => $value)
                                                    <p class="multiImg error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Original Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="original_price" id="original_price" type="number" placeholder="0" min="1" value="{{ old('original_price') }}">
                                            <p style="display:none" class="original_price error text-danger"></p>
                                            @if (!empty($error['original_price']))
                                                @foreach ($error['original_price'] as  $key => $value)
                                                    <p class="original_price error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="discount_percent" id="discount_percent" type="number" placeholder="0-100%" min="0" max="100" value="{{ old('discount_percent') }}">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="selling_price" id="selling_price" type="number" disabled>
                                            <input type="hidden" name="calculated_selling_price" id="calculated_selling_price">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" placeholder="0" min="1" value="{{ old('product_qty') }}" id="product_qty">
                                            <p style="display:none" class="product_qty error text-danger"></p>
                                            @if (!empty($error['product_qty']))
                                                @foreach ($error['product_qty'] as  $key => $value)
                                                    <p class="product_qty error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0" min="1" value="{{ old('estimate_date') }}" id="estimate_date">
                                            <p style="display:none" class="estimate_date error text-danger"></p>
                                            @if (!empty($error['estimate_date']))
                                                @foreach ($error['estimate_date'] as  $key => $value)
                                                    <p class="estimate_date error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Delivery Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="delivery_price" type="number" placeholder="400" min="1" value="{{ old('delivery_price') }}" id="delivery_price">
                                            <p style="display:none" class="delivery_price error text-danger"></p>
                                            @if (!empty($error['delivery_price']))
                                                @foreach ($error['delivery_price'] as  $key => $value)
                                                    <p class="delivery_price error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimModal">Save</button>

                                    <!-- Confirm Modal Box -->
                                    <div class="modal fade theme-modal remove-coupon" id="confirmModal" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="remove-box">
                                                        <p>The data will be added permanently.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-animation btn-md fw-bold" >Yes</button>
                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Confirm Modal Box End-->
                                </form>
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
    document.getElementById('category').addEventListener('change', function() {
        var categoryId = this.value;
        var subcategorySelect = document.getElementById('subcategory');
        if (subcategorySelect) {
            subcategorySelect.innerHTML = '<option value="">Choose SubCategoryTitle</option>';

            if (!categoryId) {return;}

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
                    } else {
                        console.error('Failed to fetch subcategories');
                    }
                }
            };
            xhr.open('GET', '/get-subtitle/' + categoryId);
            xhr.send();
        } else {
            console.error('Subcategory select element not found');
        }
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('subcategory').addEventListener('change', function() {
        var subcategoryTitleId = this.value;
        var subcategorySelect = document.getElementById('subname');
        subcategorySelect.innerHTML = '<option value="">Choose SubCategory</option>';

        if (!subcategoryTitleId) {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var subcategories = JSON.parse(xhr.responseText);
                    subcategories.forEach(function(subcategory) {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.sub_category_name;
                        subcategorySelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to fetch subcategories');
                }
            }
        };
        xhr.open('GET', '/get-subcategories-by-title/' + subcategoryTitleId);
        xhr.send();
    });

    document.getElementById('subname').addEventListener('change', function() {
        var subcategoryId = this.value;
    });
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

    if (!isNaN(originalPrice)) {
        if (!isNaN(discountPercent)) {
            const discountAmount = originalPrice * (discountPercent / 100);
            const sellingPrice = originalPrice - discountAmount;
            sellingPriceInput.value = Math.round(sellingPrice);
            calculatedSellingPriceInput.value = Math.round(sellingPrice);
        } else {
            sellingPriceInput.value = Math.round(originalPrice);
            calculatedSellingPriceInput.value = Math.round(originalPrice);
        }
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
    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector('#long_desc'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_long_desc').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#care_instructions'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_care_instructions').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(70).height(70);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.getElementById('multiImg').addEventListener('change', function(event) {
        const files = event.target.files;
        const preview = document.getElementById('preview_img');
        preview.innerHTML = '';

        if (files.length > 5) {
            alert('Please select a maximum of 5 images.');
            this.value = '';
            return;
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '80px';
                img.style.maxHeight = '80px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<script>
    $('.btn-submit').click(function() {
      $('.error').hide()

      if ($.trim($("#product_name").val()) === "" || $.trim($("#country_id").val()) === ""  || $.trim($("#brand_id").val()) === ""  || $.trim($("#category").val()) === ""  || $.trim($("#subcategory").val()) === ""  || $.trim($("#subname").val()) === ""  || $.trim($("#product_tags").val()) === ""  || $.trim($("#product_size").val()) === ""  || $.trim($("#product_color").val()) === ""  || $.trim($("#short_desc").val()) === ""  || $.trim($("#content_long_desc").val()) === ""  || $.trim($("#content_care_instructions").val()) === ""  || $.trim($("#formFile").val()) === ""  || $.trim($("#multiImg").val()) === ""  || $.trim($("#original_price").val()) === ""  || $.trim($("#product_qty").val()) === ""  || $.trim($("#estimate_date").val()) === ""  || $.trim($("#delivery_price").val()) === "") {

         if ($.trim($("#product_name").val()) === "") {
              $('.error.product_name').text('Product Name must be present')
              $('.error.product_name').show()
         }

         if ($.trim($("#country_id").val()) === "Choose country") {
              $('.error.country_id').text('Choose a country name')
              $('.error.country_id').show()
         }

         if ($.trim($("#brand_id").val()) === "Choose brand") {
              $('.error.brand_id').text('Choose a brand name')
              $('.error.brand_id').show()
         }

         if ($.trim($("#category").val()) === "Choose Category") {
              $('.error.category').text('Choose a category name')
              $('.error.category').show()
         }

         if ($.trim($("#subcategory").val()) === "") {
              $('.error.subcategory').text('Choose a title')
              $('.error.subcategory').show()
         }

         if ($.trim($("#subname").val()) === "") {
              $('.error.subname').text('Choose a subcategory')
              $('.error.subname').show()
         }

         if ($.trim($("#product_tags").val()) === "") {
              $('.error.product_tags').text('Product tags must be present')
              $('.error.product_tags').show()
         }

         if ($.trim($("#product_size").val()) === "") {
              $('.error.product_size').text('Product size must be present')
              $('.error.product_size').show()
         }

         if ($.trim($("#product_color").val()) === "") {
              $('.error.product_color').text('Product color must be present')
              $('.error.product_color').show()
         }

         if ($.trim($("#short_desc").val()) === "") {
              $('.error.short_desc').text('Short description must be present')
              $('.error.short_desc').show()
         }

         if ($.trim($("#content_long_desc").val()) === "") {
              $('.error.content_long_desc').text('Long description must be present')
              $('.error.content_long_desc').show()
         }

         if ($.trim($("#content_care_instructions").val()) === "") {
              $('.error.content_care_instructions').text('Care instructions must be present')
              $('.error.content_care_instructions').show()
         }

         if ($.trim($("#formFile").val()) === "") {
              $('.error.formFile').text('Product thambnail must be present')
              $('.error.formFile').show()
         }

         if ($.trim($("#multiImg").val()) === "") {
              $('.error.multiImg').text('Multiple images must be present')
              $('.error.multiImg').show()
         }

         if ($.trim($("#original_price").val()) === "") {
              $('.error.original_price').text('Original price must be present')
              $('.error.original_price').show()
         }

         if ($.trim($("#product_qty").val()) === "") {
              $('.error.product_qty').text('Product quantity must be present')
              $('.error.product_qty').show()
         }

         if ($.trim($("#estimate_date").val()) === "") {
              $('.error.estimate_date').text('Estimate date must be present')
              $('.error.estimate_date').show()
         }

         if ($.trim($("#delivery_price").val()) === "") {
              $('.error.delivery_price').text('Delivery price must be present')
              $('.error.delivery_price').show()
         }

         return false;
      } else {
        $('#confirmModal').modal('show');
      }
    });
</script>
@endsection
