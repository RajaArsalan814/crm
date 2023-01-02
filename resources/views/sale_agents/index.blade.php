@extends('layouts.app')


@section('content')
    {{-- <x-header title="items" description="" /> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Sale Agents List</h6>
            <a href="{{ route('sale_agents.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i>
                Add New</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="th">Id</th>
                            <th class="th">Name</th>
                            <th class="th">Email</th>
                            {{-- <th class="th">Category</th> --}}
                            <th class="th"># Roles</th>
                            {{-- <th class="th">Action</th> --}}
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <tr>
                            <th class="th">Id</th>
                            <th class="th">Name</th>
                            <th class="th">Email</th>
                            {{-- <th class="th">Categroy</th> --}}
                            <th class="th"># Roles</th>
                            {{-- <th class="th">Action</th> --}}
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($sale_agents as $item)
                            <tr>
                                <td>{{ $item->user->id }}</td>
                                <td> {{ $item->user->name ?? 'The model doesn\'t have a `name` attribute' }}</td>
                                <td> {{ $item->user->email ?? 'The model doesn\'t have a `email` attribute' }}</td>
                                {{-- <td>
                                    @foreach ($item->category->pluck('name') as $category)
                                        <span type="button" class="badge badge-info">{{ $category }}</span>
                                    @endforeach
                                </td> --}}
                                <td>
                                        {{ $item->role->name }}
                                    {{-- {{ $item->roles_count }} --}}
                                </td>
                                {{-- <td>
                                        <a href="{{ route('laratrust.roles-assignment.edit', ['roles_assignment' => $item->getKey(), 'model' => $modelKey]) }}"
                                            class="btn btn-primary"><i class="fa fa-pen"></i> Edit</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
