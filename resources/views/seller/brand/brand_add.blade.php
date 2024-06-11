@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Brand Information</h5>
                                </div>
                                <form id="myForm" method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="theme-form theme-form-2 mega-form">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Brand Name</label>
                                            <div class="col-sm-9 form-group">
                                                <input class="form-control" type="text" id="brand_name" placeholder="Brand Name" name="brand_name">
                                                <p class="error" style="color:red" id="error-brand_name"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Brand Image</label>
                                            <div class="form-group col-sm-9">
                                                <input class="form-control" type="file" id="image" name="brand_icon">
                                                <img width="100" id="showImage">
                                                <p class="error" style="color:red" id="error-image"></p>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-block">
                                            <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimModal">Save</button>
                                        </div>

                                        <!-- Confirm Modal Box -->
                                        <div class="modal fade theme-modal remove-coupon" id="confirmModal" aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="remove-box">
                                                            <p>The data will be added permanently.</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-animation" >Yes</button>
                                                        <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal"
                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Confirm Modal Box End-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
</script>

<script>
    $('.btn-submit').click(function() {
    $('.error').hide();

    let name = $.trim($("#brand_name").val());
    let image = $("#image")[0].files[0];
    let isValid = true;

    if (!name) {
        $('#error-brand_name').text('Please provide brand name.').show();
        isValid = false;
    } else if (name.length > 255) {
        $('#error-brand_name').text('Brand name must not exceed 255 characters.').show();
        isValid = false;
    }

    if (!image) {
        $('#error-image').text('Please provide brand image.').show();
        isValid = false;
    } else if (image.size > 2 * 1024) {
        $('#error-image').text('Product image must not exceed 1MB.').show();
        isValid = false;
    }

    if (isValid) {
        $('#confirmModal').modal('show');
    }

    return false;
    });
</script>

@endsection
