@extends('layouts.app')

@section('content')
    {{-- <x-header title="Add Clients" description="lorem ipsum" /> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Create Lead</h6>
            <a href="{{ route('clients.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
        <div class="card-body">
            <form id="formAuthentication" class="mb-3" action="{{ route('lead_store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-4">
                        <x-input name="first_name" label="First Name" type="text" placeholder="John" value="{{  old('first_name')  }}"  />
                    </div>
                    <div class="col-md-4">
                        <x-input name="last_name" label="Last Name" type="text" placeholder="Doe" value="{{  old('last_name')  }}" />
                    </div>
                    <div class="col-md-4">
                        <x-input name="email" label="Email Address" type="email" placeholder="john@doe.com" value="{{  old('email')  }}" />
                    </div>
                    <div class="col-md-4">
                        <x-input name="contact" label="Contact Number" type="tel" placeholder="2980909203" value="{{  old('contact')  }}" />
                    </div>
                    <div class="col-md-4">
                        <label for="">Select Brand</label>
                        <select name="brand" id="" class="form-control">
                            <option selected disabled>Select Brand</option>
                            @foreach ($brands as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        {{-- <x-select name="brand" label="Brand" :collection="$brands" /> --}}
                    </div>

                    <div class="col-md-4">
                        <label for="">Select Service</label>
                        <select name="service" id="" class="form-control">
                            <option selected disabled>Select Service</option>
                            @foreach ($services as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        {{-- <x-select name="service" label="Service" :collection="$services" /> --}}
                    </div>
                    <div class="col-md-4">
                        <x-input name="social_link" label="Social Link" type="text" placeholder="Link" value="{{  old('link')  }}" />
                    </div>

                    <div class="col-md-4">
                        <label for="">Inquiry</label>
                        <textarea name="inquiry" id="" cols="20" class="form-control" rows="5"></textarea>
                    </div>


                    {{-- <div class="col-md-4">
                        <x-select name="status" label="Status" :collection="$status"  />
                    </div> --}}
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
