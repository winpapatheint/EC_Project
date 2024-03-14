<x-auth-layout>

    <div class="page-body">
        <!-- All User Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>All SubCategory</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{ route('admin.all.addsubcategory') }}"
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
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Category Name</th>
                                                    <th>SubCategory Name</th>
                                    
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>                                          
                                                    <td>11</td>
                                                    <td>2022-12-26 15:23</td>
                                                    <td>buscuit</td>
                                                    <td>Aata Buscuit</td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>coffee</td>  
                                                    <td>Cold Brew Coffee</td>                                             
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>cookies</td>  
                                                    <td>Peanut Butter Cookies</td>                                          
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>flakes</td>
                                                    <td>Wheet Flakes</td>
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>chips</td>
                                                    <td>Potato Chips</td>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>dal</td>
                                                    <td>Tuwer Dal</td>
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>milk</td>
                                                    <td>Almond Milk</td>
                                                 
                                                 
                                                 
                                                 
                                                 
                                                 

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>bread</td>
                                                    <td>Wheat Bread</td>
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>dog Food</td>
                                                    <td>Dog Food</td>
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>meat</td>
                                                    <td>Fresh Meat</td>
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   

                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
                                                    <td>coffee</td>
                                                    <td>Classic Coffee</td>
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('admin.edit.subcategory') }}">
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
        <!-- All User Table Ends-->
    </div>

</x-auth-layout>