@extends('layouts.admin')
@section('title', 'Partner Create')
@section('card_name', 'Partner Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('partners') }}"> Partner List</a></li>
    <li class="breadcrumb-item active"> Partner Create</li>
@endsection
@section('action')
    <a href="{{  route('component-list', [ $productDetailsId, $sectionId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>



        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('component-update',[$productDetailsId, $sectionId, $component->id]) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
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
                                                            <input type="checkbox" id="input-text" {{ $component->title_en || $component->title_bn ? 'checked' : '' }}>
                                                            <label for="input-text" class="">Text Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="text-area" {{ $component->description_en || $component->description_bn ? 'checked' : '' }}>
                                                            <label for="text-area" class="">TextArea</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="text-editor" {{ $component->editor_en || $component->editor_bn ? 'checked' : '' }}>
                                                            <label for="text-editor" class="">Text Editor</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="dropdown" {{ $component->component_type == "drop_down" ? 'checked' : '' }}>
                                                            <label for="text-editor" class="">Dropdown</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="image-field" {{ $component->image ? 'checked' : '' }}>
                                                            <label for="image-field" class="">Image Field</label>
                                                        </fieldset>

                                                        <fieldset>
                                                            <input type="checkbox" id="multi-image" {{ $component->multiple_attributes ? 'checked' : '' }}>
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

                                                <div class="form-group col-md-12 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                    <label for="editor_en" >Data Type</label>

                                                    <select name="component_type" class="form-control" required data-validation-required-message="Please select design structure">
                                                        <option value="">--Select Data Type--</option>
                                                        {{ $component->component_type }}
                                                        @foreach($dataTypes as $key => $type)
                                                            <option value="{{ $key }}" {{ ($component->component_type == $key) ? 'selected' : '' }}>{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="help-block"></div>
                                                    @if ($errors->has('editor_en'))
                                                        <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                    @endif
                                                </div>

                                                <slot id="text-field" class="{{ ($component->title_en || $component->title_bn) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                        <label for="title_en">Text Field (English)</label>
                                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ $component->title_en }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_en'))
                                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                        <label for="title_bn" >Text Field (Bangla)</label>
                                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter company name bangla"
                                                               value="{{ $component->title_bn }}">
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_bn'))
                                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-area-field" class="{{ ( $component->description_en || $component->description_en ) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                                        <label for="description_en" >Text Area (English)</label>
                                                        <textarea name="description_en"  class="form-control" placeholder="Enter company name bangla">{{ $component->description_en }}</textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_en'))
                                                            <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                                        @endif
                                                    </div>


                                                    <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                                        <label for="description_bn" >Text Area (Bangla)</label>
                                                        <textarea name="description_bn" class="form-control" placeholder="Enter company name bangla">{{ $component->description_bn }}  </textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('description_bn'))
                                                            <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="text-editor-field" class="{{ ( $component->editor_en || $component->editor_bn ) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                        <label for="editor_en">Text Editor (English)</label>
                                                        <textarea type="text" name="editor_en"  class="form-control" placeholder="Enter offer details in english" id="details">{{ $component->editor_en }}</textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_en'))
                                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('editor_bn') ? ' error' : '' }}">
                                                        <label for="editor_bn">Text Editor (Bangla)</label>
                                                        <textarea type="text" name="editor_bn"  class="form-control" placeholder="Enter offer details in english"  id="details">{{ $component->editor_bn }}</textarea>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_bn'))
                                                            <div class="help-block">{{ $errors->first('editor_bn') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>


                                                <slot id="dropdown_field" class="{{ (isset($component->other_attributes['dropdown_data_type'])) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6">
                                                        <label for="editor_bn" class="text-success">Drop Down Sample Picture</label>
                                                        <img class=" img-fluid" src="{{ asset('sample-images/drop_down.png') }}" alt="Image description">
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('editor_en') ? ' error' : '' }}">
                                                        <label for="editor_en" class="required" >Drop Down Data</label>
                                                        <select name="other_attributes[dropdown_data_type]" class="form-control required">
                                                            <option value="">--Select Dropdown Data Type--</option>
                                                            <option value="easy_payment_card" {{ $component->other_attributes['dropdown_data_type'] == "easy_payment_card" ? 'selected' : '' }}>Easy Payment Card</option>
                                                            <option value="device_data_offer" {{ $component->other_attributes['dropdown_data_type'] == "device_data_offer" ? 'selected' : '' }}>Device Free Data Offer</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('editor_en'))
                                                            <div class="help-block">{{ $errors->first('editor_en') }}</div>
                                                        @endif
                                                    </div>
                                                </slot>

                                                <slot id="single-image" class="{{ ( $component->image ) ? '' : "d-none" }}">
                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="">Image Field</label>
                                                        <div class="custom-file">
                                                            <input type="file"  name="image" class="dropify" data-height="80"
                                                               data-default-file="{{ config('filesystems.file_base_url') . $component->image }}" >
                                                            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                        <input type="text" name="alt_text" value="{{ $component->alt_text }}" class="form-control">
                                                    </div>
                                                </slot>

                                                <slot id="multiple-image-field" class="{{ ( isset($component->multiple_attributes['image']) ) ? '' : "d-none" }}">
                                                    @php( $i = 0 )
                                                    @if(isset($multipleImage['image']))
                                                        @foreach($multipleImage['image'] as $key => $image)
                                                            @php($i++)
                                                            <div class="col-md-6 col-xs-6 option-{{ $i }} options-count">
                                                                <div class="form-group">
                                                                    <label for="message">Multiple Image</label>
                                                                    <input type="file" class="dropify" name="multiple_attributes[image][image_url_{{ $i }}]"
                                                                           data-default-file="{{ config('filesystems.file_base_url') . $image }}"
                                                                           data-height="80"/>
                                                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-5 option-{{ $i }}">
                                                                <label for="alt_text">Alt Text</label>
                                                                <input type="text" name="multiple_attributes[alt_text][alt_text_{{ $i }}]" value="{{ $multipleImage['alt_text']["alt_text_$i"] }}"  class="form-control">
                                                            </div>

                                                            @if($i == 1)
                                                                <div class="form-group col-md-1">
                                                                    <label for="alt_text"></label>
                                                                    <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
                                                                </div>
        {{--                                                    @else--}}
        {{--                                                        <div class="form-group col-md-1 option-{{ $i }}">--}}
        {{--                                                            <label for="alt_text"></label>--}}
        {{--                                                            <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-{{ $i }}" ><i data-id="option-{{ $i }}" class="la la-trash"></i></button>--}}
        {{--                                                        </div>--}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </slot>

                                                <div class="form-actions col-md-12">
                                                    <div class="pull-right">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="la la-check-square-o"></i> Update
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
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
                height:200
            })

            $(document).on('click', '#plus-image', function () {
                var option_count = $('.options-count');
                var total_option = option_count.length + 1;

                var input = '<div class="col-md-6 col-xs-6 options-count option-'+total_option+'">\n' +
                    '<div class="form-group">\n' +
                    '      <label for="message">Multiple Image</label>\n' +
                    '      <input type="file" class="dropify" name="multiple_attributes[image][image_url_'+total_option+']" data-height="80"/>\n' +
                    '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                    '  </div>\n' +
                    ' </div>\n'+
                    '<div class="form-group col-md-5 option-'+total_option+'">\n' +
                    '    <label for="alt_text">Alt Text</label>\n' +
                    '    <input type="text" name="multiple_attributes[alt_text][alt_text_'+total_option+']"  class="form-control">\n' +
                    '</div>\n' +
                    '<div class="form-group col-md-1 option-'+total_option+'">\n' +
                    '   <label for="alt_text"></label>\n' +
                    '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-'+total_option+'" ><i data-id="option-'+total_option+'" class="la la-trash"></i></button>\n' +
                    '</div>';
                $('#multiple-image-field').append(input);
                //Call dropify Function
                dropify();
            });

            $(document).on('click', '.remove-image', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.'+rowId).remove();
            });


        })
    </script>

@endpush







