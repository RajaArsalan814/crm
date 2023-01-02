@extends('layouts.app')

@section('content')
    <div class="container">

        @permission('admin-dashboard')
        <div class="row">
            @foreach ($paidinvoice as $pi)
                <div class="col-md-3 mb-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-2">Sales</h6>
                                    <span class="h2 font-weight-bold mb-0">{{ $pi->currencies->sign . $pi->amount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach ($unpaidinvoice as $upi)
                <div class="col-md-3 mb-3">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-title text-uppercase text-muted mb-2">UnPaid</h6>
                                    <span
                                        class="h2 font-weight-bold mb-0">{{ $upi->currencies->sign . $upi->amount }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Total Leads</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $total_leads }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Total Brands</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $brand }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- rightnow no need of categories at all --}}
            {{-- <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Categroy</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $category }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}


            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Currency</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $currency }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Projects</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $projects }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Leads</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $leads }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Paid Leads</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $paidleads }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">UnPaid Leads</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $unpaidleads }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Sales</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $sales }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Production</h6>
                                <span class="h2 font-weight-bold mb-0">{{ $production }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endpermission

        @permission('client-dashboard')
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Client Projects </h6>
                                <span class="h2 font-weight-bold mb-0">Project Name</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endpermission

        @permission('sales-target')
        {{-- <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Total Projects </h6>
                                <span class="h2 font-weight-bold mb-0"> all sales person manage by sale manager  </span>
                                <span class="h2 font-weight-bold mb-0"> all target manage by sale manager </span>
                                <span class="h2 font-weight-bold mb-0"> target assign to sale agent  </span>
                                <span class="h2 font-weight-bold mb-0"> project send to production manager by sales manager  </span>
                                <span class="h2 font-weight-bold mb-0"> production manager will assign the project the development team  </span>
                                <span class="h2 font-weight-bold mb-0"> development team complete the task and update the status  </span>
                                <span class="h2 font-weight-bold mb-0"> production manager approve the task and inform sale person that task is complete  </span>
                                <span class="h2 font-weight-bold mb-0"> sale person will inform the client or client can also check in their portal   </span>
                                <span class="h2 font-weight-bold mb-0"> if any lead generate it will add by sale agent   </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        @endpermission

        @permission('sales-agent-dashboard')
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h6 class="card-title text-uppercase text-muted mb-2">Sales Agent Dashboard </h6>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endpermission
    </div>
@endsection
