<x-auth-layout>

    <div class="page-body">
        <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>News</h5>
                               <form class="d-inline-flex">
                                            <a href="{{ route('admin.add.blog') }}"
                                                class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add New
                                            </a>
                                        </form>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package theme-table table-product" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>News Name</th>
                                            <th>Image</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>11</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>10</td>
                                            <td>2022-12-26 15:23</td>
                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>9</td>
                                            <td>2022-12-26 15:23</td>
                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>8</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>7</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>6</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>2022-12-26 15:23</td>

                                            <td>Agriculture Conference Harvest 2022 In Paris</td>

                                            <td>
                                                <div class="table-image">
                                                    <img src="{{ asset('backend/assets/images/product/1.png') }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.detail.blog') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.edit.blog') }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!--pagination -->
             <div style="bottom:28px">
                    <nav class="custom-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                    <i class="fa-solid fa-angles-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="javascript:void(0)">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)">
                                    <i class="fa-solid fa-angles-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
 <!-- Delete Modal Box Start -->
 <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle" aria-hidden="true" tabindex="-1">
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
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-target="#exampleModalToggle2"
                    data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

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
</x-auth-layout>
