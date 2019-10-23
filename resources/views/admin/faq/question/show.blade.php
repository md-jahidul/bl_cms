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
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="col-md-12">
                    <form role="form" action="{{ $action }}" method="POST">
                        @csrf
                        @if($edit)
                            @method('PATCH')
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title_en" class="required">Category</label><br/>
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    @foreach($category as $id => $item)
                                        <option value="{{ $id }}"
                                                @if($id == $selected_category)  selected @endif >{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="title_en" class="required">Question</label>
                                <input class="form-control col-md-12" type="text" id="question" name="question" required
                                       value="@if(isset($question)){{ $question->question }} @endif">
                            </div>
                            <div class="col-md-12">
                                <label for="title_en" class="required">Answer</label>
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
    </section>
@endsection

@push('page-js')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: 'textarea#answer',
                branding: false,
                menubar: false,
                height: 200,
                statusbar: false,
                plugins: 'advlist lists'
            });
        })
    </script>
@endpush
