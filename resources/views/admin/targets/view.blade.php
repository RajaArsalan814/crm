@extends('layouts.app')


@section('content')
    <!-- Page Heading -->
    {{-- <x-header title="View Client Info" description="lorem ipsum" /> --}}
    <div class="row">
        <div class="col-md-6">
            <!-- DataTales Example -->
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary text-capitalize">Target Detail</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Amount</b></td>
                            <td class="text-capitalize">${{ $target->amount }}</td>
                        </tr>
                        <tr>
                            <td><b>Bounus</b></td>
                            <td>${{ $target->balance }}</td>
                        </tr>
                        <tr>
                            <td><b>Month</b></td>
                            <td>{{ $target->updated_at }}</td>
                        </tr>
                        <tr>
                            <td><b>Last Date</b></td>
                            <td>{{ $target->due_date }}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            @if($target->updated_at < $target->due_date)
                                <td><span class="badge badge-info">In Progress</span></td>
                            @else
                                <td><span class="badge badge-{{ $target->is_achieved == 0 ? 'danger' : 'success'}}">{{ $target->is_achieved == 0 ?  "Not Achieved" : "Achieved"}}</span></td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- @foreach ($target->agentmilestone as $msa) --}}
        <div class="col-md-3 col-sm-6">
            <div class="card shadow">
                <div class="card-body text-center lead text-info">
                    <i class="fa fa-desktop mb-3"></i>
                    <p class="text-black">Milestone Achived</p>

                    <h4>${{ $target->agentmilestone->sum('amount')  }}</h4>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
        {{-- @foreach ($target->milestone->amount as $msr) --}}
        <div class="col-md-3 col-sm-6">
            <div class="card shadow">
                <div class="card-body text-center lead
                {{ $target->agentmilestone->sum('amount') >= $target->amount ? 'text-success' : 'text-danger' }}
                ">
                    <i class="fa fa-desktop mb-3"></i>
                    <p class="text-black">Milestone Remain</p>
                    <h4>${{ $target->agentmilestone->sum('amount') - $target->amount  }}</h4>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}


    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <!-- DataTales Example -->
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Milestones</h6>
                    {{-- <a class="btn btn-success" href="{{ url('milestone/'.$target->id) }}">Excel</a> --}}
                </div>
                <div class="card-body">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th rowspan="1" colspan="1">Date</th>
                                {{-- <th rowspan="1" colspan="1">Action</th> --}}
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Amount</th>
                                <th rowspan="1" colspan="1">Status</th>
                                <th rowspan="1" colspan="1">Date</th>
                                {{-- <th rowspan="1" colspan="1">Action</th> --}}
                            </tr>
                        </tfoot>


                        <tbody>
                            @forelse ($target->agentmilestone as $milestone)
                                <tr>
                                    <td>{{ $milestone->id}}</td>
                                    <td>${{ $milestone->amount }}</td>
                                    <td class="small">{{$milestone->user->name}}<br /> {{$milestone->user->email}}</td>
                                    <td>{{$milestone->updated_at}}</td>
                                    {{-- <td></td> --}}
                                    {{-- <td>
                                        <a href="{{ url('leadstaatus/'.$lead->id.'/'.$lead->payment_status) }}" class="btn btn-{{ $lead->payment_status == '1' ? 'success' : 'danger' }} ">{{ $lead->payment_status == '1' ? 'Paid' : 'UnPaid' }} </a>
                                    </td>
                                    <td>
                                        <a href="{{route('lead.show', $lead->id)}}" class="btn btn-secondary"><i class="fa fa-eye"></i> View</a>
                                    </td> --}}
                                </tr>
                                @empty
                                <tr colspan="5">
                                    <td>No Data Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
