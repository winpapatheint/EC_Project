
<x-auth-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                        <h5>Blog Information</h5>
                                    </div>
                                    @php $action= route('registerblog'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registerblog" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                            @dd($editmode)
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">News Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Blog Name" name="title" id="title"
                                                        value="{{ old('title') ?? $data->title ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
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
                                                <label class="col-sm-3 col-form-label form-label-title">Select Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="image" id="image" class="form-control" >
                                                    <img id="preview-image-before-upload" alt="your image"
                                                        @if(!empty($data->image))
                                                            src="{{ asset('images/'.($data->image ?? 'blog/blog-details.jpg')   ) }}"
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
                                            <button type="button" class="btn btn-submit btn-animation ms-auto fw-bold">
                                                @if (!$editmode)
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                        {{ __('auth.doregister') }}
                                                @else
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                        {{ __('auth.yeschange') }}
                                                @endif
                                            </button>

                                            <div class="modal fade theme-modal remove-coupon" id="confirmModal" tabindex="-1" data-bs-toggle="modal" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
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
                                                            <button type="submit" class="btn btn-submit btn-animation btn-md fw-bold me-2">
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
    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#contents').value = editorData;
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
        $('.btn-submit').click(function() {

      $('.error').hide()
      alert($.trim($("#contents").val()));
      if ($.trim($("#title").val()) === "" || $.trim($("#image").val()) === ""  || $.trim($("#contents").val()) === "") {

         if ($.trim($("#title").val()) === "") {
              $('.error.title').text('title is required')
              $('.error.title').show()
         }

         if ($.trim($("#contents").val()) === "") {
              $('.error.contents').text('Content is required')
              $('.error.contents').show()
         }


         if ($.trim($("#image").val()) === "") {
              $('.error.image').text('image is required')
              $('.error.image').show()
         }
         return false;
      } else {

        $('.error').hide()
    $('#confirmModal').modal('show');

}

   });
        </script>




</x-auth-layout>

