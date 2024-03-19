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

                                <form class="theme-form theme-form-2 mega-form" action="#">
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_code" type="text" placeholder="Product Code">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="selectOption" class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="custom-select" id="selectOption" name="brand">
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

                                    {{-- <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="state">
                                                <option disabled>Category Menu</option>
                                                <option>Electronics</option>
                                                <option>TV & Appliances</option>
                                                <option>Home & Furniture</option>
                                                <option>Another</option>
                                                <option>Baby & Kids</option>
                                                <option>Health, Beauty & Perfumes</option>
                                                <option>Uncategorized</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Subcategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="state">
                                                <option disabled>Subcategory Menu</option>
                                                <option>Ethnic Wear</option>
                                                <option>Ethnic Bottoms</option>
                                                <option>Women Western Wear</option>
                                                <option>Sandels</option>
                                                <option>Shoes</option>
                                                <option>Beauty & Grooming</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tag" class="form-control" data-role="tagsinput" value="new product,new" placeholder="Type tag & hit enter">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,Medium,Large" placeholder="Type size & hit enter">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type color & hit enter">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_descp" ></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_descp" id="ckeditor" ></textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Thambnail
                                            Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)">
                                            <img src="" id="mainThmb">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" multiple="" name="multi_img" id="multiImg" onchange="previewImages()">
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Price</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="selling_price" type="number" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="discount_percent" type="number" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" placeholder="0">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0">
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

<!-- Modal Start -->
<div class="modal fade" id="addbrand" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog  modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-body">
                <form id="myForm" method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                    @csrf
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Brand</h5>
                    <div class="mb-4">
                        <label class="form-label-title col-sm-3 mb-0">Brand Name:</label>
                        <input type="text" class="form-control" name="brand_name" placeholder="Brand Name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label-title col-sm-3 mb-0">Brand Logo:</label>
                        <input type="file" src="#" alt="" class="form-control" name="brand_logo">
                    </div>
                    <div class="button-box">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
               </form>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
       </div>
   </div>
</div>
<!-- Modal End -->

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).on('submit', 'form', function(event) {
    event.preventDefault();
});
</script>
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
