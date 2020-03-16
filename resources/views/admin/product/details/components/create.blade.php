@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$productDetailsId, $sectionId]) }}"> Section List</a></li>
    <li class="breadcrumb-item active"> <a href="{{ route('component-list', [$productDetailsId, $sectionId]) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{  route('component-list', [$productDetailsId, $sectionId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('component-store', [$productDetailsId, $sectionId]) }}" method="POST" novalidate enctype="multipart/form-data">
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
                                                            <input type="checkbox" id="extra-title">
                                                            <label for="extra-title" class="">Extra Title</label>
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
                                                            <input type="checkbox" id="dropdown">
                                                            <label for="text-editor" class="">Dropdown</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="image-field">
                                                            <label for="image-field" class="">Image Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="multi-image">
                                                            <label for="multi-image" class="">Multiple Image Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="button-check">
                                                            <label for="button" class="">Button</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="related_product">
                                                            <label for="related_product" class="">Related Product</label>
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

                                                <div class="form-group col-md-12 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                    <label for="editor_en" class="required">Component Type</label>
                                                    <select name="component_type" class="form-control required" id="data-type"
                                                            required data-validation-required-message="Please select component type">
                                                        <option value="">--Select Data Type--</option>
                                                        @foreach($dataTypes as $key => $item)
                                                            <option value="{{ $key }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('editor_en'))
                                                        <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                    @endif
                                                </div>

                                                <slot id="text-field" class="d-none">
                                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                        <label for="title_en">Title Field (English)</label>
                                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("title_en") ? old("title_en") : '' }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_en'))
                                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                        <label for="title_bn" >Title Field (Bangla)</label>
                                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_bn'))
                                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>


                                                <slot id="extra-title-field" class="d-none">
                                                    <div class="form-group col-md-6 {{ $errors->has('extra_title_en') ? ' error' : '' }}">
                                                        <label for="extra_title_en">Extra Title (English)</label>
                                                        <textarea type="text" name="extra_title_en"  class="form-control" placeholder="Enter extra title in English"></textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('extra_title_en'))
                                                            <div class="help-block">{{ $errors->first('extra_title_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('extra_title_bn') ? ' error' : '' }}">
                                                        <label for="extra_title_bn">Extra Title (Bangla)</label>
                                                        <textarea type="text" name="extra_title_bn"  class="form-control" placeholder="Enter extra title in Bangla"></textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('extra_title_bn'))
                                                            <div class="help-block">{{ $errors->first('extra_title_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-area-button" class="d-none">
                                                    <div class="form-group col-md-6 {{ $errors->has('button_en') ? ' error' : '' }}">
                                                        <label for="button_en">Button Title (English)</label>
                                                        <input type="text" name="button_en"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("button_en") ? old("button_en") : '' }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('button_en'))
                                                            <div class="help-block">  {{ $errors->first('button_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('button_bn') ? ' error' : '' }}">
                                                        <label for="button_bn" >Button Title (Bangla)</label>
                                                        <input type="text" name="button_bn"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("button_bn") ? old("button_bn") : '' }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('button_bn'))
                                                            <div class="help-block">  {{ $errors->first('button_bn') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('button_link') ? ' error' : '' }}">
                                                        <label for="button_link" >Button URL</label>
                                                        <input type="text" name="button_link"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ old("button_link") ? old("button_link") : '' }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('button_link'))
                                                            <div class="help-block">  {{ $errors->first('button_link') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-area-field" class="d-none">
                                                    <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                                        <label for="description_en" >Text Area (English)</label>
                                                        <textarea name="description_en"  class="form-control" placeholder="Enter company name bangla">{{ old("description_en") ? old("description_en") : '' }}</textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_en'))
                                                            <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                                        @endif
                                                    </div>


                                                    <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                                        <label for="description_bn" >Text Area (Bangla)</label>
                                                        <textarea name="description_bn"  class="form-control" placeholder="Enter company name bangla">{{ old("description_bn") ? old("description_bn") : '' }}  </textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_bn'))
                                                            <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-editor-field" class="d-none">
                                                    <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                        <label for="editor_en">Text Editor (English)</label>
                                                        <textarea type="text" name="editor_en"  class="form-control" placeholder="Enter offer details in english" id="details"></textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_en'))
                                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('editor_bn') ? ' error' : '' }}">
                                                        <label for="editor_bn">Text Editor (Bangla)</label>
                                                        <textarea type="text" name="editor_bn"  class="form-control" placeholder="Enter offer details in english"  id="details"></textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_bn'))
                                                            <div class="help-block">{{ $errors->first('editor_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="dropdown_field" class="d-none">
                                                    <div class="form-group col-md-6">
                                                        <label for="editor_bn" class="text-success">Drop Down Sample Picture</label>
                                                        <img class=" img-fluid" src="{{ asset('sample-images/drop_down.png') }}" alt="Image description">
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                        <label for="editor_en" class="required" >Drop Down Data</label>
                                                        <select name="other_attributes[dropdown_data_type]" class="form-control required">
                                                            <option value="">--Select Dropdown Data Type--</option>
                                                            {{--                                                            <option value="easy_payment_card">Easy Payment Card</option>--}}
                                                            <option value="device_data_offer">Device Free Data Offer</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_en'))
                                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="single-image" class="d-none">
                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="">Image Field</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="dropify" data-height="80">
                                                            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text">Alt Text</label>
                                                        <input type="text" name="alt_text"  class="form-control">
                                                    </div>
                                                </slot>


                                                <slot id="multiple-image-field" class="d-none">
                                                    <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">
                                                    <div class="col-md-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label for="message">Multiple Image</label>
                                                            <input type="file" class="dropify" name="multi_item[image_url-1]" data-height="80"/>

                                                            {{--                                                            <input type="file" class="dropify" name="multiple_attributes[image][image_url_1]" data-height="80"/>--}}
                                                            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-5">
                                                        <label for="alt_text">Alt Text</label>
                                                        <input type="text" name="multi_item[alt_text-1]" class="form-control">

                                                        {{--                                                        <input type="text" name="multiple_attributes[alt_text][alt_text_1]" class="form-control">--}}
                                                    </div>

                                                    <div class="form-group col-md-1">
                                                        <label for="alt_text"></label>
                                                        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                    </div>
                                                </slot>



                                                {{--                                                <slot id="related_product_field" class="">--}}
                                                <div id="related_product_field" class="col-md-6 {{ $errors->has('offer_type_id') ? ' error' : '' }} d-none">
                                                    <label for="editor_en">Related Product</label>
                                                    <select name="offer_type_id" class="select2 form-control" id="data-type">
                                                        <option value="">--Select Data Type--</option>
                                                        {{--                                                            <option value="60">Special Data Offer</option>--}}
                                                        {{--                                                            <option value="59">Special Voice Offer</option>--}}
                                                        @foreach($products as  $product)
                                                            <option value="{{ $product->id }}">{{ $product->name_en . '/ ' . $product->product_code }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('offer_type_id'))
                                                        <div class="help-block">{{ $errors->first('offer_type_id') }}</div>
                                                    @endif
                                                </div>
                                                {{--                                                </slot>--}}

                                                <div class="form-actions col-md-12">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="la la-check-square-o"></i> Save
                                                        </button>
                                                    </div>
                                                </div>

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

    <style>
        form #related_product_field .select2-container {
            width: 100% !important;
        }
    </style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">



@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>




    <script>
        $(function () {
            function dropify(){
                $('.dropify').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    }
                });
            }
            dropify();
            $("textarea#details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    // ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:150
            })
            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 2;
                var input = '<div class="col-md-6 col-xs-6 options-count option-'+total_option+'">\n' +
                    '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">>\n' +
                    '<div class="form-group">\n' +
                    '      <label for="message">Multiple Image</label>\n' +
                    '      <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
                    // '      <input type="file" class="dropify" name="multiple_attributes[image][image_url_'+total_option+']" data-height="80"/>\n' +
                    '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '  </div>\n' +
                    ' </div>\n'+
                    '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                    '    <label for="alt_text">Alt Text</label>\n' +
                    '    <input type="text" name="multi_item[alt_text-'+total_option+']"  class="form-control">\n' +
                    // '    <input type="text" name="multiple_attributes[alt_text][alt_text_'+total_option+']"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <label for="alt_text"></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>';
                $('#multiple-image-field').append(input);
                dropify();
            });
            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });
            // var inputText = $('#input-text');
            // var textArea = $('#text-area');
            // var textEditor = $('#text-editor');
            // var dropDown = $('#dropdown');
            // var imageField = $('#image-field');
            // var multiImage = $('#multi-image');
            //
            // var textField = $('#text-field');
            // var textAreaField = $('#text-area-field');
            // var textEditorField = $('#text-editor-field');
            // var dropdownField = $('#dropdown_field');
            // var singleImage = $('#single-image');
            // var multipleImageField = $('#multiple-image-field');
            //
            // function showHideElement(field, item){
            //     $(field).on('click', function () {
            //         var isChecked = $(this).is(":checked");
            //         if (isChecked) {
            //             $(item).show()
            //         } else {
            //             $(item).hide()
            //         }
            //     });
            // }
            //
            // showHideElement(inputText, textField);
            // showHideElement(textArea, textAreaField);
            // showHideElement(textEditor, textEditorField);
            // showHideElement(dropDown, dropdownField);
            // showHideElement(imageField, singleImage);
            // showHideElement(multiImage, multipleImageField);
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>

@endpush
