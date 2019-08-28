@extends('layouts.admin')
@section('title', 'Campaign Create')
@section('card_name', 'Campaign Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('campaigns') }}"> Campaign List</a></li>
    <li class="breadcrumb-item active"> Campaign Create</li>
@endsection
@section('action')
    <a href="{{ url('campaigns') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("campaigns/$campaign->id") }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title"  class="form-control" placeholder="Enter title"
                                           value="{{ $campaign->title }}" required data-validation-required-message="Enter campaign title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Start Data</label>
                                    <input type="date" name="start_date"  class="form-control"
                                           value="{{ $campaign->start_date }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">  {{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date" class="required">End Date</label>
                                    <input type="date" name="end_date"  class="form-control" placeholder="Enter title"
                                           value="{{ $campaign->end_date }}" required data-validation-required-message="Please select end date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">  {{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Motivational Quote</label>
                                        <textarea name="motivational_quote" class="form-control" rows="5"
                                                  placeholder="Enter motivational quote">{{ $campaign->motivational_quote }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_enable" value="1" id="input-radio-15" @if ($campaign->is_enable == '1') checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_enable" value="0" id="input-radio-16" @if ($campaign->is_enable == '0') checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            {{method_field('PUT')}}
                        </form>
                    </div>


                    </form>
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








