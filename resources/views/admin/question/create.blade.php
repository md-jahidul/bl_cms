{{--@extends('layouts.master-layout')--}}


{{--@section('main-content')--}}

    {{--<!-- general form elements -->--}}
    {{--<div class="col-md-6 offset-md-3 pt-5">--}}

        {{--<div class="card card-primary">--}}
            {{--<div class="card-header">--}}
                {{--<h3 class="card-title">Create Question</h3>--}}
            {{--</div>--}}
            {{--<!-- /.card-header -->--}}
            {{--<!-- form start -->--}}
            {{--<form role="form" action="{{ route('questions.store') }}" method="POST">--}}
                {{--@csrf--}}
                {{--<div class="card-body">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="q_name">Question name</label>--}}
                        {{--<input type="text" name="question_text" class="form-control" id="q_name" placeholder="Enter question">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="exampleInputPassword1">Point</label>--}}
                        {{--<input type="number" name="point" class="form-control" id="exampleInputPassword1" placeholder="Enter point">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label>Tag</label>--}}
                        {{--<select class="form-control" name="tag_id">--}}
                            {{--<option>--Select tag--</option>--}}
                            {{--@if(isset($tags))--}}
                                {{--@foreach($tags as $tag)--}}
                                    {{--<option value="{{ $tag->id }}">{{ $tag->title }}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</select>--}}
                    {{--</div>--}}

                    {{--<spen class="text-muted mt-5">Options</spen><spen class="text-muted mt-5 offset-9">Answer</spen>--}}
                    {{--<hr class="mt-1">--}}

                    {{--<div class="form-group row option">--}}
                        {{--<label for="option" class="col-sm-2 control-label options-count">Option - 1</label>--}}
                        {{--<div class="col-sm-8">--}}
                            {{--<input type="text" name="option[]" class="form-control option-1" id="option" placeholder="Enter option">--}}
                        {{--</div>--}}
                         {{--Answer--}}
                        {{--<div class="col-sm-2">--}}
                            {{--<input type="radio" name="answer[]" data-id="option-1" value="1" class="answer">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<button type="button" class="btn-sm btn-success offset-8 create-option"><i class="fa fa-plus"></i> Add more option</button>--}}
                {{--</div>--}}
                {{--<!-- /.card-body -->--}}

                {{--<div class="card-footer">--}}
                    {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}

    {{----}}

{{--@stop--}}

{{--@push('scripts')--}}
    {{--<script>--}}
        {{--$(function () {--}}

            {{--// $(document).on('click', '.answer', function () {--}}
            {{--//     var get_option = $(this).attr('data-id')--}}
            {{--//     var option_value = $('.'+get_option).val();--}}
            {{--//     $(this).val(option_value)--}}
            {{--//     console.log(option_value);--}}
            {{--// })--}}

            {{--var click_count = 1;--}}
            {{--$(document).on('click', '.create-option', function () {--}}

                {{--var option_count = $('.options-count')--}}
                {{--var total_option = option_count.length + 1--}}
                {{--click_count++--}}

                {{--var input = '<label for="option" class="col-sm-2 control-label mt-3 options-count delete-option'+total_option+'">Option - '+total_option+'</label>\n' +--}}
                    {{--' <div class="col-sm-8 mt-3 delete-option'+total_option+'">\n' +--}}
                    {{--'     <input type="text" name="option[]" class="form-control option-'+total_option+'" id="option" placeholder="Enter option">\n' +--}}
                    {{--' </div>\n' +--}}
                    {{--' <div class="col-sm-1 mt-3 delete-option'+total_option+'">\n' +--}}
                    {{--'     <input type="radio" name="answer[]" data-id="option-'+total_option+'" value="'+total_option+'" class="answer" id="answer">\n' +--}}
                    {{--' </div>\n' +--}}
                    {{--' <div class="col-sm-1 mt-3 delete-option'+total_option+'">\n' +--}}
                    {{--'     <button type="button" class="btn-sm btn-danger remove-option delete-option'+total_option+'" data-id='+total_option+'><i data-id='+total_option+' class="fa fa-trash"></i></button>\n' +--}}
                    {{--' </div>';--}}
                {{--$('.option').append(input)--}}
            {{--})--}}

            {{--$(document).on('click', '.remove-option', function (event) {--}}
                {{--var rowId = $(event.target).attr('data-id');--}}
                {{--$('.delete-option'+rowId).remove();--}}
            {{--})--}}
        {{--})--}}
    {{--</script>--}}
{{--@endpush--}}



@extends('layouts.admin')
@section('title', 'Question Create')
@section('card_name', 'Question Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('campaigns') }}"> Question List</a></li>
    <li class="breadcrumb-item active"> Question Create</li>
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
                        <form role="form" action="{{ route('campaigns.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title"  class="form-control" placeholder="Enter title"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter campaign title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Start Data</label>
                                    <input type="date" name="start_date"  class="form-control"
                                           value="{{ old("start_date") ? old("start_date") : '' }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">  {{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
                                    <label for="end_date" class="required">End Date</label>
                                    <input type="date" name="end_date"  class="form-control" placeholder="Enter title"
                                           value="{{ old("end_date") ? old("end_date") : '' }}" required data-validation-required-message="Please select end date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_date'))
                                        <div class="help-block">  {{ $errors->first('end_date') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Motivational Quote</label>
                                        <textarea name="motivational_quote" class="form-control" rows="5"
                                                  placeholder="Enter motivational quote"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <span class="text-muted mt-5">Options</span><span class="text-muted mt-5 offset-md-11">Answer</span>
                                    <hr class="mt-1">

                                    <div class="form-group contact-repeater">
                                        <div class="repeat-option">
                                            <div class="input-group mb-1 col-md-12 options-count">
                                                <label for="exampleInputPassword1" class="label-control col-md-1">Option - 1</label>
                                                <input type="text" name="option[]" placeholder="Enter option" class="form-control col-md-10" id="example-tel-input">
                                                <input type="radio" name="answer" class="mt-1 mr-2 ml-2" id="input-radio-12">
                                            </div>


                                        </div>
                                        <div class="input-group col-md-12">
                                            <label class="col-md-1"></label>
                                            <button type="button" data-repeater-create class="btn btn-primary create-option">
                                                <i class="ft-plus"></i> Add more option
                                            </button>
                                        </div>

                                    </div>
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
    <script>
        $(function () {
            var click_count = 1;
            $(document).on('click', '.create-option', function () {

                var option_count = $('.options-count');
                var total_option = option_count.length + 1
                click_count++

                var input = '<div class="input-group mb-1 col-md-12 options-count option-'+total_option+'">\n' +
                    '<label for="exampleInputPassword1" class="label-control col-md-1">Option - 1</label>\n' +
                    '<input type="text" name="option[]" placeholder="Enter option" class="form-control col-md-10" id="example-tel-input">\n' +
                    '<input type="radio" name="answer[]" data-id="option-'+total_option+'" class="mt-1 mr-2 ml-2" id="input-radio-12">\n' +
                    '<span class="input-group-append" id="button-addon2">\n' +
                    '    <button class="btn-sm btn-danger remove-option" data-id="option-'+total_option+'" type="button"><i data-id="option-'+total_option+'" class="ft-x"></i></button>\n' +
                    '</span>\n' +
                    '</div>';
                $('.repeat-option').append(input)
            })

            $(document).on('click', '.remove-option', function (event) {
                var rowId = $(event.target).attr('data-id');


                $('.'+rowId).remove();
            })
        })
    </script>

@endpush
