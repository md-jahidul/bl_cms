{{ Form::hidden('sections[section_name]', 'Accordion' ) }}
{{ Form::hidden('sections[section_type]', 'accordion_section' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'accordion' ) }}

{{--{{ dd($component) }}--}}

{{--<input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">--}}

<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en" class="required">Title (English)</label>
    <input type="text" name="component[0][title_en]"  class="form-control"
           value="{{ !empty($component->title_en) ? $component->title_en : '' }}" required>
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="required">Title (Bangla)</label>
    <input type="text" name="component[0][title_bn]"  class="form-control"
           value="{{ !empty($component->title_bn) ? $component->title_bn : '' }}" required>
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Accordion content (English)</label>
        <textarea name="component[0][editor_en]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Accordion content (Bangla)</label>
        <textarea name="component[0][editor_bn]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
    </div>
</div>

{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}


<div class="form-group col-md-6">
    <!-- 0 - NO, 1 - Yes : Component has multiple component or not -->
{{--    {{ Form::hidden('sections[multiple_component]', 0 ) }}--}}
</div>





<!-- Modal -->
{{--<div class="modal fade" id="accordion_section" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--      <div class="modal-dialog modal-lg modal_lg_custom" role="document">--}}
{{--            <div class="modal-content">--}}
{{--               <div class="modal-header">--}}
{{--                  <h4 class="modal-title" id="exampleModalLabel"><strong>Component: Accordion</strong></h4>--}}
{{--                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                     <span aria-hidden="true">&times;</span>--}}
{{--                  </button>--}}

{{--               </div>--}}
{{--                  <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                     <div class="modal-body">--}}
{{--                        <div class="row">--}}
{{--                           <div class="col-sm-12">--}}
{{--                              <div class="add_button_wrap float-right">--}}
{{--                                <a href="#" class="btn btn-info  btn-glow px-1 add_accordion_item_more">+ Add Item</a>--}}
{{--                              </div>--}}
{{--                           </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}

{{--                              {{ Form::hidden('sections[section_name]', 'Accordion' ) }}--}}
{{--                              {{ Form::hidden('sections[section_type]', 'accordion_section' ) }}--}}
{{--                              {{ Form::hidden('sections[tab_type]', $tab_type ) }}--}}
{{--                              {{ Form::hidden('sections[category]', 'component_sections' ) }}--}}
{{--                              {{ Form::hidden('component[0][component_type]', 'accordion' ) }}--}}

{{--                           <div class="col-sm-12">--}}

{{--                              <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">--}}

{{--                              <div id="accordion" class="accordion_compoent_0 accordion_header_custom" data-component_id="">--}}

{{--                                 <!-- accordion item start -->--}}
{{--                                <div class="card accordion collapse-icon accordion-icon-rotate" data-index="1" data-position="1">--}}
{{--                                    <input type="hidden" name="component[0][multi_item][id-1]" value="1">--}}
{{--                                    <input type="hidden" name="component[0][multi_item][display_order-1]" value="1">--}}

{{--                                  <div class="card-header bg-info info">--}}

{{--                                    <div class="row">--}}
{{--                                       <div class="col-sm-12 m_bottom_6">--}}
{{--                                          <a class="card-link collapsed" data-toggle="collapse" href="#collapse_1" aria-expanded="false">--}}
{{--                                            <strong><i class="la la-sort"></i> Accordion Title #1</strong>--}}
{{--                                          </a>--}}
{{--                                       </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="row card_header_extra">--}}
{{--                                       <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">--}}
{{--                                          <label for="title_en" class="required">Title (English)</label>--}}
{{--                                          <input type="text" name="component[0][multi_item][title_en-1]"  class="form-control"--}}
{{--                                                 value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" required>--}}
{{--                                          <div class="help-block"></div>--}}
{{--                                          @if ($errors->has('title_en'))--}}
{{--                                              <div class="help-block">  {{ $errors->first('title_en') }}</div>--}}
{{--                                          @endif--}}
{{--                                       </div>--}}

{{--                                       <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">--}}
{{--                                          <label for="title_bn" class="required">Title (Bangla)</label>--}}
{{--                                          <input type="text" name="component[0][multi_item][title_bn-1]"  class="form-control"--}}
{{--                                                 value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" required>--}}
{{--                                          <div class="help-block"></div>--}}
{{--                                          @if ($errors->has('title_bn'))--}}
{{--                                              <div class="help-block">  {{ $errors->first('title_bn') }}</div>--}}
{{--                                          @endif--}}
{{--                                       </div>--}}

{{--                                    </div>--}}

{{--                                  </div>--}}
{{--                                  <div id="collapse_1" class="collapse show1 border-info" data-parent="#accordion">--}}
{{--                                    <div class="card-body">--}}

{{--                                       <div class="row">--}}


{{--                                          <div class="col-md-6">--}}
{{--                                             <div class="form-group">--}}
{{--                                                 <label for="exampleInputPassword1">Accordion content (English)</label>--}}
{{--                                                 <textarea name="component[0][multi_item][editor_en-1]" class="form-control js_editor_box" rows="5"--}}
{{--                                                           placeholder="Enter description"></textarea>--}}
{{--                                             </div>--}}
{{--                                          </div>--}}

{{--                                          <div class="col-md-6">--}}
{{--                                             <div class="form-group">--}}
{{--                                                 <label for="exampleInputPassword1">Accordion content (Bangla)</label>--}}
{{--                                                 <textarea name="component[0][multi_item][editor_bn-1]" class="form-control js_editor_box" rows="5"--}}
{{--                                                           placeholder="Enter description">{{ isset($ecarrer_item->editor_bn) ? $ecarrer_item->editor_bn : '' }}</textarea>--}}
{{--                                             </div>--}}
{{--                                          </div>--}}

{{--                                       </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="card-footer">--}}
{{--                                       <div class="row">--}}
{{--                                          <div class="col-md-6">--}}
{{--                                             <div class="form-group1">--}}
{{--                                                <label for="title" class="mr-1">Status:</label>--}}
{{--                                                <input type="radio" name="component[0][multi_item][status-1]" value="1" checked>--}}
{{--                                                <label for="active" class="mr-1">Active</label>--}}

{{--                                                <input type="radio" name="component[0][multi_item][status-1]" value="0">--}}
{{--                                                <label for="inactive">Inactive</label>--}}
{{--                                             </div>--}}
{{--                                          </div>--}}

{{--                                          <div class="col-md-6">--}}
{{--                                             <div class="delete_accordion_item float-right">--}}
{{--                                                <a href="#" class="border-0 btn-sm btn-outline-danger delete_btn" data-item_id="1" title="Delete">--}}
{{--                                                   <i class="la la-trash"></i>--}}
{{--                                                </a>--}}
{{--                                             </div>--}}
{{--                                          </div>--}}
{{--                                       </div>--}}

{{--                                    </div>--}}

{{--                                  </div>--}}
{{--                                </div> <!-- .card.accordion -->--}}




{{--                              </div> <!-- #accordion -->--}}





{{--                              <hr class="hr">--}}
{{--                             <br>--}}

{{--                           </div>--}}


{{--                           <div class="multi_attr_update_hide col-md-6">--}}
{{--                              <div class="form-group">--}}
{{--                                 <label for="title" class="mr-1">Status:</label>--}}
{{--                                 <input type="radio" name="sections[status]" value="1" id="active" checked>--}}
{{--                                 <label for="active" class="mr-1">Active</label>--}}

{{--                                 <input type="radio" name="sections[status]" value="0" id="inactive">--}}
{{--                                 <label for="inactive">Inactive</label>--}}
{{--                              </div>--}}
{{--                           </div>--}}

{{--                           <div class="form-group col-md-6">--}}
{{--                                 <!-- 0 - NO, 1 - Yes : Component has multiple component or not -->--}}
{{--                                 {{ Form::hidden('sections[multiple_component]', 0 ) }}--}}
{{--                           </div>--}}



{{--                        </div>--}}

{{--                     </div>--}}
{{--                     <div class="modal-footer">--}}
{{--                           {{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}--}}
{{--                           {{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}--}}

{{--                        <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>--}}
{{--                        <button id="form_save" type="submit" name="save" class="btn btn-primary">Save changes</button>--}}
{{--                        <button id="form_update" type="submit" name="update" value="full_update_multi_attr" class="btn btn-primary" style="display: none;">Update</button>--}}
{{--                         <button id="form_multi_attr_update" type="submit" name="compnent_muti_attr_update" class="btn btn-primary" style="display: none;">Update</button>--}}
{{--                     </div>--}}
{{--               </form>--}}
{{--            </div>--}}
{{--      </div>--}}
{{--</div><!-- /.modal -->--}}
{{--<!-- Modal -->--}}
{{--@push('page-css')--}}
{{-- <style>--}}
{{--       .modal-xl.modal_xl_custom {--}}
{{--             max-width: 80%;--}}
{{--             margin-left: 10%;--}}
{{--            margin-right: 10%;--}}
{{--       }--}}

{{--      .m_bottom_6{--}}
{{--         margin-bottom: 6px;--}}
{{--      }--}}

{{--      #accordion {--}}
{{--          margin:20px;--}}
{{--          min-height:300px;--}}
{{--      }--}}

{{--      #accordion.accordion_header_custom{--}}

{{--      }--}}

{{--      #accordion.accordion_header_custom .card-header.bg-info.info{--}}

{{--      }--}}

{{--      #accordion.accordion_header_custom .card-header.bg-info.info .card-link{--}}
{{--         color: #fff;--}}
{{--         margin-bottom: 6px;--}}
{{--      }--}}

{{--      #accordion.accordion_header_custom .card-header.bg-info.info .card_header_extra label{--}}
{{--         color: #fff;--}}
{{--      }--}}
{{-- </style>--}}
{{--@endpush--}}

{{--@push('page-js')--}}
{{--<script type="text/javascript">--}}
{{--   jQuery(document).ready(function ($) {--}}

{{--      // Add multiple item--}}
{{--      $('.add_accordion_item_more').on('click', function(){--}}

{{--         $parentSelector = $('#accordion_section');--}}

{{--        var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);--}}

{{--        i = i+1;--}}

{{--        var html = '';--}}

{{--        html += '<div class="card accordion collapse-icon accordion-icon-rotate" data-index="'+i+'" data-position="'+i+'"><input type="hidden" name="component[0][multi_item][id-'+i+']" value="'+i+'"><input type="hidden" name="component[0][multi_item][display_order-'+i+']" value="'+i+'"><div class="card-header bg-info info"> <div class="row"> <div class="col-sm-12 m_bottom_6"> <a class="card-link collapsed" data-toggle="collapse" href="#collapse_'+i+'" aria-expanded="false"> <strong><i class="la la-sort"></i> Accordion Title #'+i+'</strong> </a> </div></div><div class="row card_header_extra"> <div class="form-group col-md-6 "> <label for="title_en" class="required">Title (English)</label> <input type="text" name="component[0][multi_item][title_en-'+i+']" class="form-control" value="" required="true" aria-invalid="false"> <div class="help-block"></div></div><div class="form-group col-md-6 "> <label for="title_bn" class="required">Title (Bangla)</label> <input type="text" name="component[0][multi_item][title_bn-'+i+']" class="form-control" value="" required="true"> <div class="help-block"></div></div></div></div><div id="collapse_'+i+'" class="collapse show1 border-info" data-parent="#accordion"> <div class="card-body"> <div class="row"><div class="col-md-6"> <div class="form-group"> <label for="exampleInputPassword1">Accordion content (English)</label> <textarea name="component[0][multi_item][editor_en-'+i+']" class="form-control js_editor_box" rows="5" placeholder="Enter description"></textarea> </div></div><div class="col-md-6"> <div class="form-group"> <label for="exampleInputPassword1">Accordion content (Bangla)</label> <textarea name="component[0][multi_item][editor_bn-'+i+']" class="form-control js_editor_box" rows="5" placeholder="Enter description"></textarea> </div></div></div></div><div class="card-footer"> <div class="row"> <div class="col-md-6"> <div class="form-group1"> <label for="title" class="mr-1">Status:</label> <input type="radio" name="component[0][multi_item][status-'+i+']" value="1" checked> <label for="active" class="mr-1">Active</label> <input type="radio" name="component[0][multi_item][status-'+i+']" value="0"> <label for="inactive">Inactive</label> </div></div><div class="col-md-6"> <div class="float-right"> <a href="#" class="border-0 btn-sm btn-outline-danger delete_accordion_item" data-item_id="'+i+'" title="Delete"> <i class="la la-trash"></i> </a> </div></div></div></div></div></div>';--}}

{{--        $parentSelector.find('#accordion').append(html);--}}

{{--        $parentSelector.find('#multi_item_count').val(i);--}}


{{--        // editor reload--}}
{{--        $parentSelector.find('.js_editor_box').each(function(k, v){--}}
{{--           $(this).summernote({--}}
{{--               toolbar: [--}}
{{--                   ['style', ['bold', 'italic', 'underline', 'clear']],--}}
{{--                   ['font', ['strikethrough', 'superscript', 'subscript']],--}}
{{--                   ['fontsize', ['fontsize']],--}}
{{--                   ['color', ['color']],--}}
{{--                   // ['table', ['table']],--}}
{{--                   ['para', ['ul', 'ol', 'paragraph']],--}}
{{--                   ['view', ['fullscreen', 'codeview']]--}}
{{--               ],--}}
{{--               height:200--}}
{{--           });--}}
{{--        });--}}
{{--      });--}}

{{--      $(document).on('click', '.delete_accordion_item', function(e){--}}
{{--        e.preventDefault();--}}
{{--        if( confirm('Are you sure you want to delete? Click update after delete.') ){--}}
{{--         $(this).parents('.card.accordion').remove();--}}
{{--        }--}}
{{--      });--}}
{{--   }); // doc ready--}}
{{--</script>--}}
{{--@endpush--}}
