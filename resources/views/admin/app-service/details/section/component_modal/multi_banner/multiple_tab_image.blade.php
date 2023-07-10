{{ Form::hidden('sections[section_name]', 'Multi Tab Image Component' ) }}
{{ Form::hidden('sections[section_type]', 'multiple_tab_image' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'multiple_tab_image' ) }}

<div class="col-sm-12 mb-2">
    <div class="add_button_wrap float-right">
        <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Tab</a>
    </div>
</div>

@php
    $count = (isset($component->multiple_attributes))? count($component->multiple_attributes) : 1 ;
@endphp
<input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="{{$count}}">

@if (isset($component->multiple_attributes))
    @foreach ($component->multiple_attributes as $key => $tab)
        <div id="multiple_tab_image_sec">
            <div class="card">
                <fieldset class="tab_card">
                    <label for="image_card">Tab {{$key+1}}:</label>
                    <hr>
                    <div  class="row col-md-12">

                        <input type="hidden" name="component[0][multi_tab_item][id-{{$key+1}}]" value="{{$key+1}}">
                        <input type="hidden" name="component[0][multi_tab_item][display_order-{{$key+1}}]" value="{{$key+1}}">

                        <div class="form-group col-md-6">
                            <label for="tab_title_en" class="required1">Tab Title (English)</label>
                            <input type="text" name="component[0][multi_tab_item][tab_title_en-{{$key+1}}]" 
                            value="{{ isset($tab['tab_title_en']) ? $tab['tab_title_en'] : '' }}" 
                            class="form-control" 
                            placeholder="Tab-{{$key+1}} English" 
                            required 
                            data-validation-required-message="Enter Tab Title En">
                            <div class="help-block"></div>  
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                            <input type="text" name="component[0][multi_tab_item][tab_title_bn-{{$key+1}}]"  
                            value="{{ isset($tab['tab_title_bn']) ? $tab['tab_title_bn'] : '' }}"
                            class="form-control" placeholder="Tab-{{$key+1}} Bangla" 
                            required data-validation-required-message="Enter Tab Title Bn">
                            <div class="help-block"></div>
                        </div>

                        <div class="form-group col-md-12">
                            <fieldset class="image_card">
                                <label for="image_card">Images:</label>

                                @php
                                    $count = (isset($tab['image_array']))? count($tab['image_array']) : 0 ;
                                @endphp
                                <input id="multi_image_item_count_{{$key+1}}" type="hidden" value="{{$count}}">

                                @foreach ($tab['image_array'] as $k => $single_image_array )
                                    <div id="add-more-item-{{$key+1}}" class="add-more-item">
                                        <div class="card-body multi_image_item_div" >
                                            <div class="col-sm-12">
                                                <div class="multiple_tab_image" data-count="{{$k+1}}">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="title_en" class="required1"> Image Title (English)</label>
                                                            <input type="text" name="component[0][multi_tab_item][image_array-{{$key+1}}][{{$k+1}}][title_en]"  class="form-control"
                                                                value="{{ !empty($single_image_array['title_en']) ? $single_image_array['title_en'] : '' }}" >
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                                            <label for="title_bn" class="required1"> Image Title (Bangla)</label>
                                                            <input type="text" name="component[0][multi_tab_item][image_array-{{$key+1}}][{{$k+1}}][title_bn]"  class="form-control"
                                                                value="{{ !empty($single_image_array['title_bn']) ? $single_image_array['title_bn'] : '' }}" >
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group col-md-4">
                                                            <label for="alt_text" class="">Image (optional)</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="component[0][multi_tab_item][image_array-{{$key+1}}][{{$k+1}}][image_url]"
                                                                data-default-file="{{ (isset($single_image_array['image_url'])) ?  config('filesystems.file_base_url') . $single_image_array['image_url'] : ''  }}"
                                                                class="dropify">
                                                            </div>
                                                            <input type="hidden" name="component[0][multi_tab_item][image_array-{{$key+1}}][{{$k+1}}][prev_image_url]" value="{{ (isset($single_image_array['image_url']) ) ? $single_image_array['image_url'] : ''  }}" />

                                                            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                                                        </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="alt_text" class="required1">Alt Text</label>
                                                            <input type="text" name="component[0][multi_tab_item][image_array-{{$key+1}}][{{$k+1}}][alt_text]"  class="form-control"
                                                                value="{{ !empty($single_image_array['alt_text']) ? $single_image_array['alt_text'] : '' }}" >
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group col-md-1">
                                                            <button class="btn btn-info  btn-glow px-1 add_more_item" data-item="{{$key+1}}">+</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                @endforeach  
                            </fieldset>
                            <hr>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>   
    @endforeach
