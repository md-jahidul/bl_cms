@extends('layouts.admin')
@section('title', 'Customer Feedback Edit Question')
@section('card_name', ' Edit Question')
@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ url('customer-feedback/questions') }}">Question List</a></li>
<li class="breadcrumb-item active"> Edit</li>
@endsection
@section('action')
<a href="{{ url('customer-feedback/questions') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form role="form" action="{{ url('customer-feedback/save-question') }}" method="POST" novalidate>
                        <div class="row">

                            <input type="hidden" name="question_id" value="{{$question->id}}">

                            <div class="form-group col-md-6 {{ $errors->has('question_en') ? ' error' : '' }}">
                                <label for="title" class="required">Question (EN)</label>
                                <input type="text" name="question_en"  class="form-control" placeholder="Enter question (EN)"
                                       value="{{ $question->question_en }}" required data-validation-required-message="Enter question (EN)">
                                <div class="help-block"></div>
                                @if ($errors->has('question_en'))
                                <div class="help-block">  {{ $errors->first('question_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('question_bn') ? ' error' : '' }}">
                                <label for="title" class="required">Question (BN)</label>
                                <input type="text" name="question_bn"  class="form-control" placeholder="Enter question (BN)"
                                       value="{{ $question->question_bn }}" required data-validation-required-message="Enter question (BN)">
                                <div class="help-block"></div>
                                @if ($errors->has('question_bn'))
                                <div class="help-block">  {{ $errors->first('question_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('type') ? ' error' : '' }}">
                                <label for="Type">Answer Type</label>

                                @php
                                $checked = "";
                                if($question->type == 1){
                                $checked = "checked";
                                }
                                @endphp

                                <input type="checkbox" name="type" {{ $checked }} class="switch add_radio_inputs" data-on-label="Radio" data-off-label="Textarea">
                            </div>
                            <div class="form-group col-md-6">

                                <div class="radio_wrap">
                                    @if($question->type == 1)

                                    <label for="inputs">Radio Inputs
                                        <a href="#" class="btn btn-sm btn-success add_radio_input">+ Add New</a>
                                    </label>
                                     @php
                                     
                                     $ansEn = json_decode($question->answers_en);
                                     $ansBn = json_decode($question->answers_bn);
                                     
                                     @endphp
                                    @foreach($ansEn as $k => $ans)
                                    <div class="input-group">
                                        EN: &nbsp;<input type="text" value="{{$ans}}" class="form-control" name="inputs_en[]">
                                        &nbsp;BN: &nbsp;<input type="text" value="{{$ansBn[$k]}}" class="form-control" name="inputs_bn[]">
                                        <div class="input-group-append">
                                            <a href="#" class="text-danger remove_radio_input">
                                                <i class="la la-minus-square-o"></i>
                                            </a>
                                        </div>

                                    </div>
                                    @endforeach
                                    
                                    @endif
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


<div class="radio_input_hidden display-hidden">
    <label for="inputs">Radio Inputs
        <a href="#" class="btn btn-sm btn-success add_radio_input">+ Add New</a>
    </label>

    <div class="input-group">
        EN: &nbsp;<input type="text" class="form-control" name="inputs_en[]">
        &nbsp;BN: &nbsp;<input type="text" class="form-control" name="inputs_bn[]">
        <div class="input-group-append">
            <a href="#" class="text-danger remove_radio_input">
                <i class="la la-minus-square-o"></i>
            </a>
        </div>

    </div>


    <div class="input-group">
        EN: &nbsp;<input type="text" class="form-control" name="inputs_en[]">
        &nbsp;BN: &nbsp;<input type="text" class="form-control" name="inputs_bn[]">
        <div class="input-group-append">
            <a href="#" class="text-danger remove_radio_input">
                <i class="la la-minus-square-o"></i>
            </a>
        </div>
    </div>


    <div class="input-group">
        EN: &nbsp;<input type="text" class="form-control" name="inputs_en[]">
        &nbsp;BN: &nbsp;<input type="text" class="form-control" name="inputs_bn[]">
        <div class="input-group-append">
            <a href="#" class="text-danger remove_radio_input">
                <i class="la la-minus-square-o"></i>
            </a>
        </div>
    </div>


    <div class="input-group">
        EN: &nbsp;<input type="text" class="form-control" name="inputs_en[]">
        &nbsp;BN: &nbsp;<input type="text" class="form-control" name="inputs_bn[]">
        <div class="input-group-append">
            <a href="#" class="text-danger remove_radio_input">
                <i class="la la-minus-square-o"></i>
            </a>
        </div>
    </div>

</div>

<div class="single_radio_hidden display-hidden">
    <div class="input-group">
        EN: &nbsp;<input type="text" class="form-control" name="inputs_en[]">
        &nbsp;BN: &nbsp;<input type="text" class="form-control" name="inputs_bn[]">
        <div class="input-group-append">
            <a href="#" class="text-danger remove_radio_input">
                <i class="la la-minus-square-o"></i>
            </a>
        </div>
        <br>
    </div>

</div>


@stop

@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/switch.css') }}">

<style type="text/css">

    .input-group{
        margin-bottom: 10px;
    }

</style>

@endpush

@push('page-js')

<script src="{{ asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

$(function () {
    $('.switch:checkbox').checkboxpicker();



    $('.add_radio_inputs').on('change.bootstrapSwitch', function (event, state) {
        var x = $(this).data('on-text');
        var y = $(this).data('off-text');
        if ($(".add_radio_inputs").is(':checked')) {
            var radioInput = $(".radio_input_hidden").html();
            $(".radio_wrap").html(radioInput);
        } else {
            $(".radio_wrap").html("");
        }
    });

    $(".radio_wrap").on('click', '.add_radio_input', function () {
        var input = $(".single_radio_hidden").html();
        $(".radio_wrap").append(input);
    });

    $(".radio_wrap").on('click', '.remove_radio_input', function () {
        $(this).parents(".input-group").remove();
    });

});

</script>
@endpush






