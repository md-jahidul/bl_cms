@extends('layouts.admin')
@section('title', 'Add Gamification Type')
@section('card_name',"Add Gamification Type" )
@section('breadcrumb')
    <li class="breadcrumb-item active">Add Gamification Type</li>
@endsection
@section('action')
    <a href="{{route('gamification-type.index')}}" class="btn btn-info btn-glow px-2">
        Gamification Type List
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
                        <form novalidate class="form row" action="{{route('gamification-type.store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('post')
                            <div class="form-group col-12 mb-2 file-repeater">
                                <div class="row mb-1">
                                    <div class="form-group col-md-6 mb-2 {{ $errors->has('type_en') ? ' error' : '' }}">
                                        <label for="type_en" class="required">Type (EN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                            data-validation-required-message="Type is required"
                                            data-validation-regex-message="Type must start with alphabets"
                                            data-validation-maxlength-message="Type can not be more then 200 Characters"
                                            value="@if(old('type_en')) {{old('type_en')}} @endif" required id="type_en"
                                            type="text" class="form-control @error('type_en') is-invalid @enderror"
                                            placeholder="Type in English" name="type_en">
                                        <div class="help-block"></div>
                                        @if ($errors->has('type_en'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('type_en') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-2 {{ $errors->has('type_bn') ? ' error' : '' }}">
                                        <label for="type_bn" class="required">Type (BN):</label>
                                        <input
                                            maxlength="200"
                                            data-validation-required-message="Type is required"
                                            data-validation-maxlength-message="Type can not be more then 200 Characters"
                                            value="@if(old('type_bn')) {{old('type_bn')}} @endif" required id="type_bn"
                                            type="text" class="form-control @error('type_bn') is-invalid @enderror"
                                            placeholder="Type in Bangla" name="type_bn">
                                        <div class="help-block"></div>
                                        @if ($errors->has('type_bn'))
                                            <div class="help-block">
                                                <small class="text-danger"> {{ $errors->first('type_bn') }} </small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('trivia_gamification_ids') ? ' error' : '' }}">
                                            <label for="trivia_gamification_ids" class="required">Gamifications:</label>
                                            <select multiple class="form-control select2" id="trivia_gamification_ids"
                                                    name="trivia_gamification_ids[]">
                                                    @foreach ($gamifications as $gamification)
                                                        <option value="{{$gamification->id}}">{{$gamification->type}} | {{$gamification->rule_name}} |{{$gamification->content_for}} </option>
                                                    @endforeach
                                            </select>
                                            @if ($errors->has('trivia_gamification_ids'))
                                                <div class="help-block">  {{ $errors->first('trivia_gamification_ids') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Content For -->
                                    <div class="col-6">
                                        <div class="form-group {{ $errors->has('content_for') ? ' error' : '' }}">
                                            <label for="content_for">Conponent For: </label>
                                            <select name="content_for" class="browser-default custom-select" required>
                                                    <option value="home"> Home </option>
                                            </select>
                                            @if ($errors->has('content_for'))
                                                <div class="help-block">  {{ $errors->first('content_for') }}</div>
                                            @endif
                                        </div>
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
@endpush
