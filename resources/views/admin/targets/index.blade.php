@extends('layouts.app')

@section('content')

    {{-- <x-header title="Invoice" description="lorem ipsum" /> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Targets List</h6>
            @permission('add-targets')
            <a href="{{ route('targets.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> Create New</a>
            @endpermission
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Target</th>
                            <th>Daily Milestone</th>
                            <th>Bonus</th>
                            <th>Manager</th>
                            <th>Agent</th>
                            {{-- <th>Duration</th> --}}
                            <th>Achieved</th>
                            @if(Auth::user()->hasPermission(['edit-targets','show-targets','sale-target-view']))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Target</th>
                            <th>Daily Milestone</th>
                            <th>Bonus</th>
                            <th>Manager</th>
                            <th>Agent</th>
                            {{-- <th>Duration</th> --}}
                            <th>Achieved</th>
                            @if(Auth::user()->hasPermission(['edit-targets','show-targets','sale-target-view']))
                            <th>Action</th>
                            @endif
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($targets as $target)
                                <tr>
                                    <td>{{ $target->id }}</td>
                                    <td>${{ $target->amount}}</td>
                                    <td>${{ $target->milestone}}</td>
                                    <td>
                                        @if($target->balance > 0)
                                        <span class="badge badge-danger">${{$target->balance}}</span>
                                        @elseif($target->balance == 0)
                                        <span class="badge badge-info">${{$target->balance}}</span>
                                        @else
                                        <span class="badge badge-success">${{$target->balance}}</span>
                                        @endif
                                    </td>
                                    <td class="small">{{ $target->user->name }} <br /> {{ $target->user->email }}</td>
                                    <td class="small">{{ $target->assign->name }} <br /> {{ $target->assign->email }}</td>
                                    @if($target->updated_at < $target->due_date)
                                    <td><span class="badge badge-info">In Progress</span></td>
                                    @else
                                        <td><span class="badge badge-{{ $target->is_achieved == 0 ? 'danger' : 'success'}}">{{ $target->is_achieved == 0 ?  "Not Achieved" : "Achieved"}}</span></td>
                                    @endif
                                    @if(Auth::user()->hasPermission(['edit-targets','show-targets']))
                                    <td>
                                        @permission('edit-targets')
                                            <a href="{{route('targets.edit', $target->id)}}" class="btn btn-primary"><i class="fa fa-pen"></i> Edit</a>
                                        @endpermission
                                        @permission('show-targets')
                                            <a href="{{route('targets.show', $target->id)}}" class="btn btn-dark"><i class="fa fa-eye"></i> View</a>
                                        @endpermission
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
