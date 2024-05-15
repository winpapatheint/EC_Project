
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
                                        <h5>Contact-Us</h5>
                                    </div>

                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block" id="alert-success">
                                            <!-- <button type="button" class="close" data-dismiss="alert">×</button>     -->
                                            <strong>{{ $message }}</strong>
                                        </div>
                                   @endif

                                    @php $error = $errors->toArray(); @endphp
                                    @php $action= route('notice'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="notice" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)

                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif
                                            <input type="hidden" name="from" value="notice">
                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Title</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Title Name" name="title" id="title"
                                                        value="{{ old('title') ?? $data->title ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Message</label>
                                                <div class="col-sm-9 custom-textarea">
                                                    <textarea class="form-control" id="message"
                                                    placeholder="Enter Your Message" rows="6" name="messages"  value="{{ old('message') }}">{{ old('message') }}</textarea>
                                                    <p style="display:none" class="message error text-danger"></p>
                                                    @if (!empty($error['message']))
                                                        @foreach ($error['message'] as  $key => $value)
                                                            <p class="error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                        <input type="hidden" class="message" name="message" id="message" value="{!! old('message') ?? $data->reason ?? '' !!}">

                                                    </div>
                                            </div>

                                            <div class="d-grid gap-2 d-md-block">
                                                <button type="button" class="btn btn-submit btn-animation ">
                                                    @if (!$editmode)
                                                           Send
                                                    @else
                                                           Send
                                                    @endif
                                                </button>
                                            </div>

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
                                                                    Yes
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
        $('.btn-submit').click(function() {

      $('.error').hide()

      if ($.trim($("#title").val()) === "" ||  $.trim($("#message").val()) === "") {

         if ($.trim($("#title").val()) === "") {
              $('.error.title').text('Title is required')
              $('.error.title').show()
         }

         if ($.trim($("#message").val()) === "") {
              $('.error.message').text('Message is required')
              $('.error.message').show()
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

