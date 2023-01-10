@extends('layouts.app')


@section('content')

    {{-- <x-header title="Brands" description="lorem ipsum" /> --}}
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <table class="table table-bordered dataTable" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="1" colspan="1">Sno.</th>
                        <th rowspan="1" colspan="1">First Name</th>
                        <th rowspan="1" colspan="1">Last Name </th>
                        <th rowspan="1" colspan="1">Email</th>
                        <th rowspan="1" colspan="1">Contact</th>
                        <th rowspan="1" colspan="1">Brand</th>
                        <th rowspan="1" colspan="1">Service</th>
                        <th rowspan="1" colspan="1">Social Link</th>
                        <th rowspan="1" colspan="1">Inquiry</th>
                        <th rowspan="1" colspan="1">Added By</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Sno.</th>
                        <th rowspan="1" colspan="1">First Name</th>
                        <th rowspan="1" colspan="1">Last Name </th>
                        <th rowspan="1" colspan="1">Email</th>
                        <th rowspan="1" colspan="1">Contact</th>
                        <th rowspan="1" colspan="1">Brand</th>
                        <th rowspan="1" colspan="1">Service</th>
                        <th rowspan="1" colspan="1">Social Link</th>
                        <th rowspan="1" colspan="1">Inquiry</th>
                        <th rowspan="1" colspan="1">Added By</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($leads as $item)
                        <tr class="odd">
                            <td>{{ $item->id}}</td>
                            <td class="text-capitalize">{{ $item->first_name }}</td>
                            <td class="text-capitalize">{{ $item->last_name }}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->contact}}</td>
                            <td>{{$item->brand}}</td>
                            <td>{{$item->service}}</td>
                            <td>{{$item->social_link}}</td>
                            <td>{{$item->inquiry}}</td>
                            <td>{{$item->users->name}}</td>
                            {{-- <td><a href="{{$item->url}}" target="_blank" class="btn btn-light">{{$item->url}}</a></td>
                            <td><span class="btn small {{ $item->status == '1' ? 'btn-success': 'btn-warning' }}">{{ $item->status == '1' ? 'Active' : 'Deactive'}}</span></td> --}}
                            {{-- <td>
                                <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_{{$item->id}}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </td> --}}
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





@endsection
