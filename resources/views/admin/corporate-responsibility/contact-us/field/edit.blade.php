@extends('layouts.admin')
@section('input_label_en', 'Contact Us Field Edit')
@section('card_name', 'Contact Us Field Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('contact-us-field.index', $sectionId) }}">Field List</a></li>
    <li class="breadcrumb-item active"> Field Edit</li>
@endsection
@section('action')
    <a href="{{ route('contact-us-field.index', $sectionId) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('contact-us-field.update', [$sectionId, $field->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('input_label_en') ? ' error' : '' }}">
                                    <label for="input_label_en" class="required">Field Title English</label>
                                    <input type="text" name="input_label_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ $field->input_label_en }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('input_label_en'))
                                        <div class="help-block">  {{ $errors->first('input_label_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('input_label_bn') ? ' error' : '' }}">
                                    <label for="input_label_bn" class="required">Field Title Bangla</label>
                                    <input type="text" name="input_label_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ $field->input_label_en }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('input_label_bn'))
                                        <div class="help-block">  {{ $errors->first('input_label_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Field Type:</label>
                                        <input type="radio" name="type" value="input" id="input" {{ $field->type == "input" ? 'checked' : '' }}>
                                        <label for="input" class="mr-1">Input</label>
                                        <input type="radio" name="type" value="textarea" id="textarea" {{ $field->type == "textarea" ? 'checked' : '' }}>
                                        <label for="textarea">Textarea</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $field->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive" {{ $field->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Update
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






