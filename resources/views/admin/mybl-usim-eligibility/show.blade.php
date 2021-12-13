@extends('layouts.admin')
@section('title', 'USIM Eligibility Landing Page')
@section('card_name', 'USIM Eligibility Landing Page')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        @if ($errors->has('terms_conditions'))
                            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                Terms and Conditions Field is required. You cannot set blank.
                            </div>
                        @endif
                        <form role="form" action="{{ isset($usimContents->id) ? route('usim-eligibility.update', $usimContents->id) : route('usim-eligibility.update', 0) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('image') ? ' error' : '' }}">
                                    <label for="alt_text">Content Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input dropify" data-height="80"
                                               data-default-file="{{ isset($usimContents->image) ? asset($usimContents->image) : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    {{--@if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif--}}
                                </div>

                                <div class="col-md-6">
                                    <label for="dsce_en" class="required">Description En</label>
                                    <textarea class="summernote_editor" name="dsce_en" required>
                                        @if($usimContents)
                                            {{ $usimContents->dsce_en }}
                                        @endif
                                    </textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="dsce_bn" class="required">Description Bn</label>
                                    <textarea class="summernote_editor" name="dsce_bn" required>
                                        @if($usimContents)
                                            {{ $usimContents->dsce_bn }}
                                        @endif
                                    </textarea>
                                </div>

                                <div class="form-group col-md-6 mt-2 {{ $errors->has('input_title_en') ? ' error' : '' }}">
                                    <label for="input_title_en">Input Field Title En</label>
                                    <input type="text" name="input_title_en" class="form-control"
                                           placeholder="Ex: Check your 4G USIM eligibility in English"
                                           value="@if(isset($usimContents)){{$usimContents->input_title_en}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('input_title_en'))
                                        <div class="help-block">  {{ $errors->first('input_title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mt-2 {{ $errors->has('input_title_bn') ? ' error' : '' }}">
                                    <label for="input_title_bn">Input Field Title Bn</label>
                                    <input type="text" name="input_title_bn" class="form-control"
                                           placeholder="Ex: Check your 4G USIM eligibility in Bangla"
                                           value="@if(isset($usimContents)){{$usimContents->input_title_bn}} @endif">
                                    <div class="help-block"></div>
                                    @if ($errors->has('input_title_bn'))
                                        <div class="help-block">  {{ $errors->first('input_title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12">
                                    <button type="submit" class="btn btn-success round px-2 float-right">
                                        <i class="la la-check-square-o"></i>
                                        @if($usimContents) Update @else Save @endif
                                    </button>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            // $(".terms-conditions").summernote({
            //     toolbar: [
            //         ['style', ['bold', 'italic', 'underline', 'clear']],
            //         ['font', ['strikethrough', 'superscript', 'subscript']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['table', ['table']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['view', ['fullscreen']]
            //     ],
            //     height:150
            // })
        })
    </script>
@endpush






