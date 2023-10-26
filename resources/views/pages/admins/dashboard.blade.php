@extends('layouts.appAdmin')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0 font-weight-bold">Muhamad Ghandi Nur Setiawan</h3>
                <p>Terakhir Login : 21 jam yang lalu</p>
            </div>
            <div class="col-sm-6">
                <div class="d-flex align-items-center justify-content-md-end">
                    <div class="mb-3 mb-xl-0 pr-1">
                        <div class="dropdown">
                            <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border mr-2" type="button"
                                id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="typcn typcn-calendar-outline mr-2"></i>Last 7 days
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3"
                                data-x-placement="top-start">
                                <h6 class="dropdown-header">Last 14 days</h6>
                                <a class="dropdown-item" href="#">Last 21 days</a>
                                <a class="dropdown-item" href="#">Last 28 days</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">TeckMarket Analytics</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="d-sm-flex justify-content-between">
                                    <div class="dropdown">
                                        <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text pl-0"
                                            type="button" id="dropdownMenuSizeButton4" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Mon,1 Oct 2019 - Tue,2 Oct 2019
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton4"
                                            data-x-placement="top-start">
                                            <h6 class="dropdown-header">Mon,17 Oct 2019 - Tue,25 Oct 2019
                                            </h6>
                                            <a class="dropdown-item" href="#">Tue,18 Oct 2019 -
                                                Wed,26 Oct 2019</a>
                                            <a class="dropdown-item" href="#">Wed,19 Oct 2019 -
                                                Thu,26 Oct 2019</a>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-light mr-2">Day</button>
                                        <button type="button" class="btn btn-sm btn-light mr-2">Week</button>
                                        <button type="button" class="btn btn-sm btn-light">Month</button>
                                    </div>
                                </div>
                                <div class="chart-container mt-4" style="text-align: center">
                                    <img src="images/pie-chart.png" alt="logo" class="chart-analiytics"
                                        style="width: 40%; height: auto;">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="text-success font-weight-bold">Total Pembelian User</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Current</div>
                                        <div class="text-muted">38.34M</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Average</div>
                                        <div class="text-muted">38.34M</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Maximum</div>
                                        <div class="text-muted">68.14M</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-4">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="text-success font-weight-bold">Total Pengadaan TeckMarket</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Current</div>
                                        <div class="text-muted">458.77M</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class "font-weight-medium">Average</div>
                                        <div class="text-muted">1.45K</div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="font-weight-medium">Maximum</div>
                                        <div class="text-muted">15.50K</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Pegawai Analytics</h4>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="font-weight-medium">Nama</div>
                                            <div class="font-weight-medium">Bulan</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Damar
                                            </div>
                                            <div class="small">$ 4909</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Andi
                                            </div>
                                            <div class="small">$857</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Akhsan
                                            </div>
                                            <div class="small">$612 </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Fairnanda
                                            </div>
                                            <div class="small">$233</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Yahya</div>
                                            <div class="small">$233</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Rizki</div>
                                            <div class="small">$35</div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <div class="text-secondary font-weight-medium">Rifqi
                                            </div>
                                            <div class="small">$43</div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="text-secondary font-weight-medium">Rafi
                                            </div>
                                            <div class="small">$43</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Penjualan Analytics</h4>
                            <button type="button" class="btn btn-sm btn-light">Month</button>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-md-flex mb-4">
                                    <div class="mr-md-5 mb-4">
                                        <h5 class="mb-1"><i class="typcn typcn-globe-outline mr-1"></i>Online</h5>
                                        <h2 class="text-primary mb-1 font-weight-bold">23,342</h2>
                                    </div>
                                    <div class="mr-md-5 mb-4">
                                        <h5 class="mb-1"><i class="typcn typcn-archive mr-1"></i>Offline
                                        </h5>
                                        <h2 class="text-secondary mb-1 font-weight-bold">13,221</h2>
                                    </div>
                                    <div class="mr-md-5 mb-4">
                                        <h5 class="mb-1"><i class="typcn typcn-tags mr-1"></i>Marketing
                                        </h5>
                                        <h2 class="text-warning mb-1 font-weight-bold">1,542</h2>
                                    </div>
                                </div>
                                <div class="chart-container mt-4" style="text-align: center">
                                    <img src="images/chart-batang.png" alt="logo" class="chart-analiytics-batang"
                                        style="width: 100%; height: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Penjualan Analysis Trend</h4>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between">
                                <small>MotherBoard</small>
                                <small>155.5%</small>
                            </div>
                            <div class="progress progress-md  mt-2">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 80%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <small>Ram Series 3000</small>
                                <small>238.2%</small>
                            </div>
                            <div class="progress progress-md  mt-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="mt-4 mb-5">
                            <div class="d-flex justify-content-between">
                                <small>Ram Series 4500</small>
                                <small>23.30%</small>
                            </div>
                            <div class="progress progress-md mt-2">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <canvas id="salesTopChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
