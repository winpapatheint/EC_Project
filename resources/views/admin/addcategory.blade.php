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
                                    <h5>Category Information</h5>
                                </div>
                                @php $action= route('registercategory'); @endphp

                                <form class="theme-form theme-form-2 mega-form" id="registerblog" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @csrf

                                    @if ($editmode)
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    @endif

                                    <div class="mb-4 row  align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Category Name" name="title" id="title"
                                                value="{{ old('title') ?? $data->category_name ?? '' }}">
                                            <p style="display:none" class="title error text-danger"></p>
                                            @if (!empty($error['title']))
                                                @foreach ($error['title'] as  $key => $value)
                                                    <p class="title error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Select Category Icon</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" id="image" class="form-control" >
                                                <img id="preview-image-before-upload" alt="your image"
                                                    @if(!empty($data->category_icon))
                                                        src="{{ asset('images/'.($data->category_icon ?? 'blog/blog-details.jpg')   ) }}"
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
