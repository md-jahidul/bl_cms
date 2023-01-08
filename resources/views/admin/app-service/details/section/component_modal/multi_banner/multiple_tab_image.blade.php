{{ Form::hidden('sections[section_name]', 'Multi Tab Image Component' ) }}
{{ Form::hidden('sections[section_type]', 'multiple_tab_image' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'multiple_tab_image' ) }}
@php($component = (isset($component->multiple_attributes)) ? json_decode($component->multiple_attributes) : [])

<div class="col-sm-12 mb-2">
    <div class="add_button_wrap float-right">
        <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Tab</a>
    </div>
</div>
@if($component == [])
    <div id="multiple_tab_image">
        <div class="card" style="border: 2px solid steelblue">
            <div  class="row col-md-12">
                <div class="form-group col-md-6 {{ $errors->has('tab_title_en') ? ' error' : '' }}">
                    <label for="tab_title_en" class="required1">Tab Title (English)</label>
                    <input type="text" name="component[0][multi_tab_item][1][tab_title_en]" 
                    class="form-control" 
                    placeholder="Tab-1 En" 
                    required 
                    data-validation-required-message="Enter Tab Title En">
                    <div class="help-block"></div>  
                    @if ($errors->has('tab_title_en'))
                        <div class="help-block">  {{ $errors->first('tab_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-6 {{ $errors->has('tab_title_bn') ? ' error' : '' }}">
                    <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                    <input type="text" name="component[0][multi_tab_item][1][tab_title_bn]"  
                    class="form-control" placeholder="Tab-1 Bn" 
                    required data-validation-required-message="Enter Tab Title Bn">
                    <div class="help-block"></div>  
                    @if ($errors->has('tab_title_bn'))
                        <div class="help-block">  {{ $errors->first('tab_title_bn') }}</div>
                    @endif
                </div>
            </div>

            <div id="add-more-item-1">
                <div class="card-body" style="border-top: 2px solid steelblue" >
                    <div class="col-sm-12">
                        <div class="multiple_tab_image" data-count="1">
                            <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">
                            <input type="hidden" name="component[0][multi_tab_item][1][id-1]" value="1">
                            <input type="hidden" name="component[0][multi_tab_item][1][display_order-1]" value="0">
                            <input id="sub_item_count_1" type="hidden" name="component[0][multi_tab_item][1][sub_item_count]" value="1">

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required1"> Title (English)</label>
                                    <input type="text" name="component[0][multi_tab_item][1][title_en-1]"  class="form-control"
                                        value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required1"> Title (Bangla)</label>
                                    <input type="text" name="component[0][multi_tab_item][1][title_bn-1]"  class="form-control"
                                        value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Image (optional)</label>
                                    <div class="custom-file">
                                        <input type="file" name="component[0][multi_tab_item][1][image_url-1]" class="dropify">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required1">Alt Text</label>
                                    <input type="text" name="component[0][multi_tab_item][1][alt_text-1]"  class="form-control"
                                        value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="component[0][multi_tab_item][1][status-1]" aria-invalid="false">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-1">
                                    <button class="btn btn-info  btn-glow px-1 add_more_item" onclick="addMoreItem(1)">+</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>   
@else
    @foreach ($component as $key => $tab)
    <div id="multiple_tab_image">
        <div class="card" style="border: 2px solid steelblue">
            <div  class="row col-md-12">
                <div class="form-group col-md-6 {{ $errors->has('tab_title_en') ? ' error' : '' }}">
                    <label for="tab_title_en" class="required1">Tab Title (English)</label>
                    <input type="text" name="component[0][multi_tab_item][{{$key+1}}][tab_title_en]" 
                    value="{{ isset(current($tab)->tab_title_en) ? current($tab)->tab_title_en : '' }}" 
                    class="form-control" 
                    placeholder="Tab-1 En" 
                    required 
                    data-validation-required-message="Enter Tab Title En">
                    <div class="help-block"></div>  
                    @if ($errors->has('tab_title_en'))
                        <div class="help-block">  {{ $errors->first('tab_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-6 {{ $errors->has('tab_title_bn') ? ' error' : '' }}">
                    <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                    <input type="text" name="component[0][multi_tab_item][{{$key+1}}][tab_title_bn]"  
                    value="{{ isset(current($tab)->tab_title_bn) ? current($tab)->tab_title_bn : '' }}"
                    class="form-control" placeholder="Tab-1 Bn" 
                    required data-validation-required-message="Enter Tab Title Bn">
                    <div class="help-block"></div>  
                    @if ($errors->has('tab_title_bn'))
                        <div class="help-block">  {{ $errors->first('tab_title_bn') }}</div>
                    @endif
                </div>
            </div>
            @foreach ($tab as $k => $tData )
                <div id="add-more-item-{{$key+1}}">
                    <div class="card-body" style="border-top: 2px solid steelblue" >
                        <div class="col-sm-12">
                            <div class="multiple_tab_image" data-count="1">
                                <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="{{$key+1}}">
                                <input type="hidden" name="component[0][multi_tab_item][{{$key+1}}][id-{{$k}}]" value="{{$k}}">
                                <input type="hidden" name="component[0][multi_tab_item][{{$key+1}}][display_order-{{$k}}]" value="0">
                                <input id="sub_item_count_{{$key+1}}" type="hidden" name="component[0][multi_tab_item][{{$key+1}}][sub_item_count]" value="{{$k}}">

                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title_en" class="required1"> Title (English)</label>
                                        <input type="text" name="component[0][multi_tab_item][{{$key+1}}][title_en-{{$k}}]"  class="form-control"
                                            value="{{ !empty($tData->title_en) ? $tData->title_en : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title_bn" class="required1"> Title (Bangla)</label>
                                        <input type="text" name="component[0][multi_tab_item][{{$key+1}}][title_bn-{{$k}}]"  class="form-control"
                                            value="{{ !empty($tData->title_bn) ? $tData->title_bn : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                        <label for="alt_text" class="">Image (optional)</label>
                                        <div class="custom-file">
                                            <input type="file" name="component[0][multi_tab_item][{{$key+1}}][image_url-{{$k}}]"
                                            data-default-file="{{ (isset($tData->image_url) && $tData->image_url != []) ?  config('filesystems.file_base_url') . $tData->image_url : null  }}"
                                            class="dropify">
                                        </div>
                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                        <div class="help-block"></div>
                                        @if ($errors->has('image_url'))
                                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                        @endif
                                        <input type="hidden" name="component[0][multi_tab_item][{{$key+1}}][prev_image_url-{{$k}}]" value="{{ (isset($tData->image_url) && $tData->image_url != []) ? $tData->image_url : null  }}" />
                                    </div>

                                    <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label for="alt_text" class="required1">Alt Text</label>
                                        <input type="text" name="component[0][multi_tab_item][{{$key+1}}][alt_text-{{$k}}]"  class="form-control"
                                            value="{{ !empty($tData->alt_text) ? $tData->alt_text : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('alt_text'))
                                            <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="component[0][multi_tab_item][{{$key+1}}][status-{{$k}}]" aria-invalid="false">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <button class="btn btn-info  btn-glow px-1 add_more_item" onclick="addMoreItem('{{$key+1}}')">+</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            @endforeach  
        </div>
    </div>   
    @endforeach
@endif



<div class="form-group col-md-6">
    <!-- 0 - NO, 1 - Yes : Component has multiple component or not -->
    {{ Form::hidden('sections[multiple_component]', 0 ) }}
</div>

{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}



@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <style>
        .modal-xl.modal_xl_custom {
            max-width: 80%;
            margin-left: 10%;
            margin-right: 10%;
        }

        #accordion {
            margin:20px;
            min-height:300px;
        }
    </style>
@endpush



@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var $padrentSelector = $('#multiple_tab_image');
            // Add multiple item
            $('.add_moreslider_item').on('click', function(event){
                event.preventDefault();

                var i = parseInt($padrentSelector.find('#multi_item_count').val(), 10);
                // $('#slider_content_section').empty();
                i = i+1;
                var html = '';
                html += `<div id="multiple_tab_image" class="single_slider_content">
                            <div class="card" style="border: 2px solid steelblue">
                                <div  class="row col-md-12">
                                    <div class="form-group col-md-5 {{ $errors->has('tab_title_en') ? ' error' : '' }}">
                                        <label for="tab_title_en" class="required1">Tab Title (English)</label>
                                        <input type="text" name="component[0][multi_tab_item][${i}][tab_title_en]"  class="form-control" placeholder="Tab-1 En" required data-validation-required-message="Enter Tab Title En">
                                        <div class="help-block"></div>  
                                        @if ($errors->has('tab_title_en'))
                                            <div class="help-block">  {{ $errors->first('tab_title_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-5 {{ $errors->has('tab_title_bn') ? ' error' : '' }}">
                                        <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                                        <input type="text" name="component[0][multi_tab_item][${i}][tab_title_bn]"  class="form-control" placeholder="Tab-1 Bn" required data-validation-required-message="Enter Tab Title Bn">
                                        <div class="help-block"></div>  
                                        @if ($errors->has('tab_title_bn'))
                                            <div class="help-block">  {{ $errors->first('tab_title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <button class="btn btn-danger multi_item_remove" style="margin-top: 15px;"><i class="la la-trash"></i></button>
                                    </div>

                                    
                                </div>
                                <div id="add-more-item-${i}">
                                    <div class="card-body" style="border-top: 2px solid steelblue" >
                                        <div class="col-sm-12">
                                            <div class="multiple_tab_image" data-count="1">
                                                <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="${i}">
                                                <input type="hidden" name="component[0][multi_tab_item][${i}][id-1]" value="1">
                                                <input type="hidden" name="component[0][multi_tab_item][${i}][display_order-1]" value="1">
                                                <input id="sub_item_count_${i}" type="hidden" name="component[0][multi_tab_item][${i}][sub_item_count]" value="1">


                                                <div class="row">
                                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                                        <label for="title_en" class="required1"> Title (English)</label>
                                                        <input type="text" name="component[0][multi_tab_item][${i}][title_en-1]"  class="form-control"
                                                            value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_en'))
                                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                        <label for="title_bn" class="required1"> Title (Bangla)</label>
                                                        <input type="text" name="component[0][multi_tab_item][${i}][title_bn-1]"  class="form-control"
                                                            value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('title_bn'))
                                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                                        <label for="alt_text" class="">Image (optional)</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="component[0][multi_tab_item][${i}][image_url-1]" class="dropify">
                                                        </div>
                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                                        <div class="help-block"></div>
                                                        @if ($errors->has('image_url'))
                                                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                        <input type="text" name="component[0][multi_tab_item][${i}][alt_text-1]"  class="form-control"
                                                            value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                                        <div class="help-block"></div>
                                                        @if ($errors->has('alt_text'))
                                                            <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" name="component[0][multi_tab_item][${i}][status-1]" aria-invalid="false">
                                                            <option value="1" selected>Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-1">
                                                        <button class="btn btn-info  btn-glow px-1 add_more_item" onclick="addMoreItem(${i})">+</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            
                        </div>`;


                $('#multiple_tab_image').append(html);

                $('.dropify').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    },
                    height: 100
                });


                $padrentSelector.find('#multi_item_count').val(i);


            });
            $(document).on('click', '.multi_item_remove', function(e){
                e.preventDefault();
                $(this).parents('.single_slider_content').remove();
            });

            $(document).on('click', '.multi_image_item', function(e){
                e.preventDefault();
                $(this).parents('.multi_image_item').remove();
            });
            

            

        }); // doc ready


        // Add More Item ======
        function addMoreItem(item){ 
                var id = '#add-more-item-' + item;
                //i = item+1;
                var count = $('#sub_item_count_' + item).val();
                i = parseInt(count) + 1; 
                var html = '';
                html += `<div class="card-body multi_image_item" style="border-top: 2px solid steelblue" >
                        <div class="col-sm-12">
                            <div class="multiple_tab_image" data-count="1">
                                <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">
                                <input type="hidden" name="component[0][multi_tab_item][${item}][id-${i}]" value="${i}">
                                <input type="hidden" name="component[0][multi_tab_item][${item}][display_order-${i}]" value="${i}">


                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title_en" class="required1"> Title (English)</label>
                                        <input type="text" name="component[0][multi_tab_item][${item}][title_en-${i}]"  class="form-control"
                                            value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title_bn" class="required1"> Title (Bangla)</label>
                                        <input type="text" name="component[0][multi_tab_item][${item}][title_bn-${i}]"  class="form-control"
                                            value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('image_url') ? ' error' : '' }}">
                                        <label for="alt_text" class="">Image (optional)</label>
                                        <div class="custom-file">
                                            <input type="file" name="component[0][multi_tab_item][${item}][image_url-${i}]" class="dropify">
                                        </div>
                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                        <div class="help-block"></div>
                                        @if ($errors->has('image_url'))
                                            <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label for="alt_text" class="required1">Alt Text</label>
                                        <input type="text" name="component[0][multi_tab_item][${item}][alt_text-${i}]"  class="form-control"
                                            value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                        <div class="help-block"></div>
                                        @if ($errors->has('alt_text'))
                                            <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="component[0][multi_tab_item][${item}][status-${i}]" aria-invalid="false">
                                            <option value="1" selected>Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <button class="btn btn-info  btn-glow px-1 add_more_item" onclick="addMoreItem(${item})" style="margin-top: 15px;">+</button>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button class="btn btn-danger multi_image_item" style="margin-top: 15px;">x</button>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div>`;

                //$(id).append(html);
                $(id).append(html)
                $('#sub_item_count_'+item).val(i);

                $('.dropify').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    },
                    height: 100
                });
        }

        

    </script>




@endpush
