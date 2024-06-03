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

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('store.product') }}" enctype="multipart/form-data" id="sellerRegister">
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name" value="{{ old('product_name') }}" id="product_name">
                                            <p class="error" style="color:red" id="error-product_name"></p>
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
                                            <p class="error" style="color:red" id="error-country_id"></p>
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
                                            <p class="error" style="color:red" id="error-brand_id"></p>
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
                                            <p class="error" style="color:red" id="error-category_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory">

                                            </select>
                                            <p class="error" style="color:red" id="error-sub_category_title_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname">

                                            </select>
                                            <p class="error" style="color:red" id="error-sub_category_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="New product,New" placeholder="Type tag & hit enter" value="{{ old('product_tags') }}">
                                            <p class="error" style="color:red" id="error-product_tags"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,Medium,Large" placeholder="Type size & hit enter" value="{{ old('product_size') }}" id="product_size">
                                            <p class="error" style="color:red" id="error-product_size"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type color & hit enter" value="{{ old('product_color') }}" id="product_color">
                                            <p class="error" style="color:red" id="error-product_color"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="5">{{ old('short_desc') }}</textarea>
                                            <p class="error" style="color:red" id="error-short_desc"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="long_desc">{{ old('content_long_desc') }}</textarea>
                                            <input type="hidden" name="content" id="content_long_desc">
                                            <p class="error" style="color:red" id="error-long_desc"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Care Instructions</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="care_instructions" id="care_instructions">{{ old('content_care_instructions') }}</textarea>
                                            <input type="hidden" name="content" id="content_care_instructions">
                                            <p class="error" style="color:red" id="error-care_instructions"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Thambnail Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)" value="{{ old('product_thambnail') }}">
                                            <img src="" id="mainThmb">
                                            <p class="error" style="color:red" id="error-product_thambnail"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div id="fileInputs" class="custom-select">
                                                    <input class="form-control" type="file" name="images[]" accept="image/*" id="multiImg" >
                                                </div>
                                                <button type="button" class="btn btn-light" id="addFileInput">
                                                    <i data-feather="plus-square"></i>
                                                </button>
                                            </div>
                                            <p class="error" style="color:red" id="error-images"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Original Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="original_price" id="original_price" type="number" placeholder="0" min="1" value="{{ old('original_price') }}">
                                            <p class="error" style="color:red" id="error-original_price"></p>
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
                                            <p class="error" style="color:red" id="error-product_qty"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0" min="1" value="{{ old('estimate_date') }}" id="estimate_date">
                                            <p class="error" style="color:red" id="error-estimate_date"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Delivery Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="delivery_price" type="number" placeholder="400" min="1" value="{{ old('delivery_price') }}" id="delivery_price">
                                            <p class="error" style="color:red" id="error-delivery_price"></p>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation btn-submit">Save</button>
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
        const addFileInputBtn = document.getElementById('addFileInput');
        const initialFileInput = document.getElementById('multiImg');
        const fileInputsContainer = document.getElementById('fileInputs');
        let imageCount = 0;

        function createImageContainer(file, fileInput) {
            const imageContainer = document.createElement('div');
            imageContainer.classList.add('file-input-container');

            const newImage = document.createElement('img');
            newImage.src = URL.createObjectURL(file);
            newImage.classList.add('uploaded-image');
            newImage.style.width = newImage.style.height = '70px';

            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&#10006;';
            closeButton.classList.add('close-button');
            closeButton.addEventListener('click', () => {
                fileInputsContainer.removeChild(imageContainer);
                fileInputsContainer.removeChild(fileInput);
                imageCount--;
            });

            imageContainer.appendChild(newImage);
            imageContainer.appendChild(closeButton);
            fileInputsContainer.appendChild(imageContainer);
        }

        function handleFileInputChange(event) {
            const fileInput = event.target;
            for (const file of fileInput.files) {
                if (imageCount < 5) {
                    createImageContainer(file, fileInput);
                    imageCount++;
                } else {
                    alert('You can only upload a maximum of 5 images.');
                    break;
                }
            }
        }

        initialFileInput.addEventListener('change', handleFileInputChange);

        addFileInputBtn.addEventListener('click', () => {
            if (imageCount < 5) {
                const newFileInput = document.createElement('input');
                newFileInput.type = 'file';
                newFileInput.name = 'images[]';
                newFileInput.accept = 'image/*';
                newFileInput.style.display = 'none';
                newFileInput.addEventListener('change', handleFileInputChange);
                fileInputsContainer.appendChild(newFileInput);
                newFileInput.click();
            } else {
                alert('You can only upload a maximum of 5 images.');
            }
        });
    });
