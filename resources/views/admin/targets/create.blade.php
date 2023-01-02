@extends('layouts.app')

@section('content')
    {{-- <x-header title="Edit Invoice" description="lorem ipsum" /> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Create Target</h6>
            <a href="{{ route('targets.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
        <div class="card-body">
            <form id="formAuthentication" class="mb-3" action="{{ route('targets.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-md-6">
                        <x-input name="amount" label="Target ($)" type="text" placeholder="5000"
                            value="{{ old('amount') }}" />
                    </div>

                    <div class="col-md-6">
                        <x-select name="assign_id" label="Assign To" :collection="$users" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
