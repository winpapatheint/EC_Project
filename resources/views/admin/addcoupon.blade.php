
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                                        <h5>Coupon Information</h5>
                                    </div>
                                    @php $action= route('registercoupon'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registercoupon" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Coupon Name" name="title" id="title"
                                                        value="{{ old('title') ?? $data->name ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Coupon Code</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Coupon Code" name="code" id="code"
                                                        value="{{ old('code') ?? $data->coupon_code ?? '' }}">
                                                    <p style="display:none" class="code error text-danger"></p>
                                                        @if (!empty($error['code']))
                                                            @foreach ($error['code'] as  $key => $value)
                                                                <p class="code error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>


                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Discount Amount</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Discount Amount" name="disamount" id="disamount"
                                                        value="{{ old('disamount') ?? $data->discount_amount ?? '' }}">
                                                    <p style="display:none" class="disamount error text-danger"></p>
                                                        @if (!empty($error['disamount']))
                                                            @foreach ($error['disamount'] as  $key => $value)
                                                                <p class="disamount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Minimum Amount</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Minimum Amount" name="miniamount" id="miniamount"
                                                        value="{{ old('miniamount') ?? $data->mini_amount ?? '' }}">
                                                    <p style="display:none" class="miniamount error text-danger"></p>
                                                        @if (!empty($error['miniamount']))
                                                            @foreach ($error['miniamount'] as  $key => $value)
                                                                <p class="miniamount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>


                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Valid Count</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Valid Count" name="validcount" id="validcount"
                                                        value="{{ old('validcount') ?? $data->valid_count ?? '' }}">
                                                    <p style="display:none" class="validcount error text-danger"></p>
                                                        @if (!empty($error['validcount']))
                                                            @foreach ($error['validcount'] as  $key => $value)
                                                                <p class="validcount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0" for="startdate">Start Date</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="datetime-local" placeholder="Start Date" name="startdate"
                                                    id="startdate" value="{{ !empty($data->startdate) ? date('Y-m-d\TH:i', strtotime($data->startdate)) : '' }}">
                                                    <p style="display:none" class="startdate error text-danger"></p>
                                                    @if (!empty($error['startdate']))
                                                        @foreach ($error['startdate'] as $key => $value)
                                                            <p class="startdate error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">End Date</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="datetime-local" placeholder="End Date" name="enddate"
                                                    id="enddate" step="1" min="2000-01-01T00:00:00" max="2099-12-31T23:59:59" value="{{ old('enddate') ?? $data->enddate ?? '' }}">
                                                    <p style="display:none" class="endate error text-danger"></p>
                                                    @if (!empty($error['enddate']))
                                                        @foreach ($error['enddate'] as $key => $value)
                                                            <p class="enddate error text-danger">{{ $value }}</p>
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

