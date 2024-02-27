@extends('layouts.admin')
@section('title', 'Edit Gamification Type')
@section('card_name', 'Edit Gamification Type')

@section('action')
    <a href="{{route('gamification-type.index')}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route("gamification-type.update",$gamificationType->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group col-md-6 mb-2 {{ $errors->has('type_en') ? ' error' : '' }}">
                                <label for="type_en" class="required">Type (EN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Type is required"
                                    data-validation-regex-message="Type must start with alphabets"
                                    data-validation-maxlength-message="Type can not be more then 200 Characters"
                                    value="{{old('type_en')?old('type_en'):$gamificationType->type_en}}" required id="type_en"
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
                                    value="{{old('type_bn')?old('type_bn'):$gamificationType->type_bn}}" required id="type_bn"
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
                                                <option value="{{$gamification->id}}" @if(in_array($gamification->id, $gamificationType->trivia_gamification_ids)) selected @endif>{{$gamification->type}} | {{$gamification->rule_name}} |{{$gamification->content_for}} </option>
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
                                    <label for="status_input">Component For: </label>
                                    <select name="content_for" class="browser-default custom-select" required>
                                            <option value="home" @if ($gamificationType->content_for == 'home') selected @endif> Home </option>
                                    </select>
                                    @if ($errors->has('content_for'))
                                        <div class="help-block">  {{ $errors->first('content_for') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$gamificationType->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($gamificationType->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($gamificationType->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <button style="float: right" type="submit" id="submitForm"
                                        class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$gamificationType)
        <h1>
            No Gamification Type Available
        </h1>
    @else

    @endif
@endsection




@push('style')

@endpush

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

@endpush