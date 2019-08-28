@extends('layouts.admin')
@section('title', 'Question Create')
@section('card_name', 'Question Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('questions') }}"> Question List</a></li>
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
                        <form role="form" action="{{ route('questions.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Question</label>
                                    <input type="text" name="question_text"  class="form-control" placeholder="Enter question"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter campaign title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
                                    <label for="start_date" class="required">Point</label>
                                    <input type="number" name="point"  class="form-control" placeholder="Enter point"
                                           value="{{ old("start_date") ? old("start_date") : '' }}" required data-validation-required-message="Please select start date">
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_date'))
                                        <div class="help-block">  {{ $errors->first('start_date') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('slider_type_id') ? ' error' : '' }}">
                                    <label class="required">Tag</label>
                                    <select class="form-control error" name="tag_id" data-validation-required-message="Select slider type">
                                        <option value="">--Select Tag--</option>
                                        @if(isset($tags))
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}"{{ old('slider_type_id')== $tag->id ? 'selected' : ''}}>{{ $tag->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('slider_type_id'))
                                        <div class="help-block">  {{ $errors->first('slider_type_id') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <span class="text-muted mt-5">Options</span><span class="text-muted mt-5 offset-md-11">Answer</span>
                                    <hr class="mt-1">

                                    <div class="form-group contact-repeater">
                                        <div class="repeat-option">
                                            <div class="input-group mb-1 col-md-12 options-count">
                                                <label for="exampleInputPassword1" class="label-control col-md-1 option-sl">Option - 1</label>
                                                <input type="text" name="option[]" placeholder="Enter option" class="form-control col-md-10" id="example-tel-input">
                                                <input type="radio" name="answer[]" value="1" class="mt-1 mr-2 ml-2" id="input-radio-12">
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
            $(document).on('click', '.create-option', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var input = '<div class="input-group mb-1 col-md-12 options-count option-'+total_option+'">\n' +
                    '<label for="exampleInputPassword1" class="label-control col-md-1 option-sl">Option - '+total_option+'</label>\n' +
                    '<input type="text" name="option[]" placeholder="Enter option" class="form-control col-md-10" id="example-tel-input">\n' +
                    '<input type="radio" name="answer[]" data-id="option-'+total_option+'" value="'+total_option+'" class="mt-1 mr-2 ml-2" id="input-radio-12">\n' +
                    '<span class="input-group-append" id="button-addon2">\n' +
                    '    <button class="btn-sm btn-danger remove-option" data-id="option-'+total_option+'" type="button"><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</span>\n' +
                    '</div>';
                $('.repeat-option').append(input)
            });

            $(document).on('click', '.remove-option', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            })
        })
    </script>

@endpush
