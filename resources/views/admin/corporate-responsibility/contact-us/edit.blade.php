@extends('layouts.admin')
@section('title', 'Customer Feedback Create Question')
@section('card_name', ' Create Question')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('contact-us-page-info.index') }}">Page List</a></li>
    <li class="breadcrumb-item active"> Edit</li>
@endsection
@section('action')
    <a href="{{ route('contact-us-page-info.index') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('contact-us-page-info.update', $contactPage->id) }}" method="POST" novalidate>
                            @method('put')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('component_title_en') ? ' error' : '' }}">
                                    <label for="title" class="required">Component Title (EN)</label>
                                    <input type="text" name="component_title_en"  class="form-control" placeholder="Enter question (EN)"
                                           value="{{ $contactPage->component_title_en }}" required data-validation-required-message="Enter title (EN)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('component_title_en'))
                                        <div class="help-block">  {{ $errors->first('component_title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('component_title_bn') ? ' error' : '' }}">
                                    <label for="title" class="required">Component Title  (BN)</label>
                                    <input type="text" name="component_title_bn"  class="form-control" placeholder="Enter question (BN)"
                                           value="{{ $contactPage->component_title_bn }}" required data-validation-required-message="Enter title (BN)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('component_title_bn'))
                                        <div class="help-block">  {{ $errors->first('component_title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('send_button_en') ? ' error' : '' }}">
                                    <label for="title" class="required">Send Button (EN)</label>
                                    <input type="text" name="send_button_en"  class="form-control" placeholder="Enter question (EN)"
                                           value="{{ $contactPage->send_button_en }}" required data-validation-required-message="Enter title (EN)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('send_button_en'))
                                        <div class="help-block">  {{ $errors->first('send_button_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('send_button_bn') ? ' error' : '' }}">
                                    <label for="title" class="required">Send Button (BN)</label>
                                    <input type="text" name="send_button_bn"  class="form-control" placeholder="Enter question (BN)"
                                           value="{{ $contactPage->send_button_bn }}" required data-validation-required-message="Enter title (BN)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('send_button_bn'))
                                        <div class="help-block">  {{ $errors->first('send_button_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $contactPage->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive" {{ $contactPage->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>



                                <div class="form-actions col-md-12 ">
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

    <style type="text/css">
        .input-group{
            margin-bottom: 10px;
        }
    </style>

@endpush

@push('page-js')

@endpush






