@extends('layouts.admin')
@section('title', 'FAQ Question')
@section('card_name', "FAQ Question")

@section('action')
    <a href="{{ route('faq.questions.index') }}" class="btn btn-primary round btn-glow px-2" id="add_category_btn"><i
            class="la la-arrow-circle-left"></i>
        Back To List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                    <form role="form" action="{{ $action }}" method="POST">
                        @csrf
                        @if($edit)
                            @method('PATCH')
                        @endif
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title_en" class="required">Category</label><br/>
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach($category as $id => $item)
                                        <option value="{{ $id }}"
                                                @if($id == $selected_category)  selected @endif >{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Question (English)</label>
                                <input class="form-control col-md-12" type="text" id="question" name="question" required
                                       value="@if(isset($question)){{ $question->question }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Question (Bangla)</label>
                                <input class="form-control col-md-12" type="text" id="question_bn" name="question_bn" required
                                       value="@if(isset($question)){{ $question->question_bn }} @endif">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Answer (English)</label>
                                @error('answer')
                                <p>
                                    <small class="danger text-muted">Answers is required. You cannot set blank.</small>
                                </p>
                                @enderror
                                <textarea id="answer" name="answer" required>
                                    @if(isset($question))
                                        {{ $question->answer }}
                                    @endif
                                </textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="title_en" class="required">Answer (Bangla)</label>
                                @error('answer')
                                <p>
                                    <small class="danger text-muted">Answers is required. You cannot set blank.</small>
                                </p>
                                @enderror
                                <textarea id="answer" name="answer_bn" required>
                                    @if(isset($question))
                                        {{ $question->answer_bn }}
                                    @endif
                                </textarea>
                            </div>

                            @if(isset($question))
                                <input type="hidden" name="question_id"
                                       value="{{ $question->id }}">
                            @endif
                            <div class="content-header-right col-md-12">
                                <div class="dropdown float-md-right">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right mt-1 mb-2">
                                        @if($edit)
                                            Update
                                        @else
                                            Save
                                        @endif
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
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#answer").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:300
            })
        })
    </script>
@endpush
