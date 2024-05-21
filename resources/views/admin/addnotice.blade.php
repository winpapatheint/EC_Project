
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
                                    @php $action= route('noticeall'); @endphp

                                    <form action="{{ route('noticeall') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="from" value="notice">
                                        <div class="row">

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="form-label-title col-lg-2 col-md-3 mb-0">Subject</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text" name="title" id="title">
                                                <p style="display:none" class="title error text-danger"></p>
                                                @if (!empty($error['title']))
                                                    @foreach ($error['title'] as  $key => $value)
                                                        <p class="title error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="file" name="image" onchange="mainThamUrl(this)">
                                                <img src="" id="mainThmb">
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <label
                                                class="col-lg-2 col-md-3 col-form-label form-label-title">Body
                                                </label>
                                            <div class="col-md-9 col-lg-10">
                                                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                                                <p style="display:none" class="message error text-danger"></p>
                                                @if (!empty($error['message']))
                                                    @foreach ($error['message'] as  $key => $value)
                                                        <p class="message error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-submit btn-animation" type="submit">Send</button>
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

      if ($.trim($("#title").val()) === "" ||  $.trim($("#message").val()) === ""    )  {

         if ($.trim($("#title").val()) === "") {
              $('.error.title').text('Title is required')
              $('.error.title').show()
         }

         if ($.trim($("#message").val()) === "") {
              $('.error.message').text('Message is required')
              $('.error.message').show()
         }

         if ($.trim($("#selleremail").val()) === "0") {
              $('.error.selleremail').text('Choose email')
              $('.error.selleremail').show()
         }



         return false;
      } else {

        $('.error').hide()
    $('#confirmModal').modal('show');

}

   });
        </script>




</x-auth-layout>

