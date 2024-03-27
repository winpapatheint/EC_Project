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

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('seller.update.product') }}" enctype="multipart/form-data" id="tagsForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $products->id }}">
                                    <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">
                                    @if (session('flash_message'))
                                        <div>
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_code" type="text" placeholder="Product Code" value="{{ $products->product_code }}">
                                            @error('product_code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name" value="{{ $products->product_name }}">
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
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Category</label>
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
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id">
                                                <option>Choose SubCategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}" {{ $subcategory->id == $products->subcategory_id  ? 'selected' : '' }}>{{ $subcategory->sub_category_name }}</option>
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
                                                    <option value="{{ $subtitle->id }}" {{ $subtitle->id == $products->sub_category_title_id  ? 'selected' : '' }}>{{ $subtitle->sub_category_titlename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="New product,New" placeholder="Type tag & hit enter" value="{{ $products->product_tags  }}">
                                            @error('product_tags')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,Medium,Large" placeholder="Type size & hit enter" value="{{ $products->product_size }}">
                                            @error('product_size')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type color & hit enter" value="{{ $products->product_color }}">
                                            @error('product_color')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc">{{ $products->short_desc }}</textarea>
                                            @error('short_desc')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="ckeditor">{{ $products->long_desc }}</textarea>
                                            @error('long_desc')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Thumbnail
                                            Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail">
                                            <img id="prev_thambnail" src="{{ asset('upload/product_thambnail/'.$products->product_thambnail)}}" width="100">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="selling_price" type="number" placeholder="0" min="1" value="{{  $products->selling_price }}">
                                            @error('selling_price')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="discount_percent" type="number" placeholder="0-100" min="1" max="100" value="{{ $products->discount_percent }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" placeholder="0" min="1" value="{{ $products->product_qty }}">
                                            @error('product_qty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0" min="1" value="{{ $products->estimate_date }}">
                                            @error('estimate_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
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
                                                    <td><img src="{{ asset('upload/multiImg/'.$img->photo_name) }}" width="100"> </td>
                                                    <td><input type="file" class="form-control" name="multi_img[{{ $img->id }}]"> </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="submit" class="btn btn-primary px-4" value="Update">
                                                            <a href="{{ route('delete.multiImg',$img->id) }}" class="btn btn-secondary px-4">Delete</a>
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

<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
