{{ Form::hidden('sections[section_name]', 'Image With Content' ) }}
{{ Form::hidden('sections[section_type]', 'image_with_content' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'image_with_content' ) }}
@php($component = (isset($component->multiple_attributes)) ? json_decode($component->multiple_attributes) : [])

<div class="col-sm-12">
    <div class="add_button_wrap float-right">
      <a href="#" class="btn btn-info  btn-glow px-1 add_moreslider_item">+ Add Image</a>
    </div>
</div>

<div class="col-sm-12">
    <div id="image_with_content" class="image_with_content" data-count="1">
    
        @if($component == [])
        <input type="hidden" name="component[0][image_with_content_item][id-1]" value="1">
        <input type="hidden" name="component[0][image_with_content_item][display_order-1]" value="1">
        <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="1">
        <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

            <div class="form-group col-md-3 {{ $errors->has('title_en') ? ' error' : '' }}">
                <label for="title_en" class="required1">Title En</label>
                <input type="text" name="component[0][image_with_content_item][title_en-1]"  class="form-control"
                       value="{{ !empty($comp->title_en) ? $comp->title_en : '' }}"  require>
                <div class="help-block"></div>
                @if ($errors->has('title_en'))
                    <div class="help-block">  {{ $errors->first('title_en') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3 {{ $errors->has('title_bn') ? ' error' : '' }}">
                <label for="title_bn" class="required1">Title Bn</label>
                <input type="text" name="component[0][image_with_content_item][title_bn-1]"  class="form-control"
                       value="{{ !empty($comp->title_bn) ? $comp->title_bn : '' }}" require >
                <div class="help-block"></div>
                @if ($errors->has('title_bn'))
                    <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3 {{ $errors->has('sub_title_en') ? ' error' : '' }}">
                <label for="sub_title_en" class="required1">Sub Title En</label>
                <input type="text" name="component[0][image_with_content_item][sub_title_en-1]"  class="form-control"
                       value="{{ !empty($comp->sub_title_en) ? $comp->sub_title_en : '' }}" require >
                <div class="help-block"></div>
                @if ($errors->has('sub_title_en'))
                    <div class="help-block">  {{ $errors->first('sub_title_en') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3 {{ $errors->has('sub_title_bn') ? ' error' : '' }}">
                <label for="sub_title_bn" class="required1">Sub Title Bn</label>
                <input type="text" name="component[0][image_with_content_item][sub_title_bn-1]"  class="form-control"
                       value="{{ !empty($comp->sub_title_bn) ? $comp->sub_title_bn : '' }}" require >
                <div class="help-block"></div>
                @if ($errors->has('sub_title_bn'))
                    <div class="help-block">  {{ $errors->first('sub_title_bn') }}</div>
                @endif
            </div>
            <div class="form-group col-md-3 {{ $errors->has('learn_more_title_en') ? ' error' : '' }}">
                <label for="learn_more_title_en" class="required1">Learn More Button Title En</label>
                <input type="text" name="component[0][image_with_content_item][learn_more_title_en-1]"  class="form-control"
                       value="{{ !empty($comp->learn_more_title_en) ? $comp->learn_more_title_en : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('learn_more_title_en'))
                    <div class="help-block">  {{ $errors->first('learn_more_title_en') }}</div>
                @endif
            </div>
            <div class="form-group col-md-3 {{ $errors->has('learn_more_title_bn') ? ' error' : '' }}">
                <label for="learn_more_title_bn" class="required1">Learn More Button Title Bn</label>
                <input type="text" name="component[0][image_with_content_item][learn_more_title_bn-1]"  class="form-control"
                       value="{{ !empty($comp->learn_more_title_bn) ? $comp->learn_more_title_bn : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('learn_more_title_bn'))
                    <div class="help-block">  {{ $errors->first('learn_more_title_bn') }}</div>
                @endif
            </div>
            <div class="form-group col-md-3 {{ $errors->has('learn_more_url') ? ' error' : '' }}">
                <label for="learn_more_url" class="required1">Learn More URL</label>
                <input type="text" name="component[0][image_with_content_item][learn_more_url-1]"  class="form-control"
                       value="{{ !empty($comp->learn_more_url) ? $comp->learn_more_url : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('learn_more_url'))
                    <div class="help-block">  {{ $errors->first('learn_more_url') }}</div>
                @endif
            </div>
            
            <div class="form-group col-md-3 {{ $errors->has('view_job_title_en') ? ' error' : '' }}">
                <label for="view_job_title_en" class="required1">View All Jobs Button Title En</label>
                <input type="text" name="component[0][image_with_content_item][view_job_title_en-1]"  class="form-control"
                       value="{{ !empty($comp->view_job_title_en) ? $comp->view_job_title_en : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('view_job_title_en'))
                    <div class="help-block">  {{ $errors->first('view_job_title_en') }}</div>
                @endif
            </div>
            <div class="form-group col-md-3 {{ $errors->has('view_job_title_bn') ? ' error' : '' }}">
                <label for="view_job_title_bn" class="required1">View All Jobs Button Title Bn</label>
                <input type="text" name="component[0][image_with_content_item][view_job_title_bn-1]"  class="form-control"
                       value="{{ !empty($comp->view_job_title_bn) ? $comp->view_job_title_bn : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('view_job_title_bn'))
                    <div class="help-block">  {{ $errors->first('view_job_title_bn') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3 {{ $errors->has('view_job_url') ? ' error' : '' }}">
                <label for="view_job_url" class="required1">View All Jobs URL</label>
                <input type="text" name="component[0][image_with_content_item][view_job_url-1]"  class="form-control"
                       value="{{ !empty($comp->view_job_url) ? $comp->view_job_url : '' }}" >
                <div class="help-block"></div>
                @if ($errors->has('view_job_url'))
                    <div class="help-block">  {{ $errors->first('view_job_url') }}</div>
                @endif
            </div>


            <div class="form-group col-md-3 {{ $errors->has('details_en') ? ' error' : '' }}">
                <label for="details_en" class="required1">Content En</label>
                <textarea type="text" name="component[0][image_with_content_item][details_en-1]"  class="form-control">{{ !empty($comp->details_en) ? $comp->details_en : '' }}</textarea>
                <div class="help-block"></div>
                @if ($errors->has('details_en'))
                    <div class="help-block">  {{ $errors->first('details_en') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3 {{ $errors->has('details_bn') ? ' error' : '' }}">
                <label for="details_bn" class="required1">Content Bn</label>
                <textarea type="text" name="component[0][image_with_content_item][details_bn-1]"  class="form-control">{{ !empty($comp->details_bn) ? $comp->details_bn : '' }}</textarea>
                <div class="help-block"></div>
                @if ($errors->has('details_bn'))
                    <div class="help-block">  {{ $errors->first('details_bn') }}</div>
                @endif
            </div>

            <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                <label for="alt_text" class="">Image (optional)</label>
                <div class="custom-file">
                    <input type="file" name="component[0][image_with_content_item][image_url-1]" class="dropify">
                </div>
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                <div class="help-block"></div>
                @if ($errors->has('image_url'))
                    <div class="help-block">  {{ $errors->first('image_url') }}</div>
                @endif
            </div>

            <div class="form-group col-md-3">
                <label for="status">Status</label>
                <select class="form-control" name="component[0][image_with_content_item][status-1]" aria-invalid="false">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>

            </div>
            <div class="form-group">
                <label for="status" style="padding-bottom: 43px;"> </label>
                <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
            </div>
        </div>
        @else
            <input id="multi_item_count" type="hidden" name="component[0][multi_item_count]" value="{{count($component)}}">

            @foreach ($component as $key => $comp)
            <input type="hidden" name="component[0][image_with_content_item][id-{{($key+1)}}]" value="{{($key+1)}}">
            <input type="hidden" name="component[0][image_with_content_item][display_order-{{($key+1)}}]" value="{{($key+1)}}">
            <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

                <div class="form-group col-md-3 {{ $errors->has('title_en') ? ' error' : '' }}">
                    <label for="title_en" class="required1">Title En</label>
                    <input type="text" name="component[0][image_with_content_item][title_en-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->title_en) ? $comp->title_en : '' }}"  require>
                    <div class="help-block"></div>
                    @if ($errors->has('title_en'))
                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('title_bn') ? ' error' : '' }}">
                    <label for="title_bn" class="required1">Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][title_bn-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->title_bn) ? $comp->title_bn : '' }}" require >
                    <div class="help-block"></div>
                    @if ($errors->has('title_bn'))
                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('sub_title_en') ? ' error' : '' }}">
                    <label for="sub_title_en" class="required1">Sub Title En</label>
                    <input type="text" name="component[0][image_with_content_item][sub_title_en-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->sub_title_en) ? $comp->sub_title_en : '' }}" require >
                    <div class="help-block"></div>
                    @if ($errors->has('sub_title_en'))
                        <div class="help-block">  {{ $errors->first('sub_title_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('sub_title_bn') ? ' error' : '' }}">
                    <label for="sub_title_bn" class="required1">Sub Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][sub_title_bn-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->sub_title_bn) ? $comp->sub_title_bn : '' }}" require >
                    <div class="help-block"></div>
                    @if ($errors->has('sub_title_bn'))
                        <div class="help-block">  {{ $errors->first('sub_title_bn') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_title_en') ? ' error' : '' }}">
                    <label for="learn_more_title_en" class="required1">Learn More Button Title En</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_title_en-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->learn_more_title_en) ? $comp->learn_more_title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_title_en'))
                        <div class="help-block">  {{ $errors->first('learn_more_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_title_bn') ? ' error' : '' }}">
                    <label for="learn_more_title_bn" class="required1">Learn More Button Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_title_bn-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->learn_more_title_bn) ? $comp->learn_more_title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_title_bn'))
                        <div class="help-block">  {{ $errors->first('learn_more_title_bn') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_url') ? ' error' : '' }}">
                    <label for="learn_more_url" class="required1">Learn More URL</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_url-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->learn_more_url) ? $comp->learn_more_url : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_url'))
                        <div class="help-block">  {{ $errors->first('learn_more_url') }}</div>
                    @endif
                </div>
                
                <div class="form-group col-md-3 {{ $errors->has('view_job_title_en') ? ' error' : '' }}">
                    <label for="view_job_title_en" class="required1">View All Jobs Button Title En</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_title_en-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->view_job_title_en) ? $comp->view_job_title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_title_en'))
                        <div class="help-block">  {{ $errors->first('view_job_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('view_job_title_bn') ? ' error' : '' }}">
                    <label for="view_job_title_bn" class="required1">View All Jobs Button Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_title_bn-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->view_job_title_bn) ? $comp->view_job_title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_title_bn'))
                        <div class="help-block">  {{ $errors->first('view_job_title_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('view_job_url') ? ' error' : '' }}">
                    <label for="view_job_url" class="required1">View All Jobs URL</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_url-{{($key+1)}}]"  class="form-control"
                        value="{{ !empty($comp->view_job_url) ? $comp->view_job_url : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_url'))
                        <div class="help-block">  {{ $errors->first('view_job_url') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-3 {{ $errors->has('details_en') ? ' error' : '' }}">
                    <label for="details_en" class="required1">Content En</label>
                    <textarea type="text" name="component[0][image_with_content_item][details_en-{{($key+1)}}]"  class="form-control">{{ !empty($comp->details_en) ? $comp->details_en : '' }}</textarea>
                    <div class="help-block"></div>
                    @if ($errors->has('details_en'))
                        <div class="help-block">  {{ $errors->first('details_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('details_bn') ? ' error' : '' }}">
                    <label for="details_bn" class="required1">Content Bn</label>
                    <textarea type="text" name="component[0][image_with_content_item][details_bn-{{($key+1)}}]"  class="form-control">{{ !empty($comp->details_bn) ? $comp->details_bn : '' }}</textarea>
                    <div class="help-block"></div>
                    @if ($errors->has('details_bn'))
                        <div class="help-block">  {{ $errors->first('details_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                    <label for="alt_text" class="">Image (optional)</label>
                    <div class="custom-file">
                        <input type="file" name="component[0][image_with_content_item][image_url-{{($key+1)}}]" 
                        class="dropify"
                        data-default-file="{{ isset($comp->image_url) ?  config('filesystems.file_base_url') . $comp->image_url : null  }}">
                    </div>
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                    <div class="help-block"></div>
                    @if ($errors->has('image_url'))
                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                    @endif
                    <input type="hidden" name="component[0][image_with_content_item][prev_image_url-{{($key+1)}}]" value="{{ isset($comp->image_url) ? $comp->image_url : null  }}" />
                </div>

                <div class="form-group col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="component[0][image_with_content_item][status-{{($key+1)}}]" aria-invalid="false">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="status" style="padding-bottom: 43px;"> </label>
                    <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                </div>
            </div>
            @endforeach
        @endif    
    </div>
    {{-- <hr class="hr">
    <br> --}}
</div>

@push('page-css')
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

<script type="text/javascript">
	$(document).ready(function () {

	   // Add multiple item
	   $('.add_moreslider_item').on('click', function(){

	   	$parentSelector = $('#image_with_content');

	     var i = parseInt($parentSelector.find('#multi_item_count').val(), 10);
	     // $('#slider_content_section').empty();
	     i = i+1;
	     var html = '';
         html += `
            <input type="hidden" name="component[0][image_with_content_item][id-${i}]" value="${i}">
            <input type="hidden" name="component[0][image_with_content_item][display_order-${i}]" value="${i}">
            <div class="row single_slider_content" style="margin-bottom: 30px;padding-bottom: 30px;border-bottom: 1px solid #d1d5ea;">

                <div class="form-group col-md-3 {{ $errors->has('title_en') ? ' error' : '' }}">
                    <label for="title_en" class="required1">Title En</label>
                    <input type="text" name="component[0][image_with_content_item][title_en-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->title_en) ? $ecarrer_item->title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('title_en'))
                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('title_bn') ? ' error' : '' }}">
                    <label for="title_bn" class="required1">Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][title_bn-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->title_bn) ? $ecarrer_item->title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('title_bn'))
                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('sub_title_en') ? ' error' : '' }}">
                    <label for="sub_title_en" class="required1">Sub Title En</label>
                    <input type="text" name="component[0][image_with_content_item][sub_title_en-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->sub_title_en) ? $ecarrer_item->sub_title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('sub_title_en'))
                        <div class="help-block">  {{ $errors->first('sub_title_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('sub_title_bn') ? ' error' : '' }}">
                    <label for="sub_title_bn" class="required1">Sub Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][sub_title_bn-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->sub_title_bn) ? $ecarrer_item->sub_title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('sub_title_bn'))
                        <div class="help-block">  {{ $errors->first('sub_title_bn') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_title_en') ? ' error' : '' }}">
                    <label for="learn_more_title_en" class="required1">Learn More Button Title En</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_title_en-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->learn_more_title_en) ? $ecarrer_item->learn_more_title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_title_en'))
                        <div class="help-block">  {{ $errors->first('learn_more_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_title_bn') ? ' error' : '' }}">
                    <label for="learn_more_title_bn" class="required1">Learn More Button Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_title_bn-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->learn_more_title_bn) ? $ecarrer_item->learn_more_title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_title_bn'))
                        <div class="help-block">  {{ $errors->first('learn_more_title_bn') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('learn_more_url') ? ' error' : '' }}">
                    <label for="learn_more_url" class="required1">Learn More URL</label>
                    <input type="text" name="component[0][image_with_content_item][learn_more_url-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->learn_more_url) ? $ecarrer_item->learn_more_url : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('learn_more_url'))
                        <div class="help-block">  {{ $errors->first('learn_more_url') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('view_job_title_en') ? ' error' : '' }}">
                    <label for="view_job_title_en" class="required1">View All Jobs Button Title En</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_title_en-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->view_job_title_en) ? $ecarrer_item->view_job_title_en : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_title_en'))
                        <div class="help-block">  {{ $errors->first('view_job_title_en') }}</div>
                    @endif
                </div>
                <div class="form-group col-md-3 {{ $errors->has('view_job_title_bn') ? ' error' : '' }}">
                    <label for="view_job_title_bn" class="required1">View All Jobs Button Title Bn</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_title_bn-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->view_job_title_bn) ? $ecarrer_item->view_job_title_bn : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_title_bn'))
                        <div class="help-block">  {{ $errors->first('view_job_title_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('view_job_url') ? ' error' : '' }}">
                    <label for="view_job_url" class="required1">View All Jobs URL</label>
                    <input type="text" name="component[0][image_with_content_item][view_job_url-${i}]"  class="form-control"
                        value="{{ !empty($ecarrer_item->view_job_url) ? $ecarrer_item->view_job_url : '' }}" >
                    <div class="help-block"></div>
                    @if ($errors->has('view_job_url'))
                        <div class="help-block">  {{ $errors->first('view_job_url') }}</div>
                    @endif
                </div>


                <div class="form-group col-md-3 {{ $errors->has('details_en') ? ' error' : '' }}">
                    <label for="details_en" class="required1">Content En</label>
                    <textarea type="text" name="component[0][image_with_content_item][details_en-${i}]"  class="form-control">{{ !empty($ecarrer_item->details_en) ? $ecarrer_item->details_en : '' }}</textarea>
                    <div class="help-block"></div>
                    @if ($errors->has('details_en'))
                        <div class="help-block">  {{ $errors->first('details_en') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('details_bn') ? ' error' : '' }}">
                    <label for="details_bn" class="required1">Content Bn</label>
                    <textarea type="text" name="component[0][image_with_content_item][details_bn-${i}]"  class="form-control">{{ !empty($ecarrer_item->details_bn) ? $ecarrer_item->details_bn : '' }}</textarea>
                    <div class="help-block"></div>
                    @if ($errors->has('details_bn'))
                        <div class="help-block">  {{ $errors->first('details_bn') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('image_url') ? ' error' : '' }}">
                    <label for="alt_text" class="">Image (optional)</label>
                    <div class="custom-file">
                        <input type="file" name="component[0][image_with_content_item][image_url-${i}]" class="dropify">
                {{--                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
                    </div>
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                    <div class="help-block"></div>
                    @if ($errors->has('image_url'))
                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                    @endif
                </div>

                <div class="form-group col-md-3">
                    <label for="status">Status</label>
                    <select class="form-control" name="component[0][image_with_content_item][status-${i}]" aria-invalid="false">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="status" style="padding-bottom: 43px;"> </label>
                    <button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button>
                </div>
                </div>
                </div>`;

	     //html += '<div class="row single_slider_content"><div class="form-group col-md-4"> <label for="alt_text" class="">Image (optional)</label><div class="custom-file"> <input type="file" name="component[0][image_with_content_item][image_url-'+i+']" class="dropify" aria-invalid="false"></div> <span class="text-primary">Please given file type (.png, .jpg, svg)</span><div class="help-block"></div></div><div class="form-group col-md-4"> <label for="alt_text" class="required1">Alt Text</label> <input type="text" name="component[0][image_with_content_item][alt_text-'+i+']" class="form-control" value=""><div class="help-block"></div></div><div class="form-group col-md-3"> <label for="status">Status</label> <select class="form-control" name="component[0][image_with_content_item][status-'+i+']" aria-invalid="false"><option value="1">Active</option><option value="0">Inactive</option> </select></div><div class="form-group"> <label for="status" style="padding-bottom: 43px;"> </label><button class="btn btn-danger multi_item_remove"><i class="la la-trash"></i></button></div></div>';

	     $parentSelector.find('#image_with_content').append(html);

         $('.dropify').dropify({
             messages: {
                 'default': 'Browse for an Image File to upload',
                 'replace': 'Click to replace',
                 'remove': 'Remove',
                 'error': 'Choose correct file format'
             },
             height: 100
         });
	     $parentSelector.find('#multi_item_count').val(i);
	   });


	   $(document).on('click', '.multi_item_remove', function(e){

	     e.preventDefault();

	     $(this).parents('.row.single_slider_content').remove();

	   });




	}); // doc ready
</script>




@endpush
