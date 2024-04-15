
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
                                        <h5> 
                                            @if ($editmode)
                                                FAQ修正
                                                @else
                                                FAQ登録
                                            @endif
                                        </h5>
                                    </div>
                                    @php $action= route('registerfaq'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registerfaq" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                                <input type="hidden" name="id" value="{{ $faq->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">FAQ Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="タイトル *" name="title" id="title" value="{{ old('title') ?? $faq->title ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Question</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" placeholder="質問 *" name="que" id="ckeditor" value="{!! str_replace("<p />","&#013;",old('que') ??  $faq->que ?? '')  !!}" >{!! str_replace("<p />","&#013;",old('que') ?? $faq->que ?? '')  !!}</textarea>
                                                    <p style="display:none" class="que error text-danger"></p>
                                                        @if (!empty($error['que']))
                                                            @foreach ($error['que'] as  $key => $value)
                                                                <p class="que error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif

                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Answer</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" placeholder="答え *" name="ans" id="ckeditor" value="{!! str_replace("<p />","&#013;",old('ans') ??  $faq->ans ?? '')  !!}" >{!! str_replace("<p />","&#013;",old('ans') ?? $faq->ans ?? '')  !!}</textarea>
                                                    <p style="display:none" class="ans error text-danger"></p>
                                                        @if (!empty($error['ans']))
                                                            @foreach ($error['ans'] as  $key => $value)
                                                                <p class="que error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif

                                                </div>
                                            </div>

                                            <div class="col-12 text-center max-mb-30">
                                                <button class="btn btn-primary btn-hover-secondary btn-width-180 btn-height-60" type="submit">@if (!$editmode) 登録する @else 修正する @endif</button>
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

</x-auth-layout>








