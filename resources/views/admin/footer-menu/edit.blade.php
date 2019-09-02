@extends('layouts.admin')
@section('title', 'Tag Create')
@section('card_name', 'Footer Menu Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('footer-menu') }}">Footer Menu List</a></li>
    <li class="breadcrumb-item active"> Footer Menu Edit</li>
@endsection
@section('action')
    <a href="{{ url('footer-menu') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("footer-menu/$footerMenu->id") }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter title"
                                           value="{{ $footerMenu->name }}" required data-validation-required-message="Enter footer menu title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($footerMenu->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($footerMenu->status == 0) {{ 'checked' }} @endif>
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
                            @method('PUT')
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






