<x-auth-layout>


    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>Products</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 50px">No</th>
                                                <th >Date</th>
                                                <th style="min-width: 200px">Product Image</th>
                                                <th style="min-width: 300px">Product Name</th>
                                                <th style="min-width: 120px">Current Qty</th>
                                                <th style="min-width: 120px">Price<br>(Tax inc)</th>
                                                <th style="min-width: 150px">Commision</th>
                                                <th style="min-width: 150px;">Status</th>
                                                <th>Special Corner</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )
                                                <tr>

                                                    <td  class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                                    <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                    <td data-label="{{ __('auth.image') }}"><img src="{{ asset('upload/product_thambnail/'.($list->product_thambnail)   ) }}" alt="thumb" style="width: 50px;"></td>
                                                    <td style="text-align:left; max-width: 200px;" data-label="{{ $list->product_name }}">
                                                        @if(strlen($list->product_name) > 30)
                                                            {!! substr($list->product_name, 0, 30) . '<br>' . substr($list->product_name, 30, 30) . '...' !!}
                                                        @else
                                                            {!! nl2br(e($list->product_name)) !!}
                                                        @endif
                                                    </td>

                                                    <td data-label="">{{ $list->product_qty }}</td>
                                                    <td data-label="">¥{{ number_format($list->selling_price, 0, '', ',') }}</td>
                                                    <td class="col-sm-9">
                                                        {{ $list->commission ? $list->commission . '%' : '' }}
                                                    </td>
                                                    <td class="col-sm-9">
                                                        <label class="switch" style="margin-top: 8px;">
                                                            <input data-width="100" data-id="{{$list->id}}"
                                                            class="toggle-class" type="checkbox"
                                                            data-offstyle="outline-secondary" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive"
                                                            {{ $list->status ? 'checked' : '' }}>
                                                        </label>
                                                    </td>
                                                    <td class="col-sm-9">
                                                        @if($list->special_sub_category_id)
                                                        <button class="btn w-50" style = "background-color: #ff6b6b;margin-left: 30px;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeProfile{{ $list->id }}"
                                                                onclick="showDeleteModal('{{ $list->id }}')"
                                                                onclick="">Remove
                                                        </button>
                                                        @else
                                                        <button class="btn w-50 theme-bg-color" style = "margin-left: 30px;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editAddress{{ $list->id }}"
                                                                onclick="">Add
                                                        </button>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ url("/product/".$list->id ) }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href='{{ url("/editproduct/".$list->id ) }}'>
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--pagination -->
                    @include('components.pagination')

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
        <!-- Delete Modal Box Start -->
            @foreach( $lists as $key => $list )
                <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
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
                                    <p>The permission for the use/group, preview is inherited from the object, object will create a
                                        new permission for this object</p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <form method="POST" action="{{ route('deleteproduct') }}" style="display:flex;">
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
                                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="remove-box text-center">
                                <div class="wrapper">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                    </svg>
                                </div>
                                <h4 class="text-content">It's Removed.</h4>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Delete Modal Box End -->

        <!-- Edit Special Modal Box Start -->
        @foreach($lists as $item)
            <div class="modal fade theme-modal" id="editAddress{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add To Special Corner</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('add_to_special_corner') }}" class="row g-4 theme-form theme-form-2 mega-form">
                                    @csrf
                                    <input type="hidden" name="productId" id="productId" value="{{ $item->id }}">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title w-50">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id" id="category">
                                                <option>Special Corner</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title w-50">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory_{{ $item->id }}">
                                                <option>Choose SubCategoryTitle</option>
                                                @foreach ($subCatTitle as $subCategoryTitle)
                                                    <option value="{{ $subCategoryTitle->id }}">{{ $subCategoryTitle->sub_category_titlename }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title w-50">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname_{{ $item->id }}">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal" id="saveChanges">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Edit Special Modal Box End -->
        <!-- Remove Address Modal Start -->
        @foreach($lists as $item)
            <div class="modal fade theme-modal remove-profile" id="removeProfile{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header d-block text-center">
                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="remove-box">
                                <p>Remove this product from Special Corner?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('remove_from_special_corner', ['id' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                            </form>
                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Remove Address Modal End -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script>
            $(function() {
                $('.toggle-class').change(function() {

                    var status = $(this).prop('checked') ? 1 : 0;

                    var product_id = $(this).data('id');

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('tt') }}",
                        data: {
                            'status': status,
                            'product_id': product_id,
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            alert('2');
                            console.log(data.success);
                        }
                    });
                });
            });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var subcategoryElements = document.querySelectorAll('.get_sub');
                    subcategoryElements.forEach(function(element) {
                        element.addEventListener('change', function() {
                            var subcategoryTitleId = this.value;
                            var itemId = this.id.split('_')[1];
                            var subcategorySelect = document.getElementById('subname_' + itemId);
                            subcategorySelect.innerHTML = '<option value="">Choose SubCategory</option>';

                            if (!subcategoryTitleId) {
                                return;
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        var subcategories = JSON.parse(xhr.responseText);
                                        subcategories.forEach(function(subcategory) {
                                            var option = document.createElement('option');
                                            option.value = subcategory.id;
                                            option.textContent = subcategory.sub_category_name;
                                            subcategorySelect.appendChild(option);
                                        });
                                    } else {
                                        console.error('Failed to fetch subcategories');
                                    }
                                }
                            };
                            xhr.open('GET', '/get-subcategories-by-title/' + subcategoryTitleId);
                            xhr.send();
                        });
                    });
                });
            </script>
</x-auth-layout>
