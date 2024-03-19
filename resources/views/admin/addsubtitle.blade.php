

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
                                        <h5>SubCategory Title Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                                <div class="col-sm-8">
                                                    <select class="js-example-basic-single w-100" name="state">
                                                        <option disabled>Category Menu</option>
                                                        <option>Electronics</option>
                                                        <option>TV & Appliances</option>
                                                        <option>Home & Furniture</option>
                                                        <option>Another</option>
                                                        <option>Baby & Kids</option>
                                                        <option>Health, Beauty & Perfumes</option>
                                                        <option>Uncategorized</option>
                                                    </select>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Sub Title</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" placeholder="Sub Title" name="players">
                                                    <div class="input-group-append align-self-center mx-auto justify-content-center">
                                                        <a href="#" class="align-items-center d-flex" id="add-more-field">
                                                            <i data-feather="plus-square"></i> Add
                                                        </a>
                                                    </div>
                                                </div>
                                                <div id="dynamic-form"></div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-animation ms-auto fw-bold">Save</button>
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
    // Function to add new input field
    function addInputField() {
        var inputGroup = document.createElement('div');
        inputGroup.classList.add('mb-4', 'row', 'align-items-center');
        inputGroup.innerHTML = `

            <div class="col-sm-8">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Sub Title" name="players">
                    <div class="input-group-append align-self-center mx-auto justify-content-center">
                        <a href="#" class="align-items-center d-flex remove-field">
                            <i data-feather="minus-square"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('dynamic-form').appendChild(inputGroup);
        feather.replace(); // Refresh Feather icons
    }

    // Add event listener to the add button
    document.getElementById('add-more-field').addEventListener('click', function(event) {
        event.preventDefault();
        addInputField();
    });

    // Event delegation to handle remove button click
    document.getElementById('dynamic-form').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-field')) {
            event.preventDefault();
            event.target.closest('.row').remove();
        }
    });
</script>

    </x-auth-layout>









