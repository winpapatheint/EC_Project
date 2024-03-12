<x-auth-layout>


            <!-- Container-fluid starts-->
            <div class="page-body">
                <!-- All User Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="title-header option-title">
                                        <h5>All SubUsers</h5>
                                        <form class="d-inline-flex">
                                            <a href="{{ route('admin.addsubadmin') }}"
                                                class="align-items-center btn btn-theme d-flex">
                                                <i data-feather="plus-square"></i>Add New
                                            </a>
                                        </form>
                                    </div>

                                    <div class="table-responsive category-table">
                                        <div>
                                            <table class="table all-package theme-table" id="table_id">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Name</th>                                                       
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>2021-12-26</td>
                                                        <td>Everett C. Green</td>
                                                        <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>
                                                        
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-05-21</td>
                                                        <td>Everett C. Green</td>
                                                          <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2021-12-25</td>
                                                        <td>Everett C. Green</td>
                                                         <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Nerima</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-05-10</td>
                                                        <td>Caroline L. Harris</td>
                                                        <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-01-05</td>
                                                        <td>Caroline L. Harris</td>

                                                       <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-08-20</td>
                                                        <td>Caroline L. Harris</td>

                                                          <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Nerima</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-09-11</td>
                                                        <td>Jennifer A. Straight</td>
                                                         <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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

                                                    <tr> <td>4</td>

                                                        <td>2022-09-20</td>
                                                        <td>Wheat Bread</td>

                                                         <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Osaka</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-08-30</td>
                                                        <td>Jennifer A. Straight</td>

                                                         <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }})">
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
                                                        <td>2022-03-30</td>
                                                        <td>Jennifer A. Straight</td>
                                                         <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Nerima</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                                                        <td>2022-02-18</td>
                                                        <td>Jennifer A. Straight</td>
                                                        <td>
                                                           <span>user@....com</span>
                                                        </td>

                                                        <td>Tokyo</td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('admin.subuserdetail') }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('admin.editsubuser') }}">
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
                    </div>
                </div>
                <!-- All User Table Ends-->

                <div class="container-fluid">
</x-auth-layout>