@else
    <div id="multiple_tab_image_sec">
        <div class="card">
            <fieldset class="tab_card">
                <label for="image_card">Tab 1:</label>
                <hr>
                <div  class="row col-md-12">
                    <input type="hidden" name="component[0][multi_tab_item][id-1]" value="1">
                    <input type="hidden" name="component[0][multi_tab_item][display_order-1]" value="1">
                    <div class="form-group col-md-6">
                        <label for="tab_title_en" class="required1">Tab Title (English)</label>
                        <input type="text" name="component[0][multi_tab_item][tab_title_en-1]" 
                        class="form-control" 
                        placeholder="Tab-1 English" 
                        required 
                        data-validation-required-message="Enter Tab Title En">
                        <div class="help-block"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                        <input type="text" name="component[0][multi_tab_item][tab_title_bn-1]"  
                        class="form-control" placeholder="Tab-1 Bangla" 
                        required data-validation-required-message="Enter Tab Title Bn">
                        <div class="help-block"></div>
                    </div>

                    <div class="form-group col-md-12">
                        <fieldset class="image_card">
                            <label for="image_card">Images:</label>
                            <input id="multi_image_item_count_1" type="hidden" value="1">

                            <div id="add-more-item-1" class="add-more-item">
                                <div class="card-body multi_image_item_div" >
                                    <div class="col-sm-12">
                                        <div class="multiple_tab_image" data-count="1">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="title_en" class="required1"> Image Title (English)</label>
                                                    <input type="text" name="component[0][multi_tab_item][image_array-1][1][title_en]"  class="form-control"
                                                        value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                                    <div class="help-block"></div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="title_bn" class="required1"> Image Title (Bangla)</label>
                                                    <input type="text" name="component[0][multi_tab_item][image_array-1][1][title_bn]"  class="form-control"
                                                        value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                                    <div class="help-block"></div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="alt_text" class="">Image (optional)</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="component[0][multi_tab_item][image_array-1][1][image_url]" class="dropify">
                                                    </div>
                                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                                    <div class="help-block"></div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="alt_text" class="required1">Alt Text</label>
                                                    <input type="text" name="component[0][multi_tab_item][image_array-1][1][alt_text]"  class="form-control"
                                                        value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                                    <div class="help-block"></div>
                                                </div>

                                                <div class="form-group col-md-1">
                                                    <button class="btn btn-info  btn-glow px-1 add_more_item" data-item="1">+</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </fieldset>
                        <hr>
                    </div>
                </div>
            </fieldset>
        </div>
    </div> 
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
            dropify();

            var $padrentSelector = $('#multiple_tab_image');
            // Add multiple item
            $('.add_moreslider_item').on('click', function(event){
                event.preventDefault();

                var i = parseInt($padrentSelector.find('#multi_item_count').val(), 10);
                // $('#slider_content_section').empty();
                i = i+1;
                var html = '';
                html += `<div class="single_slider_content">
                            <div class="card">
                                <fieldset class="tab_card">
                                    <label for="image_card">Tab ${i}:</label>
                                    <hr>
                                    <div  class="row col-md-12">

                                        <input type="hidden" name="component[0][multi_tab_item][id-${i}]" value="${i}">
                                        <input type="hidden" name="component[0][multi_tab_item][display_order-${i}]" value="${i}">

                                        <div class="form-group col-md-5">
                                            <label for="tab_title_en" class="required1">Tab Title (English)</label>
                                            <input type="text" name="component[0][multi_tab_item][tab_title_en-${i}]"  class="form-control" placeholder="Tab-${i} English" required data-validation-required-message="Enter Tab Title En">
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="tab_title_bn" class="required1">Tab Title (Bangla)</label>
                                            <input type="text" name="component[0][multi_tab_item][tab_title_bn-${i}]"  class="form-control" placeholder="Tab-${i} Bangla" required data-validation-required-message="Enter Tab Title Bn">
                                            <div class="help-block"></div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <button class="btn btn-danger multi_item_remove" style="margin-top: 15px;"><i class="la la-trash"></i></button>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <fieldset class="image_card">
                                                <label for="image_card">Images:</label>
                                                <input data-item="1" id="multi_image_item_count_${i}" type="hidden" value="1">

                                                <div id="add-more-item-${i}" class="add-more-item">
                                                    <div class="card-body multi_image_item_div" >
                                                        <div class="col-sm-12">
                                                            <div class="multiple_tab_image" data-count="1">

                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="title_en" class="required1">Image Title (English)</label>
                                                                        <input type="text" name="component[0][multi_tab_item][image_array-${i}][1][title_en]"  class="form-control"
                                                                            value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="form-group col-md-6">
                                                                        <label for="title_bn" class="required1">Image Title (Bangla)</label>
                                                                        <input type="text" name="component[0][multi_tab_item][image_array-${i}][1][title_bn]"  class="form-control"
                                                                            value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="form-group col-md-4">
                                                                        <label for="alt_text" class="">Image (optional)</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" name="component[0][multi_tab_item][image_array-${i}][1][image_url]" class="dropify">
                                                                        </div>
                                                                        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="form-group col-md-3">
                                                                        <label for="alt_text" class="required1">Alt Text</label>
                                                                        <input type="text" name="component[0][multi_tab_item][image_array-${i}][1][alt_text]"  class="form-control"
                                                                            value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="form-group col-md-1">
                                                                        <button class="btn btn-info  btn-glow px-1 add_more_item" data-item="${i}">+</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <hr>
                                        </div>         
                                    </div>
                                </fieldset>
                            </div>
                            
                        </div>`;


                $('#multiple_tab_image_sec').append(html);

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
                console.log($('#multi_item_count').val());



            });
            $(document).on('click', '.multi_item_remove', function(e){
                e.preventDefault();
                $(this).parents('.single_slider_content').remove();
            });

            $(document).on('click', '.multi_image_item', function(e){
                e.preventDefault();
                $(this).parents('.multi_image_item_div').remove();
            });
            

            // Add More Item ======
            // Multi Image Component
            $(document).on('click', '.add_more_item', function(e){
                e.preventDefault();
                var item = $(this).data("item"); 
                var id = '#add-more-item-' + item;
                //i = item+1;
                var count = $('#multi_image_item_count_' + item).val();
                i = parseInt(count) + 1; 
                //var html = `<div class="card-body multi_image_item" >
                var html = `<div class="card-body multi_image_item_div" >
                            <div class="col-sm-12">
                                <div class="multiple_tab_image" data-count="1">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="title_en" class="required1">Image Title (English)</label>
                                            <input type="text" name="component[0][multi_tab_item][image_array-${item}][${i}][title_en]"  class="form-control"
                                                value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                                            <div class="help-block"></div>
                                        </div>

                                        <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                            <label for="title_bn" class="required1">Image Title (Bangla)</label>
                                            <input type="text" name="component[0][multi_tab_item][image_array-${item}][${i}][title_bn]"  class="form-control"
                                                value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                                            <div class="help-block"></div>
                                        </div>

                                        <div class="form-group col-md-4>
                                            <label for="image_url" class="">Image (optional)</label>
                                            <div class="custom-file">
                                                <input type="file" class="dropify" name="component[0][multi_tab_item][image_array-${item}][${i}][image_url]">
                                            </div>
                                            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                            <div class="help-block"></div>
                                            <div class="help-block"></div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="alt_text" class="required1">Alt Text</label>
                                            <input type="text" name="component[0][multi_tab_item][image_array-${item}][${i}][alt_text]"  class="form-control"
                                                value="{{ !empty($ecarrer_item->alt_text) ? $ecarrer_item->alt_text : '' }}" >
                                            <div class="help-block"></div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <button class="btn btn-info  btn-glow px-1 add_more_item" data-item="${item}" style="margin-top: 15px;">+</button>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn btn-danger multi_image_item" style="margin-top: 15px;">x</button>
                                        </div>
                                        
                                    </div> 
                                </div> 
                            </div>
                        </div>`;    
                $(id).append(html);

                //$(this).parents('.add-more-item').append(html);
                dropify();
                $padrentSelector.find('#multi_image_item_count_' + item).val(i);
                console.log($('#multi_image_item_count_' + item).val());
            });
            

        }); // doc ready

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

    </script>

@endpush                    