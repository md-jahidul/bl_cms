@extends('layouts.admin')
@section('title', 'Prize Create')
@section('card_name', 'Prize Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('prizes') }}">Prize List</a></li>
    <li class="breadcrumb-item active"> Prize Create</li>
@endsection
@section('action')
    <a href="{{ url('prizes') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('prizes.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title"  class="form-control" placeholder="Enter title"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter prizes title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('campaign_id') ? ' error' : '' }}">
                                    <label class="required">Campaign</label>
                                    <select class="form-control error" name="campaign_id" data-validation-required-message="Select campaign">
                                        <option value="">--Select campaign type--</option>
                                        @if(isset($campaigns))
                                            @foreach ($campaigns as $campaign)
                                                <option value="{{$campaign->id}}" {{ old('campaign_id')== $campaign->id ? 'selected' : ''}}>{{$campaign->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('campaign_id'))
                                        <div class="help-block">  {{ $errors->first('campaign_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">Product</label>
                                        <input type="number" id="product_id" name="product_id" class="form-control" placeholder="Enter Product">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" id="position" name="position" class="form-control" placeholder="Enter Product">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reword">Reword</label>
                                        <input type="text" id="reword" name="reword" class="form-control" placeholder="Enter reword">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="validity">Validity</label>
                                        <input type="text" id="validity" name="validity" class="form-control" placeholder="Enter validity">
                                    </div>
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @csrf
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







