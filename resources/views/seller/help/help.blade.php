@extends('seller.seller_dashboard')
@section('seller')
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
                                <a href="{{ route('help.add') }}" class="align-items-center btn btn-theme d-flex">
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($helps->isEmpty())
                                        <tr>
                                            <td colspan="9">No data available</td>
                                        </tr>
                                    @else
                                    @foreach ($helps as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->created_at }}</td>
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
@endsection
