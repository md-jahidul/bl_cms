{{ Form::hidden('sections[section_name]', 'Title with Text Editor' ) }}
{{ Form::hidden('sections[section_type]', 'title_text_editor' ) }}
{{--{{ Form::hidden('sections[tab_type]', $tab_type ) }}--}}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'title_text_editor' ) }}

<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en" class="required1">
        Title (English)
    </label>
    <input type="text" name="component[0][title_en]"  class="form-control" placeholder="Enter title"
           value="{{ isset($component->title_en) ? $component->title_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="required1">
        Title (Bangla)
    </label>
    <input type="text" name="component[0][title_bn]"  class="form-control" placeholder="Enter title"
           value="{{ isset($component->title_bn) ? $component->title_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (English)</label>
        <textarea name="component[0][editor_en]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (Bangla)</label>
        <textarea name="component[0][editor_bn]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
    </div>
</div>

{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}











<!-- Modal -->
{{--<div class="modal fade" id="title_text_editor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-xl modal_xl_custom " role="document">--}}
{{--        <div class="modal-content">--}}
{{--          <div class="modal-header">--}}
{{--            <h4 class="modal-title" id="exampleModalLabel"><strong>Component: Text with image right</strong></h4>--}}
{{--            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--              <span aria-hidden="true">&times;</span>--}}
{{--            </button>--}}
{{--          </div>--}}
{{--            <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--              <div class="modal-body">--}}
{{--                <div class="row">--}}
{{--                		{{ Form::hidden('sections[section_name]', 'Title with Text Editor' ) }}--}}
{{--                		{{ Form::hidden('sections[section_type]', 'title_text_editor' ) }}--}}
{{--                		{{ Form::hidden('sections[tab_type]', $tab_type ) }}--}}
{{--                		{{ Form::hidden('sections[category]', 'component_sections' ) }}--}}
{{--                		{{ Form::hidden('component[0][component_type]', 'title_text_editor' ) }}--}}


{{--                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">--}}
{{--                      <label for="title_en" class="required1">--}}
{{--                          Title (English)--}}
{{--                      </label>--}}
{{--                      <input type="text" name="component[0][title_en]"  class="form-control" placeholder="Enter title"--}}
{{--                             value="{{ old("title_en") ? old("title_en") : '' }}">--}}
{{--                      <div class="help-block"></div>--}}
{{--                      @if ($errors->has('title_en'))--}}
{{--                          <div class="help-block">  {{ $errors->first('title_en') }}</div>--}}
{{--                      @endif--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">--}}
{{--                       <label for="title_bn" class="required1">--}}
{{--                           Title (Bangla)--}}
{{--                       </label>--}}
{{--                       <input type="text" name="component[0][title_bn]"  class="form-control" placeholder="Enter title"--}}
{{--                              value="{{ old("title_bn") ? old("title_bn") : '' }}">--}}
{{--                       <div class="help-block"></div>--}}
{{--                       @if ($errors->has('title_bn'))--}}
{{--                           <div class="help-block">  {{ $errors->first('title_bn') }}</div>--}}
{{--                       @endif--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                       <div class="form-group">--}}
{{--                           <label for="exampleInputPassword1">Description (English)</label>--}}
{{--                           <textarea name="component[0][editor_en]" class="form-control summernote_editor" rows="5"--}}
{{--                                     placeholder="Enter description">{{ isset($ecarrer_item->editor_en) ? $ecarrer_item->editor_en : '' }}</textarea>--}}
{{--                       </div>--}}
{{--                     </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                       <div class="form-group">--}}
{{--                           <label for="exampleInputPassword1">Description (Bangla)</label>--}}
{{--                           <textarea name="component[0][editor_bn]" class="form-control summernote_editor" rows="5"--}}
{{--                                     placeholder="Enter description">{{ isset($ecarrer_item->editor_bn) ? $ecarrer_item->editor_bn : '' }}</textarea>--}}
{{--                       </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="title" class="mr-1">Status:</label>--}}
{{--                            <input type="radio" name="sections[status]" value="1" id="active" checked>--}}
{{--                            <label for="active" class="mr-1">Active</label>--}}

{{--                            <input type="radio" name="sections[status]" value="0" id="inactive">--}}
{{--                            <label for="inactive">Inactive</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group col-md-6">--}}
{{--                        <!-- 0 - NO, 1 - Yes : Component has multiple component or not -->--}}
{{--                        {{ Form::hidden('sections[multiple_component]', 0 ) }}--}}
{{--                    </div>--}}


{{--                </div>--}}

{{--              </div>--}}
{{--              <div class="modal-footer">--}}
{{--              		{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}--}}
{{--              		{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}--}}

{{--                <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>--}}
{{--                <button id="form_save" type="submit" name="save" class="btn btn-primary">Save changes</button>--}}
{{--                <button id="form_update" type="submit" name="update" class="btn btn-primary" style="display: none;">Update</button>--}}
{{--              </div>--}}
{{--          </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div><!-- /.modal -->--}}
{{--<!-- Modal -->--}}


{{--@push('page-css')--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">--}}
{{-- <style>--}}
{{--     .modal-xl.modal_xl_custom {--}}
{{--         max-width: 80%;--}}
{{--         margin-left: 10%;--}}
{{--       	margin-right: 10%;--}}
{{--     }--}}
{{-- </style>--}}
{{--@endpush--}}



{{--@push('page-js')--}}
{{--<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>--}}

{{--<!-- include summernote css/js-->--}}
{{--<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" rel="stylesheet">--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.js"></script>--}}

{{--<script src="https://rawgit.com/tylerecouture/summernote-table-headers/master/summernote-table-headers.js" type="text/javascript"></script>--}}
{{--<script>--}}
{{--    $(function () {--}}

{{--        // $('.js_editor_box').text("Summernote Data");--}}

{{--         // $('.js_editor_box').each(function(k, v){--}}
{{--         //    $(this).summernote({--}}
{{--         //        toolbar: [--}}
{{--         //            ['style', ['style'], ['bold', 'italic', 'underline', 'clear']],--}}
{{--         //            ['font', ['strikethrough', 'superscript', 'subscript']],--}}
{{--         //            ['fontsize', ['fontsize']],--}}
{{--         //            ['color', ['color']],--}}
{{--         //            ['table', ['table']],--}}
{{--         //            ['para', ['ul', 'ol', 'paragraph']],--}}
{{--         //            ['view', ['fullscreen', 'codeview']],--}}
{{--         //            ['insert', ['link', 'picture', 'hr']]--}}
{{--         //        ],--}}
{{--         //        height:200--}}
{{--         //    });--}}
{{--         // });--}}

{{--     })--}}
{{-- </script>--}}
{{-- @endpush--}}
