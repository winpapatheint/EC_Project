@extends('seller.seller_dashboard')
@section('seller')
@php
    $id = Auth::user()->id;
    $revenue = App\Models\Order::where('seller_id', $id)->sum('amount');
    $order = App\Models\Order::where('seller_id', $id)->get();
    $product = App\Models\Product::where('seller_id', $id)->get();
    $pending = App\Models\Order::where('seller_id', $id)
                           ->where('status', 'Pending')
                           ->get();
@endphp
<!-- index body start -->
 <div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <!-- chart card section start -->
            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                    <div class="custome-1-bg b-r-4 card-body">
                        <div class="media align-items-center static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Revenue</span>
                                <h4 class="mb-0 counter">{{number_format($revenue) }}</h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-database-2-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-2-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Orders</span>
                                <h4 class="mb-0 counter">{{ count($order) }}</h4>
                            </div>
                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                    <div class="custome-3-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Total Products</span>
                                <h4 class="mb-0 counter">{{ count($product) }}
                                    <a href="{{ route('add.product') }}" class="badge badge-light-secondary grow">
                                        ADD NEW</a>
                                </h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-store-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xxl-3 col-lg-6">
                <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                    <div class="custome-4-bg b-r-4 card-body">
                        <div class="media static-top-widget">
                            <div class="media-body p-0">
                                <span class="m-0">Pending Orders</span>
                                <h4 class="mb-0 counter">{{ count($pending) }}</h4>
                            </div>

                            <div class="align-self-center text-center">
                                <i class="ri-shopping-bag-3-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- chart card section End -->

            <!-- Sales / Purchase Return star-->
            <div class="col-12">
                <div class="card o-hidden">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>Sales Graph</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="myChart" height="100px"></canvas>
                    </div>
                </div>
            </div>
            <!-- Sales / Purchase Return end-->

            <!-- Booking history start-->
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0 pb-1">
                        <div class="card-header-title">
                            <h4>Transfer History</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Transfer Id</th>
                                            <th>Name</th>
                                            <th>Order Id</th>
                                            <th>Product Id</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transfer as $key => $item )
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->transaction_id }}</td>
                                                <td>Asia 食材</td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->product_id }}</td>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>￥{{ $item->price }}</td>
                                                <td>￥{{ $item->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{ $transfer->links() }}
            </div>
            <!-- Booking history  end-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- index body end -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

      var labels =  @json($labels);
      var users =  @json($data);

      const data = {
        labels: labels,
        datasets: [{
          label: 'Sale',
          backgroundColor: '#0da487',
          borderColor: '#0da487',
          data: users,
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );

</script>
@endsection
