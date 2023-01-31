@extends('layouts.admin')
@section('title', 'Offer Category Create')
@section('card_name', 'Offer Category Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('offer-categories') }}">Offer Categories List</a></li>
    <li class="breadcrumb-item active"><a href="{{ url("offer-categories/$parent_id/$type") }}">{{ ucfirst($type) }} Child Menu List</a></li>
    <li class="breadcrumb-item active"> {{ ucfirst($type) }} Sub Menu Edit</li>
@endsection
@section('action')
    <a href="{{ url("offer-categories/$parent_id/$type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("child-category",[$parent_id, $offer->id]) }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <input type="hidden" name="type" value="{{ $type }}">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Name (English)</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter name in english"
                                           value="{{ $offer->name_en }}" required data-validation-required-message="Enter name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Name (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter name in bangla"
                                           value="{{ $offer->name_bn }}" required data-validation-required-message="Enter name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ ($offer->status == 1) ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ ($offer->status == 0) ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush














