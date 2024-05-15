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
                                <h5>Get in Touch</h5>
                                <form class="d-inline-flex">
                                    <a href="{{ route('admin.addhelp') }}" class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Contact
                                    </a>
                                </form>
                            </div>

                            <div class="table-responsive category-table">
                                <table class="table all-package theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($lists->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                        @foreach ($lists as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td data-label="登録日">{{ date('Y/m/d', strtotime($item->created_at)) }}<br>{{ date('H:i', strtotime($item->created_at)) }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ strlen($item->reason) > 50 ? substr($item->reason, 0, 50) . '...' : $item->reason }}</td>
                                                <td>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('help.detail',$item->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('help.detail',$item->id) }}">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('help.delete',$item->id) }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- All User Table Ends-->
    </div>
    <!-- Container-fluid end -->
    </x-auth-layout>
