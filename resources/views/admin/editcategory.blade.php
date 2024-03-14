<x-auth-layout>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

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

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="Category Name">
                                        </div>
                                    </div>
                                    <div class="mb-4 row align-items-center">
                                        <div class="col-sm-3 form-label-title ">Select Icon</div>
                                            <div class="col-sm-9">
                                                <div class="dropdown icon-dropdown">
                                                    <button class="btn dropdown-toggle" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown">
                                                            Select Icon
                                                    </button>
                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <img src="{{ asset('frontend/assets/svg/1/vegetable.svg') }}"
                                                                        class="img-fluid" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <img src="{{ asset('frontend/assets/svg/1/cup.svg') }}"
                                                                        class="blur-up lazyload" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <img src="{{ asset('frontend/assets/svg/1/meats.svg') }}"
                                                                        class="img-fluid" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <img src="{{ asset('frontend/assets/svg/1/breakfast.svg') }}"
                                                                        class="img-fluid" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <img src="{{ asset('frontend/assets/svg/1/frozen.svg') }}"
                                                                        class="img-fluid" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                   <a class="dropdown-item" href="#">
                                       <img src="{{ asset('frontend/assets/svg/1/biscuit.svg') }}"
                                           class="img-fluid" alt="">
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item" href="#">
                                       <img src="{{ asset('frontend/assets/svg/1/grocery.svg') }}"
                                           class="img-fluid" alt="">
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item" href="#">
                                       <img src="{{ asset('frontend/assets/svg/1/drink.svg') }}"
                                           class="img-fluid" alt="">
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item" href="#">
                                       <img src="{{ asset('frontend/assets/svg/1/milk.svg') }}"
                                           class="img-fluid" alt="">
                                   </a>
                               </li>
                               <li>
                                   <a class="dropdown-item" href="#">
                                       <img src="{{ asset('frontend/assets/svg/1/pet.svg') }}"
                                           class="img-fluid" alt="">
                                   </a>
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>
           </div>
 
                                    <button type="submit" class="btn btn-animation ms-auto fw-bold">Update</button>
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

</x-auth-layout>








































