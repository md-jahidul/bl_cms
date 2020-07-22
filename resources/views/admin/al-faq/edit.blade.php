@extends('layouts.admin')
@section('', 'Faq|Edit')
@section('card_name', 'Faq')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('faq-categories') }}">Faq Categories</a></li>
    <li class="breadcrumb-item active"><a href="{{ url("faq/$slug") }}">Faq List</a></li>
    <li class="breadcrumb-item active"> Faq Edit</li>
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
                        <form role="form" action="{{ route("faq.update", [$slug, $faq->id]) }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ $faq->title }}" required data-validation-required-message="Enter title">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                                    <label for="slug" class="">Slug</label>
                                    <input type="text" class="form-control" placeholder="" readonly
                                           value="{{ $faq->slug }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('slug'))
                                        <div class="help-block">  {{ $errors->first('slug') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('question_en') ? ' error' : '' }}">
                                    <label for="question_en" class="">Question (English)</label>
                                    <textarea type="text" name="question_en" class="form-control" placeholder="Enter duration name in bangla" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $faq->question_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('question_en'))
                                        <div class="help-block">  {{ $errors->first('question_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('question_bn') ? ' error' : '' }}">
                                    <label for="question_bn" class="">Question (Bangla)</label>
                                    <textarea type="text" name="question_bn" class="form-control" placeholder="Enter duration name in bangla" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $faq->question_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('question_bn'))
                                        <div class="help-block">  {{ $errors->first('question_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('answer_en') ? ' error' : '' }}">
                                    <label for="answer_en" class="">Answer (English)</label>
                                    <textarea type="text" name="answer_en" class="form-control summernote_editor" placeholder="Enter duration name in bangla" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $faq->answer_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('answer_en'))
                                        <div class="help-block">  {{ $errors->first('answer_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('answer_bn') ? ' error' : '' }}">
                                    <label for="answer_bn" class="">Answer (Bangla)</label>
                                    <textarea type="text" name="answer_bn" class="form-control summernote_editor" placeholder="Enter duration name in bangla" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $faq->answer_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('answer_bn'))
                                        <div class="help-block">  {{ $errors->first('answer_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
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














