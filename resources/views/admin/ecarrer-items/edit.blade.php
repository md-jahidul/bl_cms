@extends('layouts.admin')
@section('title', 'Item Edit')
@section('card_name', 'Item Edit')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url("ecarrer-items/$parent_id/list") }}">Item List</a></li>
<li class="breadcrumb-item active"> {{$ecarrer_item->title_en}}</li>
@endsection
@section('action')
<a href="{{ url("ecarrer-items/$parent_id/list") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection

@php

if(
$parent_categories['category'] == 'programs_photogallery'
){
$hide_title = true;
}
else{
$hide_title = false;
}

@endphp

@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">


                <div class="card-body card-dashboard">
                    <form id="general_section" role="form" action="{{ url("ecarrer-items/$parent_id/$ecarrer_item->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        {{method_field('POST')}}
                        <div class="row">
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">

                            @if( !$hide_title )
                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">
                                    @if( $ecarrer_section_slug == 'programs_sapbatches' )
                                    Name (English)
                                    @else
                                    Title (English)
                                    @endif
                                </label>
                                <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                       value="{{ $ecarrer_item->title_en }}" required data-validation-required-message="Field can not be empty">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>
                            @endif

                            @if( !$hide_title )
                            @if( $ecarrer_section_slug != 'life_at_bl_contact' )
                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required1">
                                    @if( $ecarrer_section_slug == 'programs_sapbatches' )
                                    Name (Bangla)
                                    @else
                                    Title (Bangla)
                                    @endif
                                </label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter text (bangla)"
                                       value="{{ $ecarrer_item->title_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>
                            @endif
                            @endif

                            <!-- Include additional field layout for individual section requirement -->
                            @if( ($ecarrer_section_slug != 'life_at_bl_events') && ($ecarrer_section_slug != 'life_at_bl_contact') && ($ecarrer_section_slug != 'programs_photogallery') )
                            @include('admin.ecarrer-items.additional.description')
                            @endif

                            <div class="form-group col-md-5 {{ $errors->has('image_url') ? ' error' : '' }}">
                                <label for="alt_text" class="">Banner Image (optional)</label>
                                <div class="custom-file">
                                    <input type="file" name="image_url" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>

                                <div class="help-block"></div>
                                @if ($errors->has('image_url'))
                                <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-1">
                                @if( !empty($ecarrer_item->image) )
                                <img style="height:70px;width:70px;display:block"
                                     src="{{ config('filesystems.file_base_url') . $ecarrer_item->image}}" id="imgDisplay">
                                <a href="{{$ecarrer_item->id}}" class="btn btn-sm btn-outline-danger remove_photo">Remove</a>
                                @endif

                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('image_name') ? ' error' : '' }}">
                                <label>Image Name EN</label>
                                <input type="text" name="image_name"  class="form-control" placeholder="Image Name EN"
                                       value="{{ $ecarrer_item->image_name }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name'))
                                    <div class="help-block">  {{ $errors->first('image_name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                <label>Image Name BN</label>
                                <input type="text" name="image_name_bn"  class="form-control" placeholder="Image Name BN"
                                       value="{{ $ecarrer_item->image_name_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name_bn'))
                                    <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label for="alt_text">Alt text</label>
                                <input type="text" name="alt_text"  class="form-control" placeholder="Alt Text EN"
                                       value="{{ $ecarrer_item->alt_text }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text'))
                                    <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                <label for="alt_text">Alt text BN</label>
                                <input type="text" name="alt_text_bn"  class="form-control" placeholder="Alt Text BN"
                                       value="{{ $ecarrer_item->alt_text_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text_bn'))
                                    <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-6 {{ $errors->has('video') ? ' error' : '' }}">
                                <label for="embed">Video Embed Code</label>
                                <textarea name="video" class="form-control">{{ $ecarrer_item->video }}</textarea>
                                <small class="text-info">If you have banner type component then it'll work</small>
                                @if ($errors->has('video'))
                                <div class="help-block">  {{ $errors->first('video') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="alt_text"></label>
                                <div class="form-group">
                                    <label for="title" class="required mr-1">Status:</label>

                                    <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $ecarrer_item->is_active == 1 ) checked @endif>
                                           <label for="input-radio-15" class="mr-1">Active</label>

                                    <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $ecarrer_item->is_active == 0 ) checked @endif>
                                           <label for="input-radio-16">Inactive</label>
                                </div>
                            </div>

                            @include('admin.ecarrer-items.additional.call_to_actions',['ecarrer_item'=>$ecarrer_item])
                            <!-- Include additional field layout for individual section requirement -->
                            {{-- @if( $ecarrer_section_slug == 'life_at_bl_teams' || ( isset($parent_data->check_type) && $parent_data->check_type == 'programs_news_section' ) )
                            @include('admin.ecarrer-items.additional.call_to_actions')
                            @endif --}}

                            <!-- Include additional field layout for individual section requirement -->
                            @if( $ecarrer_section_slug == 'life_at_bl_contact' )
                            @include('admin.ecarrer-items.additional.alter_text_links')
                            @endif

                            @if( (isset($parent_data->check_type) && $parent_data->check_type == 'programs_testimonial') || $ecarrer_section_slug == 'programs_sapbatches' )
                            @include('admin.ecarrer-items.additional.testimonial_text')
                            @endif

                            <div class="form-actions col-md-12 ">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> SAVE
                                    </button>

                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $ecarrer_item->id }}"/>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@stop


@push('page-js')

<script type="text/javascript">
    jQuery(document).ready(function ($) {


        $('input.section_name').on('keyup', function () {
            var sectionName = $('#general_section').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

            $('#general_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

            // console.log(sectionNameRemoveSpace);
        });

        $('.remove_photo').on('click', function (e) {
            e.preventDefault();
            var cnfrm = confirm("Do you want to delete this photo?");
            if (cnfrm) {
                var itemId = $(this).attr('href');

                var thisObj = $(this);

                $.ajax({
                    url: '{{ url("ecarrer-items/photo-delete")}}/' + itemId,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: result.message,
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $(thisObj).parents('.form-group').html("");

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 2000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Status change process failed!',
                            type: 'error',
                        });
                    }
                });
            }


        });



    });
</script>

@endpush



