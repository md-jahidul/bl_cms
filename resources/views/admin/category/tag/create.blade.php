@extends('layouts.admin')
@section('title', 'Tag Category Create')
@section('card_name', 'Tag Category Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('tag-category') }}">Tag Categories List</a></li>
    <li class="breadcrumb-item active"> Tag Create</li>
@endsection
@section('action')
    <a href="{{ url('tag-category') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url('tag-category') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter tag name"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter tag name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
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






