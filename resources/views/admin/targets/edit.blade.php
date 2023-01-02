@extends('layouts.app')

@section('content')
    {{-- <x-header title="Edit Invoice" description="lorem ipsum" /> --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Edit Target</h6>
            <a href="{{ route('targets.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>
        <div class="card-body">
            <form id="formAuthentication" class="mb-3" action="{{ route('targets.update', $target->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-6">
                        <x-input name="amount" label="Target ($)" type="text" placeholder="5000"
                            value="{{ $target->amount }}" />
                    </div>
                    <div class="col-md-6">
                        <x-select name="assign_id" label="Assign To" :collection="$users" :selected="$target->assign_id" />
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
