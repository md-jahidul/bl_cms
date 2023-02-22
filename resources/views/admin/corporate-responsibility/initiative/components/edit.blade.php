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

                                    {{--news_component--}}
                                    <slot id="news_component" data-offer-type="news_component" class="{{ ($component->component_type ==  "news_component"  ) ? '' : "d-none" }}">
                                        @include('admin.corporate-responsibility.initiative.partials.component-title')
                                        @include('admin.corporate-responsibility.initiative.partials.text-editor')
                                        @include('admin.corporate-responsibility.initiative.partials.button-field')
                                        @include('admin.corporate-responsibility.initiative.partials.single-image')
                                    </slot>


                                    {{--young_future--}}
                                    <slot id="young_future" data-offer-type="young_future" class="{{ ($component->component_type ==  "young_future"  ) ? '' : "d-none" }}">
                                        @include('admin.corporate-responsibility.initiative.partials.text-editor')
                                        @include('admin.corporate-responsibility.initiative.partials.single-image')
                                    </slot>

                                    {{--Multiple Items--}}
                                    @php( $i = 0 )

                                    @if(
                                        $component->component_type != "batch_component" &&
                                        $component->component_type != "news_component" &&
                                        $component->component_type != "young_future"
                                    )
                                        @include('admin.corporate-responsibility.initiative.partials.component-title')
                                        @foreach($component['multiComponent'] as $key => $item)
                                            <input type="hidden" name="multi_img_ids[]" value="{{ isset($item['id']) ? $item['id'] : '' }}">
                                            @php($i++)
                                            <div class="col-md-12 col-xs-6">
                                                <h3><strong>Item {{$i}}</strong></h3>
                                                <hr class="item-line">
                                            </div>

                                            <input type="hidden" name="old_img_url[]" value="{{ isset($item['base_image']) ? $item['base_image'] : '' }}">
                                            <input type="hidden" name="multi_item_count" value="{{$i}}">
                                            <div class="col-md-6 col-xs-6 option-{{ $i }} options-count">
                                                <input type="hidden" name="base_image[]" value="{{ isset($item['base_image']) ? $item['base_image'] : '' }}">
                                                <div class="form-group">
                                                    <label for="message">Multiple Image</label>
                                                    <input type="file" class="dropify" name="base_image[]"
                                                           data-default-file="{{ isset($item['base_image']) ? config('filesystems.file_base_url') . $item['base_image'] : '' }}"
                                                           data-height="80"/>
                                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3 option-{{ $i }}">
                                                <label for="alt_text">Alt Text English</label>
                                                <input type="text" name="alt_text_en[]" value="{{ $item['alt_text_en'] }}" class="form-control">
                                            </div>

                                            <div class="form-group col-md-2 option-{{ $i }}">
                                                <label for="alt_text">Alt Text Bangla</label>
                                                <input type="text" name="alt_text_bn[]" value="{{ $item['alt_text_bn'] }}" class="form-control">
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

                                            <div class="form-group col-md-6 {{ $errors->has("img_name_en.$key") ? ' error' : '' }}">
                                                <label for="alt_text" class="required">Image Name English</label>
                                                <input type="text" name="img_name_en[]" class="form-control img-data" required
                                                       value="{{ isset($item['image_name_en']) ? $item['image_name_en'] : '' }}">
                                                <span class="duplicate-error text-danger"></span>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="alt_text" class="required">Image Name Bangla</label>
                                                <input type="text" name="img_name_bn[]" class="form-control img-data" required
                                                       value="{{ isset($item['image_name_bn']) ? $item['image_name_bn'] : '' }}">
                                                <span class="help-block duplicate-error text-danger"></span>
                                            </div>

                                            @if (
                                                $component->component_type == "icon_box" || $component->component_type == "winners" ||
                                                $component->component_type == "news_event" || $component->component_type == "mentors_component" ||
                                                $component->component_type == "partner")
                                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                    <label for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
                                                    <input type="text" name="multi_title_en[]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($item['title_en']) ? $item['title_en'] : '' }}">
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                    <label for="title_bn" >{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
                                                    <input type="text" name="multi_title_bn[]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($item['title_bn']) ? $item['title_bn'] : '' }}">
                                                </div>
                                                @if($component->component_type != "partner")
                                                    <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                        <label for="editor_en">Text Editor (English)</label>
                                                        <textarea type="text" name="details_en[]"  class="form-control summernote_editor" placeholder="Enter offer details in english"
                                                        >{{ isset($item['details_en']) ? $item['details_en'] : '' }}</textarea>
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('editor_bn') ? ' error' : '' }}">
                                                        <label for="editor_bn">Text Editor (Bangla)</label>
                                                        <textarea type="text" name="details_bn[]"  class="form-control summernote_editor" placeholder="Enter offer details in english"
                                                        >{{ isset($item['details_bn']) ? $item['details_bn'] : '' }}</textarea>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        <slot id="multiple_items"></slot>
                                    @endif

                                    {{--Batch Component--}}
                                    <slot id="batch_component" data-offer-type="batch_component" class="{{ ($component->component_type ==  "batch_component"  ) ? '' : "d-none" }}">
                                    @include('admin.corporate-responsibility.initiative.partials.component-title')
                                    <!--Tab-1 -->
                                        @if(isset($component['batchTabs']))
                                            @foreach($component['batchTabs'] as $key => $value)
                                                @php($key++)
                                                <div class="form-group col-md-12 col-xs-6 tab">
                                                    <div class="pull-left mt-2">
                                                        <h3><strong>Tab {{ $key }}</strong></h3>
                                                    </div>
                                                    @if($key == 1)
                                                        <div class="pull-right">
                                                            <label for="alt_text"></label>
                                                            <button type="button" class="btn btn-bitbucket multi_item_remove mt-2" id="plus-tab"><i class="la la-plus"></i> Add More Tab</button>
                                                        </div>
                                                    @endif
                                                    <hr class="item-tab">
                                                </div>

                                                <input id="multi_item_count" type="hidden" name="batch[tab_{{ $key }}][batch_tab_id]" value="{{ $value->id }}">

                                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                    <label for="title_en">Tab Title (English)</label>
                                                    <input type="text" name="batch[tab_{{ $key }}][title_en]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($value['title_en']) ? $value['title_en'] : '' }}">
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('title_en'))
                                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                    <label for="title_bn" >Tab Title (Bangla)</label>
                                                    <input type="text" name="batch[tab_{{ $key }}][title_bn]"  class="form-control" placeholder="Enter company name bangla"
                                                           value="{{ isset($value['title_bn']) ? $value['title_bn'] : '' }}">
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('title_bn'))
                                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                    @endif
                                                </div>


                                                {{-- Sub Item--}}
                                                @if(isset($value['tabComponents']))
                                                    <slot id="tab_component_{{$key}}">
                                                        @foreach($value['tabComponents'] as $subKey => $subValue)
                                                        @php($subKey++)

                                                            <input id="multi_item_count" type="hidden" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][batch_tab_com_id]" value="{{ $subValue->id }}">
                                                            <div class="col-md-12 col-xs-6 tab_component_{{ $key }} options-count">
                                                                <h3><strong>Item {{ $subKey }}</strong></h3>
                                                                <hr class="item-line">
                                                            </div>

                                                            <div class="col-md-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <label for="message">Image</label>
                                                                    <input type="hidden" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][old_image]" value="{{ $subValue['base_image'] }}">
                                                                    <input type="file" class="dropify" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][image]" data-height="80"
                                                                           data-default-file="{{ isset($subValue['base_image']) ? config('filesystems.file_base_url') . $subValue['base_image'] : '' }}"/>
                                                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="alt_text">Alt Text English</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][alt_text_en]" class="form-control"
                                                                       value="{{ isset($subValue['alt_text_en']) ? $subValue['alt_text_en'] : '' }}">
                                                            </div>

                                                            @if($subKey == 1)
                                                                <div class="form-group col-md-2">
                                                                    <label for="alt_text"></label>
                                                                    <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2 tab-multi-item" data-id="tab_component_{{ $key }}">
                                                                        Add More Item
                                                                    </button>
                                                                </div>
                                                            @endif

                                                            <div class="form-group col-md-4">
                                                                <label for="alt_text">Alt Text Bangla</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][alt_text_bn]" class="form-control"
                                                                    value="{{ isset($subValue['alt_text_bn']) ? $subValue['alt_text_bn'] : '' }}">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="alt_text">Image Name English</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][img_name_en]" class="form-control slug-convert"
                                                                       value="{{ isset($subValue['image_name_en']) ? $subValue['image_name_en'] : '' }}">
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="alt_text">Image Name Bangla</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{$subKey}}][img_name_bn]" class="form-control slug-convert"
                                                                       value="{{ isset($subValue['image_name_bn']) ? $subValue['image_name_bn'] : '' }}">
                                                            </div>


                                                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                                <label for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{ $subKey }}][title_en]"  class="form-control" placeholder="Enter company name bangla"
                                                                       value="{{ isset($subValue['title_en']) ? $subValue['title_en'] : '' }}">
                                                            </div>

                                                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                                <label for="title_bn" >{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
                                                                <input type="text" name="batch[tab_{{ $key }}][items][item_{{ $subKey }}][title_bn]"  class="form-control" placeholder="Enter company name bangla"
                                                                       value="{{ isset($subValue['title_bn']) ? $subValue['title_bn'] : '' }}">
                                                            </div>
                                                        @endforeach
                                                    </slot>
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
     /* Hr rounded  border */
     hr.item-line {
         border: 1px solid rgba(255,166,87,0.88);
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">



@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/batch-component.js') }}" type="text/javascript"></script>

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


            // Multi Items Component
            $(document).on('click', '#plus-image', function () {
                var componentVal = $('#component_type').val();
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var multipleTitle =
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="title_en">Title En</label>\n' +
                    '    <input type="text" name="multi_title_en[]"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="title_bn">Title En</label>\n' +
                    '    <input type="text" name="multi_title_bn[]"  class="form-control">\n' +
                    '</div>';

                var multipleDetails =
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
                    '    <label for="editor_en">Details En</label>\n' +
                    '    <textarea name="details_en[]"  class="form-control summernote_editor"></textarea>\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-6 option-'+total_option+'">\n' +
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
                    '    <input type="text" name="alt_text_bn[]"  class="form-control">\n' +
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
                ){
                    input += multipleTitle;
                    input += multipleDetails;
                }else if (componentVal == "partner"){
                    input += multipleTitle;
                }

                console.log(input)

                // $("#"+componentVal).append(input);
                $("#multiple_items").append(input);
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
            //         ' <div class="form-group col-md-6 tab_component_'+tab_count+'"">\n' +
            //         '     <label for="title_en">Tab Title (English)</label>\n' +
            //         '     <input type="text" name="multi_item[tab_title_en-'+tab_count+']"  class="form-control" placeholder="Enter company name bangla">\n' +
            //         ' </div>\n' +
            //         ' <div class="form-group col-md-6 tab_component_'+tab_count+'"">\n' +
            //         '     <label for="title_bn" >Tab Title (Bangla)</label>\n' +
            //         '     <input type="text" name="multi_item[tab_title_bn-'+tab_count+']"  class="form-control" placeholder="Enter company name bangla">\n' +
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
            //         '      <label for="message">Multiple Image</label>\n' +
            //         '      <input type="file" class="dropify" name="multi_item[data-'+tab_count+'][1][image_url]" data-height="80"/>\n' +
            //         '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            //         '  </div>\n' +
            //         ' </div>\n'+
            //
            //         '<div class="form-group col-md-4 option-'+total_option+'">\n' +
            //         '    <label for="alt_text">Alt Text</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tab_count+'][1][alt_text]"  class="form-control">\n' +
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
            //         '<div class="form-group col-md-6 option-'+total_option+'">\n' +
            //         '    <label for="title_en">Title En</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tab_count+'][1][title_en]"  class="form-control">\n' +
            //         '</div>\n' +
            //         '<div class="form-group col-md-6 option-'+total_option+'">\n' +
            //         '    <label for="title_bn">Title En</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tab_count+'][1][title_bn]"  class="form-control">\n' +
            //         '</div>\n' +
            //         '<slot';
            //
            //     $("#batch_component").append(tabField);
            //     dropify();
            //     summerNoteEditor();
            // });

            //Batches Component Dynamic Field Component
            // $(document).on('click', '.tab-multi-item', function (event) {
            //     var itemPlusBtn = $(event.target).attr('data-id');
            //     var option_count = $('.options-count');
            //     var total_option = option_count.length + 2;
            //
            //     var tabComCount = $('.'+itemPlusBtn).length + 1
            //     var tabCount = itemPlusBtn.split("_")[2]
            //
            //     var subItemInput =
            //         '<div class="col-md-12 col-xs-6 '+itemPlusBtn+' '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <h3><strong>Item '+tabComCount+'</strong></h3>\n' +
            //         '    <hr class="item-line">\n' +
            //         '</div>\n' +
            //
            //         '<div class="col-md-6 col-xs-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+tabCount+'">\n' +
            //         '<div class="form-group">\n' +
            //         '      <label for="message">Multiple Image</label>\n' +
            //         '      <input type="file" class="dropify" name="multi_item[data-'+tabCount+']['+tabComCount+'][image_url]" data-height="80"/>\n' +
            //         '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            //         '  </div>\n' +
            //         ' </div>\n'+
            //         '<div class="form-group col-md-4 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="alt_text">Alt Text</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tabCount+']['+tabComCount+'][alt_text]"  class="form-control">\n' +
            //         '</div>\n' +
            //
            //         '<div class="form-group col-md-1 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '   <label for="alt_text"></label>\n' +
            //         '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="'+itemPlusBtn+'_item_'+tabComCount+'" ><i data-id="'+itemPlusBtn+'_item_'+tabComCount+'" class="la la-trash"></i></button>\n' +
            //         '</div>'+
            //
            //         '<div class="form-group col-md-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_en">Title Bn</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tabCount+']['+tabComCount+'][title_en]" class="form-control">\n' +
            //         '</div>\n' +
            //         '<div class="form-group col-md-6 '+itemPlusBtn+'_item_'+tabComCount+'">\n' +
            //         '    <label for="title_bn">Title En</label>\n' +
            //         '    <input type="text" name="multi_item[data-'+tabCount+']['+tabComCount+'][title_bn]" class="form-control">\n' +
            //         '</div>';
            //     $("#"+itemPlusBtn).append(subItemInput);
            //     dropify();
            // });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });
        })
    </script>

@endpush







