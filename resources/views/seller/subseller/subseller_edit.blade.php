<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
<!-- New Subseller Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Subseller Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name" value="1" required>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email" value="Takahashi" required>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" name="password" value="********"  id="password" required>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" id="confirm_password" required>
                                            <span id="confirm-password-error" style="color: red;"></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Photo</label>
                                        <div class="col-sm-10">
                                            <input class="form-control form-choose" type="file" id="image" name="photo">
                                            {{-- <img src="#" alt="profile" width="100" id="showImage"> --}}
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Phone</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="string" name="phone" value="08060980220">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Subseller Add End -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).on('submit', 'form', function(event) {
    event.preventDefault();
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
@endsection
