
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>

    @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;}
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
                                        <h5>Edit Product</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form" id="editproduct" class="contact-form" method="POST" action="{{ route('storeproduct') }}"  enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Product Code" name="productcode" id="productcode"
                                                        value="{{ old('productcode') ?? $data->product_code ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Product Code" name="productname" id="productname"
                                                        value="{{ old('productname') ?? $data->product_name ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                                    <div class="col-sm-8">
                                                        <select class="js-example-basic-single w-100" name="country" id="country">
                                                            <option>select country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country -> id }}"  @if($data -> country_id == $country -> id ) selected ?? '' @endif >
                                                                    {{ $country -> name }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">Brands</label>
                                                    <div class="col-sm-8">
                                                        <select class="js-example-basic-single w-100" name="brand" id="brand">
                                                            <option>select brand</option>
                                                            @foreach($brands as $brand)
                                                                <option value="{{ $brand -> id }}"  @if($data -> brand_id == $brand -> id ) selected ?? '' @endif >
                                                                    {{ $brand -> brand_name }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                                    <div class="col-sm-8">
                                                        <select class="js-example-basic-single w-100" name="category" id="category">
                                                            <option>select category</option>
                                                            @foreach($categorylist as $category)
                                                                <option value="{{ $category -> id }}"  @if($data -> category_id == $category -> id ) selected ?? '' @endif >
                                                                    {{ $category -> category_name }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                                    <div class="col-sm-8">
                                                        <select class="js-example-basic-single w-100" name="subcattitle" id="subcattitle">
                                                            <option>select SubCategory Title</option>
                                                            @foreach($subtitlelist as $subcattitle)
                                                                <option value="{{ $subcattitle -> id }}"  @if($data -> sub_category_title_id == $subcattitle -> id ) selected ?? '' @endif >
                                                                    {{$subcattitle -> sub_category_titlename }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                                    <div class="col-sm-8">
                                                        <select class="js-example-basic-single w-100" name="subcategory" id="subcategory">
                                                            <option>select SubCategory</option>
                                                            @foreach($subcategorylist as $subcategory)
                                                                <option value="{{ $subcategory -> id }}"  @if( $data -> sub_category_id == $subcategory -> id ) selected ?? '' @endif >
                                                                    {{ $subcategory -> sub_category_name }}  </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags"
                                                        placeholder="Type tag & hit enter" value="{{ $data->product_tags  }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="product_size" data-role="tagsinput"
                                                        placeholder="Type size & hit enter" value="{{ $data->product_size }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="product_color" data-role="tagsinput"
                                                    placeholder="Type color & hit enter" value="{{ $data->product_color }}">
                                                    @error('product_color')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="short_desc">{{ $data->short_desc }}</textarea>
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="long_desc" id="ckeditor">{{ $data->long_desc }}</textarea>
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Thumbnail
                                                    Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" name="product_thambnail">
                                                    <img id="prev_thambnail" src="{{ asset('upload/product_thambnail/'.$data->product_thambnail)}}" width="100">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Price</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="selling_price" type="number" placeholder="0" min="1" value="{{  $data->selling_price }}">

                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="discount_percent" type="number"
                                                    placeholder="0-100" min="1" max="100" value="{{ $data->discount_percent }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Product Quantity</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="product_qty" type="number"
                                                    placeholder="0" min="1" value="{{ $data->product_qty }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Estimated Date</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="estimate_date" type="number"
                                                    placeholder="0" min="1" value="{{ $data->estimate_date }}">
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Commision(%)</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" name="commision" type="number"
                                                    placeholder="0-100" min="1" max="100" value="{{ $data->commission ?? '' }}">

                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-animation ms-auto fw-bold">
                                                @if (!$editmode)
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                        {{ __('auth.doregister') }}
                                                @else
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                        {{ __('auth.yeschange') }}
                                                @endif
                                            </button>
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
                                            <form class="theme-form theme-form-2 mega-form" method="post" action="{{ route('update.multiImg') }}"
                                              enctype="multipart/form-data">
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
                reader.readAsDataURL(input.files[0]); // Corrected method name
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

    <script>
        function selectIcon(iconPath) {
            document.getElementById('selectedIcon').value = iconPath;
            document.getElementById('selectedIconPreview').src = iconPath;
            document.getElementById('selectedIconPreview').style.display = 'block';
        }
    </script>

</x-auth-layout>

