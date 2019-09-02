@extends('layouts.admin')
@section('title', 'Footer Child Menu Edit')
@section('card_name', 'Footer Child Menu Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('footer-menu') }}">Footer Child Menu List</a></li>
    <li class="breadcrumb-item active"> Footer Child Menu Edit</li>
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
                        <form role="form" action="{{ url("child-footer/$footerChildMenu->id/update") }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <input type="hidden" name="parent_id" value="{{ $parentId }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter title"
                                           value="{{ $footerChildMenu->name }}" required data-validation-required-message="Enter footer menu title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">English Label</label>
                                    <input type="text" name="en_label_text"  class="form-control" placeholder="Enter english label"
                                           value="{{ $footerChildMenu->en_label_text }}" required data-validation-required-message="Enter footer menu english label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('en_label_text'))
                                        <div class="help-block">  {{ $errors->first('en_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('bn_label_text') ? ' error' : '' }}">
                                    <label for="title" class="required">Bangla Label</label>
                                    <input type="text" name="bn_label_text"  class="form-control" placeholder="Enter bangla label"
                                           value="{{ $footerChildMenu->bn_label_text }}" required data-validation-required-message="Enter footer menu bangla label">
                                    <div class="help-block"></div>
                                    @if ($errors->has('bn_label_text'))
                                        <div class="help-block">  {{ $errors->first('bn_label_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 {{ $errors->has('url') ? ' error' : '' }}">
                                    <label for="url" class="required">URL</label>
                                    <input type="text" name="url"  class="form-control" placeholder="Enter URL"
                                           value="{{ $footerChildMenu->url }}" required data-validation-required-message="Enter footer menu url">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="external_site" class="mr-1">External Site</label>
                                        <input type="checkbox" name="external_site" value="1" id="external_site" @if($footerChildMenu->external_site == 1) {{ 'checked' }} @endif>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="status" value="1" id="input-radio-15" @if($footerChildMenu->status == 1) {{ 'checked' }} @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="input-radio-16" @if($footerChildMenu->status == 0) {{ 'checked' }} @endif>
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






