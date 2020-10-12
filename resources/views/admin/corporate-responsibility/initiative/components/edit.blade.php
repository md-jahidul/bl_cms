@extends('layouts.admin')
@section('title', 'Component')
@section('card_name', 'Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('initiative_component.index', $tabId) }}"> Component List</a></li>
    <li class="breadcrumb-item active"> Component Edit</li>
@endsection
@section('action')
    <a href="{{ route('initiative_component.index', $tabId) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('initiative_component.update',[$tabId, $component->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="content-body">
                                <div class="row">
                                    <div class="form-group col-md-4 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                        <label for="editor_en" class="required">Component Type</label>
                                        <select class="form-control" id="component_type"
                                            name="component_type" readonly
                                                required data-validation-required-message="Please select component type">
                                            <option value="">--Select Data Type--</option>
                                            @foreach($componentTypes as $key => $type)
                                                <option data-alias="{{ $key }}" value="{{ $key }}" {{ ($component->component_type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('editor_en'))
                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-8 pb-2">
                                        <label>Component Sample Picture</label>
                                        <img src="{{ asset("component-images/$component->component_type.png") }}"
                                             class="img-thumbnail" id="componentImg" width="100%">
                                    </div>

                                    {{--Events Activities--}}
                                    <slot id="events_activities" data-offer-type="events_activities" class="d-none">
                                        @include('admin.corporate-responsibility.initiative.partials.component-title')
                                        @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                    </slot>

                                    {{--Icon Box--}}
                                    <slot id="icon_box" data-offer-type="icon_box" class="{{ ($component->component_type ==  "icon_box"  ) ? '' : "d-none" }}">
                                        @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    </slot>

                                    {{--Mentors_component--}}
                                    <slot id="mentors_component" data-offer-type="mentors_component" class="d-none">
                                        @include('admin.corporate-responsibility.initiative.partials.component-title')
                                        @include('admin.corporate-responsibility.initiative.partials.multiple-image')
                                        @include('admin.corporate-responsibility.initiative.partials.multiple-title')
                                        @include('admin.corporate-responsibility.initiative.partials.multiple-text-editor')
                                    </slot>

                                    {{--news_component--}}
                                    <slot id="news_component" data-offer-type="news_component" class="{{ ($component->component_type ==  "news_component"  ) ? '' : "d-none" }}">
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

                                    {{--Multiple Items--}}
                                    <slot id="multiple_items" data-offer-type="multiple_image" class="{{--{{ ($component->component_type ==  "multiple_image"  ) ? '' : "d-none" }}--}}">
                                        @php( $i = 0 )
                                        @if(array_key_exists(0,$multipleItem)))
                                            @foreach($multipleItem as $key => $item)
                                                @php($i++)
                                                <div class="col-md-12 col-xs-6">
                                                    <h3><strong>Item {{$i}}</strong></h3>
                                                    <hr class="item-line">
                                                </div>

                                                <input id="multi_item_count" type="hidden" name="multi_item_count" value="{{$i}}">
                                                <div class="col-md-6 col-xs-6 option-{{ $i }} options-count">
                                                    <div class="form-group">
                                                        <label for="message">Multiple Image</label>
                                                        <input type="file" class="dropify" name="multi_item[image_url-{{ $i }}]"
                                                               data-default-file="{{ isset($item['image_url']) ? config('filesystems.file_base_url') . $item['image_url'] : '' }}"
                                                               data-height="80"/>
                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-5 option-{{ $i }}">
                                                    <label for="alt_text">Alt Text</label>
                                                    <input type="text" name="multi_item[alt_text-{{ $i }}]" value="{{ $item['alt_text'] }}" class="form-control">
                                                </div>

                                                @if($i == 1)
                                                    <div class="form-group col-md-1">
                                                        <label for="alt_text"></label>
                                                        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                    </div>
                                                    {{--  @else--}}
                                                    {{--      <div class="form-group col-md-1 option-{{ $i }}">--}}
                                                    {{--          <label for="alt_text"></label>--}}
                                                    {{--          <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $i }}" ><i data-id="option-{{ $i }}" class="la la-trash"></i></button>--}}
                                                    {{--      </div>--}}
                                                @endif
                                            @if(!empty($item['title_en']) || !empty($item['title_bn']))
                                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                    <label for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
                                                    <input type="text" name="multi_item[title_en-{{ $i }}]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($item['title_en']) ? $item['title_en'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                    <label for="title_bn" >{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
                                                    <input type="text" name="multi_item[title_bn-{{ $i }}]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($item['title_bn']) ? $item['title_bn'] : '' }}">
                                                </div>
                                            @endif
                                            @if(!empty($item['editor_en']) || !empty($item['editor_bn']))
                                                <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                    <label for="editor_en">Text Editor (English)</label>
                                                    <textarea type="text" name="multi_item[editor_en-{{ $i }}]"  class="form-control summernote_editor" placeholder="Enter offer details in english"
                                                    >{{ isset($item['editor_en']) ? $item['editor_en'] : '' }}</textarea>
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('editor_bn') ? ' error' : '' }}">
                                                    <label for="editor_bn">Text Editor (Bangla)</label>
                                                    <textarea type="text" name="multi_item[editor_bn-{{ $i }}]"  class="form-control summernote_editor" placeholder="Enter offer details in english"
                                                    >{{ isset($item['editor_bn']) ? $item['editor_bn'] : '' }}</textarea>
                                                </div>
                                            @endif
                                            @endforeach
                                        @endif
                                    </slot>

                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1" id="active" {{ $component->status == 1 ? 'checked' : '' }}>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="inactive" {{ $component->status == 0 ? 'checked' : '' }}>
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button type="submit" id="save" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
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

    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>
        $(function () {

            $('#component_type').on('change', function () {
                // Component Sample Image Section
                var componentType = this.value + ".png"
                var fullUrl = "{{ asset('component-images') }}/" + componentType;
                $("#componentImg").attr('src', fullUrl)
            })

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

            function summerNoteEditor(){
                $("textarea.summernote_editor").summernote({
                    tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
                    toolbar: [
                        ['style',['style', 'bold', 'italic', 'underline', 'clear']],
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
                    height:150
                })
            }


            // Multi Image Component
            $(document).on('click', '#plus-image', function () {
                var componentVal = $('#component_type').val();
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var multipleTitle =
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="title_en">Title En</label>\n' +
                    '    <input type="text" name="multi_item[title_en-'+total_option+']"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="title_bn">Title En</label>\n' +
                    '    <input type="text" name="multi_item[title_bn-'+total_option+']"  class="form-control">\n' +
                    '</div>';

                var multipleDetails =
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="editor_en">Details En</label>\n' +
                    '    <textarea name="multi_item[editor_en-'+total_option+']"  class="form-control summernote_editor"></textarea>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="editor_bn">Details Bn</label>\n' +
                    '    <textarea name="multi_item[editor_bn-'+total_option+']"  class="form-control summernote_editor"></textarea>\n' +
                    '</div>';

                var input =
                    '<div class="col-md-12 col-xs-6 options-count option-'+total_option+'">\n' +
                    '    <h3><strong>Item '+total_option+'</strong></h3>\n' +
                    '    <hr class="item-line">\n' +
                    '</div>\n' +

                    '<div class="col-md-6 col-xs-6 option-'+total_option+'">\n' +
                    '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
                    '<div class="form-group">\n' +
                    '      <label for="message">Multiple Image</label>\n' +
                    '      <input type="file" class="dropify" name="multi_item[image_url-'+total_option+']" data-height="80"/>\n' +
                    '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '  </div>\n' +
                    ' </div>\n'+
                    '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                    '    <label for="alt_text">Alt Text</label>\n' +
                    '    <input type="text" name="multi_item[alt_text-'+total_option+']"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <label for="alt_text"></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>';

                if (
                    componentVal == "icon_box" || componentVal == "winners" ||
                    componentVal == "news_event" || componentVal == "mentors_component"
                ){
                    input += multipleTitle;
                    input += multipleDetails;
                }else if (componentVal == "partner"){
                    input += multipleTitle;
                }

                $("#multiple_items").append(input);
                dropify();
                summerNoteEditor();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });
        })
    </script>

@endpush







