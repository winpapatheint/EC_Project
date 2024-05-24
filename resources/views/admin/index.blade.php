<x-auth-layout>
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
                                    <h4 class="mb-0 counter">¥{{number_format($revenue) }}</h4>
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
                                    <h4 class="mb-0 counter">{{ $orderCount }}</h4>
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
                                    <h4 class="mb-0 counter">{{ $product }}
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
                                    <h4 class="mb-0 counter">{{ $pending }}</h4>
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
                                                <th>Seller Name</th>
                                                <th>Products</th>
                                                <th>Order details</th>
                                                <th>Commission</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($transfer->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                            {{-- @foreach ($transfer as $key => $item )
                                                <tr>
                                                    <td>{{ ($ttl+1) - ($transfer->firstItem() + $key) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                    <td>Bank</td>
                                                    <td>Asia 食材</td>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->product->product_code }}</td>
                                                    <td>{{ strlen($item->product->product_name) > 20 ? substr($item->product->product_name, 0, 20) . '...' : $item->product->product_name }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>￥{{ $item->price }}</td>
                                                    <td>￥{{ $item->amount }}</td>
                                                </tr>
                                            @endforeach --}}
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('components.pagination')
                </div>
                <!-- Booking history  end-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <!-- index body end -->


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script type="text/javascript">

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

    </script> --}}
    <script>

    // Define labels for each month
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Sample data for demonstration
const salesData = [1000, 1500, 1200, 1800, 2000, 2200, 2500, 2300, 2400, 2100, 1900, 1600];

// Render the chart
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Sales',
            data: salesData,
            backgroundColor: '#0da487',
              borderColor: '#0da487',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }

});

</script>
    </x-auth-layout>
