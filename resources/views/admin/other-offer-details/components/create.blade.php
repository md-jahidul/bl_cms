@extends('layouts.admin')
@section('title', 'Partner Create')
@section('card_name', 'Partner Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item active"> Partner Create</li>
@endsection
@section('action')
    <a href="{{ url('partners') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{--{{ route('partners.store') }}--}}" method="POST" novalidate enctype="multipart/form-data">

                            <div class="app-content">
                                <h3>Component Fields</h3><hr>
                                <div class="sidebar-right">
                                    <div class="sidebar">
                                        <div class="sidebar-content card d-none d-lg-block">
                                            <div class="card-body">
                                                <div class="category-title">
                                                    <h6><strong>Select Field Type</strong></h6>
                                                </div>
                                                <hr>


                                                <div class="row">
                                                    <div class="col-md-8 col-sm-12">
                                                        <fieldset>
                                                            <input type="checkbox" id="input-text">
                                                            <label for="input-text" class="">Text Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="text-area">
                                                            <label for="text-area" class="">TextArea</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="text-editor">
                                                            <label for="text-editor" class="">Text Editor</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="image-field">
                                                            <label for="image-field" class="">Image Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="multi-image">
                                                            <label for="multi-image" class="">Multiple Image Field</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-left">
                                    <div class="content-wrapper">

                                        <div class="content-body">
                                            <div class="row">

                                                <slot id="text-field" style="display: none">
                                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                        <label for="title_en" class="required">Text Field (English)</label>
                                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter company name in Bangla">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_en'))
                                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                        <label for="title_bn" class="required">Text Field (Bangla)</label>
                                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter company name in Bangla">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_bn'))
                                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-area-field" style="display: none">
                                                    <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                                        <label for="description_en" class="required">Text Area (English)</label>
                                                        <textarea name="description_en"  class="form-control" placeholder="Enter company name bangla">{{ old("description_en") ? old("description_en") : '' }}
                                                        </textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_en'))
                                                            <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                                        @endif
                                                    </div>


                                                    <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                                        <label for="description_bn" class="required">Text Area (Bangla)</label>
                                                        <textarea name="description_bn"  class="form-control" placeholder="Enter company name bangla">{{ old("description_bn") ? old("description_bn") : '' }}
                                                        </textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_bn'))
                                                            <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-editor-field" style="display: none">
                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="">Image (optional)</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="multi_item[image_url-1]" class="custom-file-input" id="image">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                        <input type="text" name="multi_item[alt_text-1]"  class="form-control">
                                                    </div>

                                                </slot>

                                                <slot id="single-image" style="display: none">
                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="">Image (optional)</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="multi_item[image_url-1]" class="custom-file-input" id="image">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                        <input type="text" name="multi_item[alt_text-1]"  class="form-control">
                                                    </div>

                                                </slot>


                                                <slot id="multiple-image-field" style="display: none">
                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="">Image (optional)</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="multi_item[image_url-1]" class="custom-file-input" id="image">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                        <input type="text" name="multi_item[alt_text-1]"  class="form-control">
                                                    </div>

                                                    <div class="form-group col-md-1">
                                                        <label for="alt_text"></label>
                                                        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                    </div>
                                                </slot>




{{--                                                <div class="form-group col-md-6 {{ $errors->has('company_name_bn') ? ' error' : '' }}">--}}
{{--                                                    <label for="company_name_bn" class="required">Company Name (Bangla)</label>--}}
{{--                                                    <input type="text" name="company_name_bn"  class="form-control" placeholder="Enter company name bangla"--}}
{{--                                                           value="{{ old("company_name_bn") ? old("company_name_bn") : '' }}" required data-validation-required-message="Enter company name in Bangla">--}}
{{--                                                    <div class="help-block"></div>--}}
{{--                                                    @if ($errors->has('company_name_bn'))--}}
{{--                                                        <div class="help-block">  {{ $errors->first('company_name_bn') }}</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}

                                            </div>
                                        </div>
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

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')


    <script>
        $(function () {
            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var input = '<div class="form-group col-md-6 option-'+total_option+' options-count">\n' +
                            '   <label for="alt_text" class="">Image (optional)</label>\n' +
                            '     <div class="custom-file">\n' +
                            '      <input type="file" name="multi_item[image_url-1]" class="custom-file-input">\n' +
                            '      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>\n' +
                            '    </div>\n' +
                            '    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                            '</div>\n' +
                            '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                            '    <label for="alt_text" class="required1">Alt Text</label>\n' +
                            '    <input type="text" name="multi_item[alt_text-1]"  class="form-control">\n' +
                            '</div>\n' +
                            '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                            '   <label for="alt_text"></label>\n' +
                            '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                            '</div>'

                $('#multiple-image-field').append(input)
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });

            var inputText = $('#input-text');
            var textArea = $('#text-area');
            var textEditor = $('#text-editor');
            var imageField = $('#image-field');
            var multiImage = $('#multi-image');

            var textField = $('#text-field');
            var textAreaField = $('#text-area-field');
            var textEditorField = $('#text-editor-field');
            var singleImage = $('#single-image');
            var multipleImageField = $('#multiple-image-field');

            function showHideElement(field, item){
                $(field).on('click', function () {
                    var isChecked = $(this).is(":checked");
                    if (isChecked) {
                        $(item).show()
                    } else {
                        $(item).hide()
                    }
                });
            }

            showHideElement(inputText, textField)
            showHideElement(textArea, textAreaField)
            showHideElement(textEditor, textEditorField)
            showHideElement(imageField, singleImage)
            showHideElement(multiImage, multipleImageField)
        })
    </script>

@endpush







