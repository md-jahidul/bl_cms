@extends('layouts.admin')
@section('title', 'Component Create')
@section('card_name', 'Component Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('initiative_component.index', [$tabId]) }}"> Component List</a>
    </li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{  route('initiative_component.index', [$tabId]) }}" class="btn btn-warning  btn-glow px-2"><i
            class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ route('initiative_component.store', [$tabId]) }}"
                          method="POST" novalidate enctype="multipart/form-data">
                        <div class="content-body">
                            <div class="row">
                                <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                                    <label for="editor_en" class="required">Component Type</label>
                                    <select name="component_type" class="form-control required" id="component_type"
                                            required data-validation-required-message="Please select component type">
                                        <option value="">--Select Component Type--</option>
                                        @foreach($componentTypes as $key => $item)
                                            <option data-alias="{{ $key }}" value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('component_type'))
                                        <div class="help-block">{{ $errors->first('component_type') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-8 pb-2">
                                    <label>Component Sample Picture</label>
                                    <img class="img-thumbnail" id="componentImg" width="100%">
                                </div>

                                {{--Events Activities--}}
                                <slot id="events_activities" data-offer-type="events_activities" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                </slot>

                                {{--Icon Box--}}
                                <slot id="icon_box" data-offer-type="icon_box" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-text-editor')
                                </slot>

                                {{--Mentors_component--}}
                                <slot id="mentors_component" data-offer-type="mentors_component" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-text-editor')
                                </slot>

                                {{--news_component--}}
                                <slot id="news_component" data-offer-type="news_component" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.text-editor')
                                    @include('admin.corporate-responsibility.initiative.partials.button-field')
                                    @include('admin.corporate-responsibility.initiative.partials.single-image')
                                </slot>

                                {{--news_event--}}
                                <slot id="news_event" data-offer-type="news_event" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-text-editor')
                                </slot>

                                {{--partner--}}
                                <slot id="partner" data-offer-type="partner" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                </slot>

                                {{--tutorial_step--}}
                                <slot id="tutorial_step" data-offer-type="tutorial_step" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                </slot>

                                {{--winners--}}
                                <slot id="winners" data-offer-type="winners" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                    @include('admin.corporate-responsibility.initiative.partials.multiple-text-editor')
                                </slot>

                                {{--young_future--}}
                                <slot id="young_future" data-offer-type="young_future" class="d-none">
                                    @include('admin.corporate-responsibility.initiative.partials.text-editor')
                                    @include('admin.corporate-responsibility.initiative.partials.single-image')
                                </slot>

                                {{--Batch Component--}}
                                <slot id="batch_component" data-offer-type="batch_component" class="d-none">
                                @include('admin.corporate-responsibility.initiative.partials.component-title')
                                <!--Tab-1 -->
                                    <div class="form-group col-md-12 col-xs-6 tab">
                                        <div class="pull-left mt-2">
                                            <h3><strong>Tab 1</strong></h3>
                                        </div>
                                        <div class="pull-right">
                                            <label for="alt_text"></label>
                                            <button type="button" class="btn btn-bitbucket multi_item_remove mt-2"
                                                    id="plus-tab"><i class="la la-plus"></i> Add More Tab
                                            </button>
                                        </div>
                                        <hr class="item-tab">
                                    </div>

                                    <input id="multi_item_count" type="hidden" name="multi_item_count" value="1">

                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title_en">Tab Title (English)</label>
                                        <input type="text" name="batch[tab_1][title_en]" class="form-control"
                                               placeholder="Enter company name bangla"
                                               value="{{ isset($component->title_en) ? $component->title_en : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title_bn">Tab Title (Bangla)</label>
                                        <input type="text" name="batch[tab_1][title_bn]" class="form-control"
                                               placeholder="Enter company name bangla"
                                               value="{{ isset($component->title_bn) ? $component->title_bn : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    {{-- Sub Item--}}
                                    <slot id="tab_component_1">
                                        <div class="col-md-12 col-xs-6 tab_component_1 options-count">
                                            <h3><strong>Item 1</strong></h3>
                                            <hr class="item-line">
                                        </div>

                                        <div class="col-md-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="message">Image</label>
                                                <input type="file" class="dropify"
                                                       name="batch[tab_1][items][item_1][image]" data-height="80"/>
                                                <span
                                                    class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="alt_text">Alt Text English</label>
                                            <input type="text" name="batch[tab_1][items][item_1][alt_text_en]"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="alt_text"></label>
                                            <button type="button"
                                                    class="btn-sm btn-outline-success multi_item_remove mt-2 tab-multi-item"
                                                    data-id="tab_component_1">
                                                Add More Item
                                            </button>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="alt_text">Alt Text Bangla</label>
                                            <input type="text" name="batch[tab_1][items][item_1][alt_text_bn]"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="alt_text">Image Name English</label>
                                            <input type="text" name="batch[tab_1][items][item_1][img_name_en]"
                                                   class="form-control slug-convert">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="alt_text">Image Name Bangla</label>
                                            <input type="text" name="batch[tab_1][items][item_1][img_name_bn]"
                                                   class="form-control slug-convert">
                                        </div>

                                        <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                            <label
                                                for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
                                            <input type="text" name="batch[tab_1][items][item_1][title_en]"
                                                   class="form-control" placeholder="Enter company name bangla"
                                                   value="{{ isset($component->title_en) ? $component->title_en : '' }}">
                                        </div>

                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                            <label
                                                for="title_bn">{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
                                            <input type="text" name="batch[tab_1][items][item_1][title_bn]"
                                                   class="form-control" placeholder="Enter company name bangla"
                                                   value="{{ isset($component->title_bn) ? $component->title_bn : '' }}">
                                        </div>
                                    </slot>
                                </slot>

                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        form #related_product_field .select2-container {
            width: 100% !important;
        }

        /* Hr rounded  border */
        hr.item-line {
            border: 1px solid rgba(255, 166, 87, 0.88);
            border-radius: 5px;
        }

        hr.item-tab {
            border: 1px solid rgb(87, 202, 255);
            border-radius: 5px;
        }
    </style>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/batch-component.js') }}" type="text/javascript"></script>
{{--    <script src="{{ asset('js/custom-js/multi-image.js') }}" type="text/javascript"></script>--}}

    <script src="{{ asset('js/custom-js/component.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>

    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-lite.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote_0.8.18/summernote-table-headers.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>
        $(function () {

            $('#component_type').on('change', function () {
                // Component Sample Image Section
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('component-images') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
            })

            function dropify() {
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

            function summerNoteEditor() {
                $("textarea.summernote_editor").summernote({
                    tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
                    toolbar: [
                        ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['table', ['table']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video', 'hr']],
                        ['view', ['fullscreen', 'codeview']]
                    ],
                    popover: {
                        table: [
                            ['custom', ['tableHeaders']],
                            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                        ],
                    },
                    height: 150
                })
            }

            // Multi Items Component
            $(document).on('click', '#plus-image', function () {
                var componentVal = $('#component_type').val();
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var multipleTitle =
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '    <label for="title_en">Title Field (English)</label>\n' +
                    '    <input type="text" name="multi_title_en[]"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '    <label for="title_bn">Title Field (Bangla)</label>\n' +
                    '    <input type="text" name="multi_title_bn[]"  class="form-control">\n' +
                    '</div>';

                var multipleDetails =
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '    <label for="editor_en">Details En</label>\n' +
                    '    <textarea name="details_en[]"  class="form-control summernote_editor"></textarea>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '    <label for="editor_bn">Details Bn</label>\n' +
                    '    <textarea name="details_bn[]"  class="form-control summernote_editor"></textarea>\n' +
                    '</div>';

                var input =
                    '<div class="col-md-12 col-xs-6 options-count option-' + total_option + '">\n' +
                    '    <h3><strong>Item ' + total_option + '</strong></h3>\n' +
                    '    <hr class="item-line">\n' +
                    '</div>\n' +
                    '<div class="col-md-6 col-xs-6 options-count option-' + total_option + '">\n' +
                    '<div class="form-group">\n' +
                    '      <label for="message">Multiple Image</label>\n' +
                    '      <input type="file" class="dropify" name="base_image[]" data-height="80"/>\n' +
                    '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '  </div>\n' +
                    ' </div>\n' +
                    '<div class="form-group col-md-3 option-' + total_option + '">\n' +
                    '    <label for="alt_text">Alt Text English</label>\n' +
                    '    <input type="text" name="alt_text_en[]"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-2 option-' + total_option + '">\n' +
                    '    <label for="alt_text">Alt Text Bangla</label>\n' +
                    '    <input type="text" name="multi_alt_text_bn[]"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-' + total_option + '">\n' +
                    '   <label for="alt_text"></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-' + total_option + '" ><i data-id="option-' + total_option + '" class="la la-trash"></i></button>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '<label for="alt_text">Image Name English</label>\n' +
                    '    <input type="text" name="img_name_en[]" class="form-control img-data slug-convert" required>\n' +
                    '<span class="help-block duplicate-error text-danger"></span>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-' + total_option + '">\n' +
                    '    <label for="alt_text">Image Name Bangla</label>\n' +
                    '    <input type="text" name="img_name_bn[]" class="form-control img-data multi-slug-convert" required>\n' +
                    '<span class="help-block duplicate-error text-danger"></span>\n' +
                    '</div>';

                if (
                    componentVal == "icon_box" || componentVal == "winners" ||
                    componentVal == "news_event" || componentVal == "mentors_component"
                ) {
                    input += multipleTitle;
                    input += multipleDetails;
                } else if (componentVal == "partner") {
                    input += multipleTitle;
                }

                $("#" + componentVal).append(input);
                dropify();
                summerNoteEditor();
            });

            //Batches Component Dynamic Field Tab
            // $(document).on('click', '#plus-tab', function () {
            //     var tab_count = $('.tab').length+1;
            //     var option_count = $('.options-count');
            //     var total_option = option_count.length + 2;
            //
            //     var tabField =
            //         '<!--Tab '+total_option+'-->\n' +
            //         '<div class="form-group col-md-12 col-xs-6 tab tab_component_'+tab_count+'">\n' +
            //         '     <div class="pull-left mt-2">\n' +
            //         '         <h3><strong>Tab '+tab_count+'</strong></h3>\n' +
            //         '     </div>\n' +
            //         '     <div class="pull-right">\n' +
            //         '         <label for="alt_text"></label>\n' +
            //         '         <button type="button" class="btn btn-danger mt-2 remove-image" data-id="tab_component_'+tab_count+'">' +
            //         '       <i data-id="tab_component_'+tab_count+'" class="la la-trash"></i></button>\n' +
            //         '     </div>\n' +
            //         '     <hr class="item-tab">\n' +
            //         ' </div>\n' +
            //         ' <div class="form-group col-md-6 tab_component_'+tab_count+'">\n' +
            //         '     <label for="title_en">Tab Title (English)</label>\n' +
            //         '     <input type="text" name="batch[tab_'+tab_count+'][title_en]"  class="form-control" placeholder="Enter company name bangla">\n' +
            //         ' </div>\n' +
            //         ' <div class="form-group col-md-6 tab_component_'+tab_count+'">\n' +
            //         '     <label for="title_bn" >Tab Title (Bangla)</label>\n' +
            //         '     <input type="text" name="batch[tab_'+tab_count+'][title_bn]"  class="form-control" placeholder="Enter company name bangla">\n' +
            //         ' </div>';
            //
            //     tabField +=
            //         '<slot class="tab_component_'+tab_count+'" id="tab_component_'+tab_count+'">\n' +
            //         '<div class="col-md-12 col-xs-6 ">\n' +
            //         '    <h3><strong>Item 1</strong></h3>\n' +
            //         '    <hr class="item-line">\n' +
            //         '</div>\n' +
            //
            //         '<div class="col-md-6 col-xs-6">\n' +
            //         '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+tab_count+'">\n' +
            //         '<div class="form-group">\n' +
            //         '      <label for="message">Image</label>\n' +
            //         '      <input type="file" class="dropify" name="batch[tab_'+tab_count+'][items][item_1][image]" data-height="80"/>\n' +
            //         '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            //         '  </div>\n' +
            //         ' </div>\n'+
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="alt_text">Alt Text English</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][alt_text_en]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-2">\n' +
            //         '  <label for="alt_text"></label>\n' +
            //         '  <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2 tab-multi-item" data-id="tab_component_'+tab_count+'">\n' +
            //         '      Add More Item\n' +
            //         '  </button>\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="title_en">Alt Text Bangla</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][alt_text_bn]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="title_en">Image Name English</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][img_name_en]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="title_bn">Image Name Bangla</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][img_name_bn]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="title_en">Title Field (English)</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][title_en]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="title_bn">Title Field (Bangla)</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tab_count+'][items][item_1][title_bn]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<slot';
            //
            //     $("#batch_component").append(tabField);
            //     dropify();
            //     summerNoteEditor();
            // });
            //
            // //Batches Component Dynamic Field Component
            // $(document).on('click', '.tab-multi-item', function (event) {
            //     var itemPlusBtn = $(event.target).attr('data-id');
            //     var option_count = $('.options-count');
            //     var total_option = option_count.length + 2;
            //
            //     // alert(option_count)
            //     // alert(total_option)
            //
            //     var tabComCount = $('.'+itemPlusBtn).length + 1
            //     var tabCount = itemPlusBtn.split("_")[2]
            //
            //     var subItemInput =
            //         '<div class="col-md-12 col-xs-6 '+itemPlusBtn+' '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <h3><strong>Item '+total_option+'</strong></h3>\n' +
            //         '    <hr class="item-line">\n' +
            //         '</div>\n' +
            //
            //         '<div class="col-md-6 col-xs-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
            //         '<div class="form-group">\n' +
            //         '      <label for="message">Multiple Image</label>\n' +
            //         '      <input type="file" class="dropify" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][image]" data-height="80"/>\n' +
            //         '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            //         '  </div>\n' +
            //         ' </div>\n'+
            //         '<div class="form-group col-md-4 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="alt_text">Alt Text English</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][alt_text_en]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-1 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '   <label for="alt_text"></label>\n' +
            //         '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="'+itemPlusBtn+'_item_'+tabComCount+'" ><i data-id="'+itemPlusBtn+'_item_'+tabComCount+'" class="la la-trash"></i></button>\n' +
            //         '</div>'+
            //
            //         '<div class="form-group col-md-4 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_en">Alt Text Bangla</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][alt_text_bn]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_en">Image Name English</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][img_name_en]" class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-4 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_en">Image Name Bangla</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][img_name_bn]" class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_en">Title En</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][title_en]" class="form-control">\n' +
            //         '</div>\n' +
            //         '<div class="form-group col-md-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_bn">Title Bn</label>\n' +
            //         '    <input type="text" name="batch[tab_'+tabCount+'][items][item_'+total_option+'][title_bn]" class="form-control">\n' +
            //         '</div>';
            //     $("#"+itemPlusBtn).append(subItemInput);
            //     dropify();
            // });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.' + rowId).remove();
            });
        })
    </script>
@endpush







