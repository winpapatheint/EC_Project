@extends('seller.seller_dashboard')
@section('seller')
@php $error = $errors->toArray();
@endphp
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

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('seller.store.product') }}" enctype="multipart/form-data" id="tagsForm">
                                    @csrf
                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_code" type="text" placeholder="Product Code" value="{{ old('product_code') }}">
                                            @error('product_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name" value="{{ old('product_name') }}">
                                            @error('product_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country_id">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id">
                                                <option>Choose Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id">
                                                <option>Choose SubCategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_title_id">
                                                <option>Choose SubCategoryTitle</option>
                                                @foreach ($subcatitle as $subtitle)
                                                    <option value="{{ $subtitle->id }}">{{ $subtitle->sub_category_titlename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="New product,New" placeholder="Type tag & hit enter" value="{{ old('product_tags') }}">
                                            @error('product_tags')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,Medium,Large" placeholder="Type size & hit enter" value="{{ old('product_size') }}">
                                            @error('product_size')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type color & hit enter" value="{{ old('product_color') }}">
                                            @error('product_color')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc"></textarea>
                                            @error('short_desc')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="ckeditor"></textarea>
                                            @error('long_desc')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Thambnail
                                            Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)" value="{{ old('product_thambnail') }}">
                                            @error('product_thambnail')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <img src="" id="mainThmb">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" multiple="" name="multi_img[]" id="multiImg" value="{{ old('multi_img') }}">
                                            @error('multi_img')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="selling_price" type="number" placeholder="0" min="1" value="{{ old('selling_price') }}">
                                            @error('selling_price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="discount_percent" type="number" placeholder="0-100" min="1" max="100" value="{{ old('discount_percent') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" placeholder="0" min="1" value="{{ old('product_qty') }}">
                                            @error('product_qty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0" min="1" value="{{ old('estimate_date') }}">
                                            @error('estimate_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation">Save</button>
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

<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
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
        const preview = document.getElementById('preview_img');
        preview.innerHTML = '';

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

@endsection
