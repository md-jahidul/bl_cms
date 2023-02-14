@extends('layouts.admin')
@section('', 'Faq|Create')
@section('card_name', 'Faq')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('faq-categories') }}">Faq Categories</a></li>
    <li class="breadcrumb-item active"><a href="{{ url("faq/$slug") }}">Faq List</a></li>
    <li class="breadcrumb-item active"> FAQ Create</li>
@endsection
@section('action')
    <a href="{{ url("faq/$slug") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("faq/$slug/store") }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                @if (!empty($for))
                                    <div class="form-group col-md-6 {{ $errors->has('model_id') ? ' error' : '' }}">
                                        <label for="model_id" class="required"> For</label>
                                        <select class="form-control required" name="model_id" id="offer_type"
                                                required data-validation-required-message="Please select offer">
                                            <option data-alias="" value="">---Select cat Type---</option>
                                            @foreach($for as $model)
                                                <option data-alias="{{ $model->id }}" value="{{ $model->id }}">{{ $model->page_name_en }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('model_id'))
                                            <div class="help-block">{{ $errors->first('model_id') }}</div>
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group col-md-6 {{ $errors->has('question_en') ? ' error' : '' }}">
                                    <label for="question_en" class="">Question (English)</label>
                                    <textarea type="text" name="question_en" class="form-control" placeholder="Enter question in English" required rows="5"
                                              data-validation-required-message="Enter question in English">{{ old("question_en") ? old("question_en") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('question_en'))
                                        <div class="help-block">  {{ $errors->first('question_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('question_bn') ? ' error' : '' }}">
                                    <label for="question_bn" class="">Question (Bangla)</label>
                                    <textarea type="text" name="question_bn" class="form-control" placeholder="Enter question in Bangla" required rows="5"
                                              data-validation-required-message="Enter question in Bangla">{{ old("question_bn") ? old("question_bn") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('question_bn'))
                                        <div class="help-block">  {{ $errors->first('question_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('answer_en') ? ' error' : '' }}">
                                    <label for="answer_en" class="">Answer (English)</label>
                                    <textarea type="text" name="answer_en" class="form-control summernote_editor" placeholder="Enter answer in English" required rows="5"
                                              data-validation-required-message="Enter answer in English">{{ old("answer_en") ? old("answer_en") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('answer_en'))
                                        <div class="help-block">  {{ $errors->first('answer_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('answer_bn') ? ' error' : '' }}">
                                    <label for="answer_bn" class="">Answer (Bangla)</label>
                                    <textarea type="text" name="answer_bn" class="form-control summernote_editor" placeholder="Enter answer in Bangla" required rows="5"
                                              data-validation-required-message="Enter answer in Bangla">{{ old("answer_bn") ? old("answer_bn") : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('answer_bn'))
                                        <div class="help-block">  {{ $errors->first('answer_bn') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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
@stop
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush














