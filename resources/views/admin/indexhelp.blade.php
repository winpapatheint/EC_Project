<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<x-auth-layout>
<!-- Create Coupon Table start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title d-sm-flex d-block">
                                    <h5>Contact</h5>
                                    <div class="right-options">
                                        <ul>
                                            <li>
                                                <a class="btn btn-solid" href="{{ route('notice') }}">Contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-section-box">
                                    <ul class="nav nav-tabs custom-nav right-options" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button" role="tab"><i class="icon-cloud-down">Inbox</i></button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                                data-bs-target="#info" type="button" role="tab"><i class="icon-cloud-up">Sent</i></button>
                                        </li>

                                    </ul>

                                    <div class="tab-content custom-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            <div class="table-responsive category-table">
                                                <table class="table all-package theme-table" id="table_id">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Name</th>
                                                            <th>Reason</th>
                                                            <th>Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($helps->isEmpty())
                                                            <tr>
                                                                <td colspan="9">No data available</td>
                                                            </tr>
                                                        @else
                                                        @foreach ($helps as $item)
                                                            <tr>
                                                                <td>{{ $item->title }}</td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ strlen($item->reason) > 50 ? substr($item->reason, 0, 50) . '...' : $item->reason }}</td>
                                                                <td>{{ $item->created_at->toDateString() }}</td>
                                                                <td>
                                                                    <ul>
                                                                        <li>
                                                                            <a href="{{ route('help.detail',$item->id) }}">
                                                                                <i class="fa-solid fa-reply"></i>
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

                                        <div class="tab-pane fade" id="info" role="tabpanel">
                                            <div class="table-responsive category-table">
                                                <table class="table all-package theme-table" id="table_id">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Name</th>
                                                            <th>Reason</th>
                                                            <th>Date</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($helps->isEmpty())
                                                            <tr>
                                                                <td colspan="9">No data available</td>
                                                            </tr>
                                                        @else
                                                        @foreach ($lists as $key => $item)
                                                            <tr>
                                                                <td>{{ $item->title }}</td>
                                                                <td>{{ $item->user->name }}</td>
                                                                <td>{{ strlen($item->reason) > 50 ? substr($item->reason, 0, 50) . '...' : $item->reason }}</td>
                                                                <td>{{ $item->created_at->toDateString() }}</td>
                                                                <td>
                                                                    <ul>
                                                                        <li>
                                                                            <a href="{{ route('help.detail',$item->id) }}">
                                                                                <i class="fa-solid fa-reply"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Create Coupon Table End -->
</x-auth-layout>
