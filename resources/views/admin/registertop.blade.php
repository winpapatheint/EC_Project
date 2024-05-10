<x-auth-layout>


    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                        <h5>Edit Top page</h5>
                                    </div>
                                    @php $action= route('registertop'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="registertop" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf

                                        @if ($editmode)
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        @endif

                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Discount</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="discount" name="discount" id="phaseone"
                                                    value="{{ old('discount') ?? $data->discount ?? '' }}" disabled>
                                                <p style="display:none" class="discount error text-danger"></p>
                                                    @if (!empty($error['discount']))
                                                        @foreach ($error['discount'] as  $key => $value)
                                                            <p class="discount error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase one</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Blog Name" name="phaseone" id="phaseone"
                                                    value="{{ old('phaseone') ?? $data->phaseone ?? '' }}">
                                                <p style="display:none" class="phaseone error text-danger"></p>
                                                    @if (!empty($error['phaseone']))
                                                        @foreach ($error['phaseone'] as  $key => $value)
                                                            <p class="phaseone error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        @if(!empty($data->phasetwo))
                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase two</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Blog Name" name="phasetwo" id="phasetwo"
                                                    value="{{ old('phasetwo') ?? $data->phasetwo ?? '' }}">
                                                <p style="display:none" class="phasetwo error text-danger"></p>
                                                    @if (!empty($error['phasetwo']))
                                                        @foreach ($error['phasetwo'] as  $key => $value)
                                                            <p class="phasetwo error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($data->phasethree))
                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase three</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Blog Name" name="phasethree" id="phasethree"
                                                    value="{{ old('phasethree') ?? $data->phasethree ?? '' }}">
                                                <p style="display:none" class="phasethree error text-danger"></p>
                                                    @if (!empty($error['phasethree']))
                                                        @foreach ($error['phasethree'] as  $key => $value)
                                                            <p class="phasethree error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Select Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="image" class="form-control" >
                                                <img id="preview-image-before-upload" alt="your image"
                                                    @if(!empty($data->image))
                                                        src="{{ asset('frontend/assets/images/homepage/'.($data->image ?? 'blog/blog-details.jpg')   ) }}"
                                                        style="max-width: 100%;"
                                                    @else
                                                        style="display: none; max-width: 100%;"
                                                    @endif
                                                />
                                                <p style="display:none" class="image error text-danger"></p>
                                                    @if (!empty($error['image']))
                                                        @foreach ($error['image'] as  $key => $value)
                                                            <p class="image error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        <button class="btn btn-submit btn-animation ms-auto fw-bold" type="submit">
                                            @if (!$editmode)
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                {{ __('auth.doregister') }}
                                            @else
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                {{ __('auth.yeschange') }}
                                            @endif
                                        </button>

                                        <div class="modal fade theme-modal remove-coupon" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="remove-box">
                                                            <p></p>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-animation btn-md fw-bold me-2">
                                                            @if (!$editmode)
                                                                登録する
                                                            @else
                                                                Yes
                                                            @endif
                                                        </button>
                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                                    </div>

                                                </div>
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
    <script>
        $(".btn-submit").click(function(e){

            e.preventDefault();
                var _token = $("input[name='_token']").val();
                let formData = new FormData(registertop);

                $.ajax({
                    url: "{{ $action }}",
                    type:'POST',
                    data: formData,
                    contentType: false,
                    processData: false,

                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                        // alert("success");
                            console.log(data.success);
                            $('.error').hide()
                            $('#confirmModal').modal('show');
                        }else{
                            // alert("err");
                            console.log(data.error);
                            $('.error').hide()
                            $.each( data.error, function( key, value ) {
                                if (key == 'password') {
                                    $.each( value, function( k, val ) {
                                        if (val == 'パスワードが一致しません') {
                                            $('.error.password_confirmation').text(val)
                                            $('.error.password_confirmation').show()
                                            // alert('unset')
                                        } else {
                                            $('.error.'+key).text(val)
                                            $('.error.'+key).show()
                                        }
                                    });
                                } else {

                                    $('.error.'+key).text(value[0])
                                    $('.error.'+key).show()
                                }
                            });
                        }
                    },
                    fail: function(data) {
                        alert("エラー：ajax error");
                    }
                });

            });

        </script>

    </x-auth-layout>
