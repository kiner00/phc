<!-- Content Start -->
<div class="content">
    @livewire('navbar')

    @if(Auth::user()->role == "admin")
        <!-- Sale & Revenue Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today Sale</p>
                            <h6 class="mb-0">Php{{number_format($todaySales)}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Weekly Sale</p>
                            <h6 class="mb-0">Php{{number_format($weeklySales)}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Monthly Sales</p>
                            <h6 class="mb-0">Php{{number_format($monthlySales)}}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2">Monthly P.O. Cost</p>
                            <h6 class="mb-0">Php{{number_format($monthlyPo)}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sale & Revenue End -->

        <!-- Sales Chart Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Today's Sales</h6>
                        </div>
                        <div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
                            <livewire:livewire-column-chart
                                :column-chart-model="$columnChartModel"
                            />
                        </div>
                        {{-- <canvas id="worldwide-sales"></canvas> --}}
                    </div>
                </div>
                <div class="col-sm-12 col-xl-6">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Stocks</h6>
                        </div>
                        <div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
                            <livewire:livewire-column-chart
                                :column-chart-model="$columnChartModelStocks"
                            />
                        </div>
                        {{-- <canvas id="salse-revenue"></canvas> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Sales Chart End -->

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Sales</h6>
                    <a href="/orders">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Platform</th>
                                <th scope="col">Order Number</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Processed By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSaleTable as $recentSale)
                                <tr>
                                    <td>{{$recentSale->platform->platform}}</td>
                                    <td>{{$recentSale->order_number}}</td>
                                    <td>{{$recentSale->full_name}}</td>
                                    <td>Php{{number_format($recentSale->total)}}</td>
                                    <td>{{$recentSale->processedBy->name}}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Recent Sales End -->
    @endif
    @include('footer')
</div>
<!-- Content End -->
