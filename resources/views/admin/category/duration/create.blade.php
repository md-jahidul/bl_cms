@extends('layouts.admin')
@section('title', 'Duration Category Create')
@section('card_name', 'Duration Category Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('duration-categories') }}">Duration Categories List</a></li>
    <li class="breadcrumb-item active"> Duration Create</li>
@endsection
@section('action')
    <a href="{{ url('duration-categories') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('duration-categories.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en" class="required">Duration title (English)</label>
                                    <input type="text" name="name_en"  class="form-control" placeholder="Enter duration title in english"
                                           value="{{ old("name_en") ? old("name_en") : '' }}" required data-validation-required-message="Enter duration title in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn" class="required">Duration title (Bangla)</label>
                                    <input type="text" name="name_bn"  class="form-control" placeholder="Enter duration title in bangla"
                                           value="{{ old("name_bn") ? old("name_bn") : '' }}" required data-validation-required-message="Enter duration title in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('days') ? ' error' : '' }}">
                                    <label for="days" class="required">Validity Unit</label>
                                    <input type="number" name="days" class="form-control" placeholder="Enter days"
                                           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                                           value="{{ old("days") ? old("days") : '' }}" required data-validation-required-message="Enter days">
                                    <div class="help-block"></div>
                                    @if ($errors->has('days'))
                                        <div class="help-block">  {{ $errors->first('days') }}</div>
                                    @endif
                                </div>
                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
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






