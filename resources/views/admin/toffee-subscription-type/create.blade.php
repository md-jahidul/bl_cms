@extends('layouts.admin')
@section('title', 'Toffee Subscription Type')
@section('card_name',"Toffee Subscription Type" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Toffee Subscription Type</li>
@endsection
@section('action')
    <a href="{{route('toffee-subscription-types.index')}}" class="btn btn-info btn-glow px-2">
        Subscription Types List
    </a>
@endsection

@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-header">
                <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                <div class="heading-elements"></div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">

                    <div class="card-body">
                        <form novalidate class="form row" action="{{route('toffee-subscription-types.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="subscription_type" class="required">Subscription Type:</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Title is required"
                                            data-validation-regex-message="Name must start with alphabets"
                                            data-validation-maxlength-message="Title can not be more then 200 Characters"
                                            value="@if(old('subscription_type')) {{old('subscription_type')}} @endif" required id="subscription_type"
                                            type="text" class="form-control @error('subscription_type') is-invalid @enderror"
                                            placeholder="Title in English" name="subscription_type">
                                        <div class="help-block"></div>
                                        @if ($errors->has('subscription_type'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('subscription_type') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="content_ids" class="">Content Ids</label>
                                        <input class="form-control"
                                            name="content_ids"
                                            id="content_ids"
                                            placeholder="Enter Content Ids with comma-separated value"
                                            required>
                                        @if($errors->has('content_ids'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('content_ids') }}</small>
                                            </p>
                                        @endif
                                        <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Enter Content Ids with comma-separated value</span>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Active Status:</label>
                                            <select class="form-control" id="status"
                                                    name="status">
                                                <option value="1"> Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group col-md-12">
                                        <button style="float: right" type="submit" id="submitForm"
                                                class="btn btn-success round px-2">
                                            <i class="la la-check-square-o"></i> Submit
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
@endsection

@push('style')

@endpush
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    {{--        <script src="{{ asset('theme/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>--}}
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>

        $(function () {

        })
    </script>
@endpush
