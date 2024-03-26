
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

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
                                        <h5>Seller Information</h5>
                                    </div>
                                    @if (!$editmode)
                                    @php $action= route('registerconfirm') ; @endphp
                                    @else
                                    @php $action= route('edituser') ; @endphp
                                    @endif
                                    <form class="theme-form theme-form-2 mega-form" id="registeruserform" method="POST" action="{{ $action }}">
                                        @csrf
                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block" id="alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                            @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $editseller->id }}">
                                            @else
                                            <input type="hidden" name="role" value="hcompany">
                                            @endif

                                            <!-- <input type="hidden" name="freecount" value="{{ $_GET['freecount'] ?? ''}}"> -->

                                             <div class="error-container"></div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Shop Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="shop name" name="shopname" id="shopname"
                                                        type="text" value="{{ old('shopname') ?? $editseller->shop_name ?? '' }}" >
                                                    <p style="display:none" class="shopname error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Established Year</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email"
                                                    placeholder="Established Year" name="shopyear" id="shopyear"
                                                        type="date" value="{{ old('shopyear') ?? $editseller->shop_establish ?? '' }}" >
                                                    <p style="display:none" class="shopyear error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Shop Logo</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="Shop Logo" name="shoplogo" id="shoplogo"
                                                        type="file" value="{{ old('shoplogo') ?? $editseller->shop_logo?? '' }}" >
                                                    <p style="display:none" class="shoplogo error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="Phone" name="phone" id="phone"
                                                        type="file" value="{{ old('phone') ?? $editseller->phone ?? '' }}" >
                                                    <p style="display:none" class="phone error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Zip Code</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="Zip Code" name="zipcode" id="zipcode"
                                                        type="file" value="{{ old('zipcode') ?? $editseller->zip_code ?? '' }}" >
                                                    <p style="display:none" class="zipcode error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">  Shop Link</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="Shop Link" name="shoplink" id="shoplink"
                                                    type="text" value="{{ old('shoplink') ?? $editseller->url ?? '' }}" >
                                                <p style="display:none" class="shoplink error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Address</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="Address" name="address" id="address"
                                                    type="text" value="{{ old('address') ?? $editseller->address ?? '' }}" >
                                                <p style="display:none" class="address error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Name" name="bankname" id="bankname"
                                                    type="text" value="{{ old('bankname') ?? $editseller->bank_name ?? '' }}" >
                                                <p style="display:none" class="bankname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Type</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Type" name="accounttype" id="accounttype"
                                                    type="text" value="{{ old('accounttype') ?? $editseller->bank_acc_type ?? '' }}" >
                                                <p style="display:none" class="accounttype error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Branch Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Branch Name" name="branchname" id="branchname"
                                                    type="text" value="{{ old('branchname') ?? $editseller->bank_branch ?? '' }}" >
                                                <p style="display:none" class="branchname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Name" name="bankaccountname" id="bankaccountname"
                                                    type="text" value="{{ old('bankaccountname') ?? $editseller->bank_acc_name ?? '' }}" >
                                                <p style="display:none" class="bankaccountname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Number</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Number" name="bankaccountnumber" id="bankaccountnumber"
                                                    type="number" value="{{ old('bankaccountnumber') ?? $editseller->bank_acc_no ?? '' }}" >
                                                <p style="display:none" class="bankaccountnumber error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="name" name="name" id="name"
                                                        type="text" value="{{ old('name') ?? $editseller->name ?? '' }}" >
                                                    <p style="display:none" class="name error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                                    type="email" value="{{ old('email') ?? $editseller->email ?? '' }}" >
                                                <p style="display:none" class="email error text-danger"></p>
                                            </div>
                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                                        type="password"  autocomplete="new-password" value="{{ $editseller->password ?? '' }}">
                                                    <p style="display:none" class="password error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                                        type="password" value="{{ $editseller->password ?? '' }}">
                                                    <p style="display:none" class="password_confirmation  error text-danger"></p>
                                                </div>
                                        </div>

                                        <button type="submit" class="btn btn-animation ms-auto fw-bold"> <i class="fa fa-edit" aria-hidden="true"></i>
                                            {{ __('auth.dochange') }}</button>
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

    </x-auth-layout>