</script>

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
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
    function validateUserForm() {
        let isValid = true;

        const product_name = document.getElementById('product_name').value.trim();
        const country_id = document.querySelector('select[name="country_id"]').value;
        const brand_id = document.querySelector('select[name="brand_id"]').value;
        const category_id = document.querySelector('select[name="category_id"]').value;
        const sub_category_title_id = document.querySelector('select[name="sub_category_title_id"]').value;
        const sub_category_id = document.querySelector('select[name="sub_category_id"]').value;
        const product_tags = document.getElementById('product_tags').value.trim();
        const product_size = document.getElementById('product_size').value.trim();
        const product_color = document.getElementById('product_color').value.trim();
        const short_desc = document.getElementById('short_desc').value.trim();
        const long_desc = document.getElementById('long_desc').value.trim();
        const care_instructions = document.getElementById('care_instructions').value.trim();
        const productImage = document.getElementById('formFile').files[0];
        const productImages = document.getElementById('multiImg').files[0];
        const original_price = document.getElementById('original_price').value.trim();
        const product_qty = document.getElementById('product_qty').value.trim();
        const estimate_date = document.getElementById('estimate_date').value.trim();
        const delivery_price = document.getElementById('delivery_price').value.trim();

        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        if (!product_name) {
            isValid = false;
            document.getElementById('error-product_name').textContent = 'Please provide product name.';
        } else if (product_name.length > 255) {
            isValid = false;
            document.getElementById('error-product_name').textContent = 'Product name must not exceed 255 characters.';
        }

        if (!country_id || country_id === 'Choose country') {
            isValid = false;
            document.getElementById('error-country_id').textContent = 'Please select a valid country.';
        }

        if (!brand_id || brand_id === 'Choose brand') {
            isValid = false;
            document.getElementById('error-brand_id').textContent = 'Please select a valid brand.';
        }

        if (!category_id || category_id === 'Choose Category') {
            isValid = false;
            document.getElementById('error-category_id').textContent = 'Please select a valid category.';
        }

        if (!sub_category_title_id || sub_category_title_id === 'Choose SubCategoryTitle') {
            isValid = false;
            document.getElementById('error-sub_category_title_id').textContent = 'Please select a valid subcategory title.';
        }

        if (!sub_category_id || sub_category_id === 'Choose SubCategory') {
            isValid = false;
            document.getElementById('error-sub_category_id').textContent = 'Please select a valid subcategory.';
        }

        if (!product_tags) {
            isValid = false;
            document.getElementById('error-product_tags').textContent = 'Please provide product tags.';
        } else if (product_tags.length > 255) {
            isValid = false;
            document.getElementById('error-product_tags').textContent = 'Product tags must not exceed 255 characters.';
        }

        if (!product_size) {
            isValid = false;
            document.getElementById('error-product_size').textContent = 'Please provide product size.';
        } else if (product_size.length > 255) {
            isValid = false;
            document.getElementById('error-product_size').textContent = 'Product size must not exceed 255 characters.';
        }

        if (!product_color) {
            isValid = false;
            document.getElementById('error-product_color').textContent = 'Please provide product color.';
        } else if (product_color.length > 255) {
            isValid = false;
            document.getElementById('error-product_color').textContent = 'Product color must not exceed 255 characters.';
        }

        if (!short_desc) {
            isValid = false;
            document.getElementById('error-short_desc').textContent = 'Please provide short description.';
        } else if (short_desc.length > 400) {
            isValid = false;
            document.getElementById('error-short_desc').textContent = 'Short description must not exceed 400 characters.';
        }

        if (!long_desc) {
            isValid = false;
            document.getElementById('error-long_desc').textContent = 'Please provide long description.';
        } else if (long_desc.length > 2000) {
            isValid = false;
            document.getElementById('error-long_desc').textContent = 'Long description must not exceed 2000 characters.';
        }

        if (!care_instructions) {
            isValid = false;
            document.getElementById('error-care_instructions').textContent = 'Please provide care instructions.';
        } else if (care_instructions.length > 1200) {
            isValid = false;
            document.getElementById('error-care_instructions').textContent = 'Care instructions must not exceed 1200 characters.';
        }

        if (!productImage) {
            isValid = false;
            document.getElementById('error-product_thambnail').textContent = 'Please provide product image.';
        } else if (productImage.size > 2 * 1024 * 1024) {
            isValid = false;
            document.getElementById('error-product_thambnail').textContent = 'Product image must not exceed 2MB.';
        }

        if (!productImages) {
            isValid = false;
            document.getElementById('error-images').textContent = 'Please provide multiple product images.';
        } else if (productImages.size > 2 * 1024 * 1024) {
            isValid = false;
            document.getElementById('error-images').textContent = 'Product images must not exceed 2MB.';
        }

        if (!original_price) {
            isValid = false;
            document.getElementById('error-original_price').textContent = 'Please provide original price.';
        } else if (!/^\d+$/.test(original_price)) {
            isValid = false;
            document.getElementById('error-original_price').textContent = 'Please provide a valid digit.';
        }

        if (!product_qty) {
            isValid = false;
            document.getElementById('error-product_qty').textContent = 'Please provide product quantity.';
        } else if (!/^\d+$/.test(product_qty)) {
            isValid = false;
            document.getElementById('error-product_qty').textContent = 'Please provide a valid digit.';
        }

        if (!estimate_date) {
            isValid = false;
            document.getElementById('error-estimate_date').textContent = 'Please provide delivery estimate date.';
        }

        if (!delivery_price) {
            isValid = false;
            document.getElementById('error-delivery_price').textContent = 'Please provide delivery price.';
        } else if (!/^\d+$/.test(delivery_price)) {
            isValid = false;
            document.getElementById('error-delivery_price').textContent = 'Please provide a valid digit.';
        }

        if (isValid) {
            document.getElementById('sellerRegister').submit();
        }
    }

    document.getElementById('sellerRegister').addEventListener('submit', function(event) {
        event.preventDefault();
        validateUserForm();
    });
</script>
@endsection
