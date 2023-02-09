@extends('layouts.admin')
@section('title', 'Item Create')
@section('card_name', 'Item Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Item Create</li>
@endsection
@section('action')
    <a href="{{ url("ecarrer-items/$parent_id/list") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection

{{-- {{ dd($parent_categories) }} --}}

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
                        <form id="general_section" role="form" action="{{ route('ecarrer.items.store', $parent_id) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                @if( !$hide_title )
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">
                                        @if( ($ecarrer_section_slug == 'programs_sapbatches') || ($ecarrer_section_slug == 'programs_ennovatorbatches') )
                                            Name (English)
                                        @else
                                            Title (English)
                                        @endif
                                    </label>
                                    <input type="text" name="title_en"  class="form-control section_name" placeholder="Section name"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Field can not be empty">
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
                                            @if( ($ecarrer_section_slug == 'programs_sapbatches') || ($ecarrer_section_slug == 'programs_ennovatorbatches') )
                                                Name (Bangla)
                                            @else
                                                Title (Bangla)
                                            @endif
                                        </label>
                                        <input type="text" name="title_bn"  class="form-control section_name" placeholder="Section name"
                                               value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>
                                @endif
                                @endif


                                <!-- Include additional field layout for individual section requirement -->
                                {{-- {{ dd($parent_data) }} --}}
                                @if( ($ecarrer_section_slug != 'life_at_bl_events') && ($ecarrer_section_slug != 'life_at_bl_contact') && ($ecarrer_section_slug != 'programs_photogallery') )
                                    @include('admin.ecarrer-items.additional.description')
                                @endif

                                    <div class="form-group col-md-6 {{ $errors->has('sub_title_en') ? ' error' : '' }}">
                                        <label for="title_bn" class="required1">Sub title EN</label>
                                        <input type="text" name="sub_title_en"  class="form-control" placeholder="Enter sub title (english)"
                                            value="{{ old("sub_title_en") ? old("sub_title_en") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('sub_title_en'))
                                            <div class="help-block">  {{ $errors->first('sub_title_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('sub_title_bn') ? ' error' : '' }}">
                                        <label for="title_bn" class="required1">Sub title BN</label>
                                        <input type="text" name="sub_title_bn"  class="form-control" placeholder="Enter sub title (bangla)"
                                            value="{{ old("sub_title_bn") ? old("sub_title_bn") : '' }}">
                                        <div class="help-block"></div>
                                        @if ($errors->has('sub_title_bn'))
                                            <div class="help-block">  {{ $errors->first('sub_title_bn') }}</div>
                                        @endif
                                    </div>


                                <div class="form-group col-md-5 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Image (optional)</label>
                                    <div class="custom-file">
                                        <input type="file" name="image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-1">
                                    <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name') ? ' error' : '' }}">
                                    <label>Image Name EN</label>
                                    <input type="text" name="image_name"  class="form-control" placeholder="Image Name EN"
                                           value="{{ old("image_name") ? old("image_name") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name'))
                                        <div class="help-block">  {{ $errors->first('image_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label>Image Name BN</label>
                                    <input type="text" name="image_name_bn"  class="form-control" placeholder="Image Name BN"
                                           value="{{ old("image_name_bn") ? old("image_name_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text">Alt text</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Alt Text EN"
                                           value="{{ old("alt_text") ? old("alt_text") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Alt text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control" placeholder="Alt Text BN"
                                           value="{{ old("alt_text_bn") ? old("alt_text_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('video') ? ' error' : '' }}">
                                    <label for="embed">Video Embed Code</label>
                                    <textarea name="video" class="form-control"></textarea>
                                    <small class="text-info">If you have banner type component then it'll work</small>
                                    @if ($errors->has('video'))
                                        <div class="help-block">  {{ $errors->first('video') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>
                                @include('admin.ecarrer-items.additional.call_to_actions')
                                <!-- Include additional field layout for individual section requirement -->
                                {{-- {{ dd($parent_data->check_type) }} --}}
                                {{-- @if( $ecarrer_section_slug == 'life_at_bl_teams' || ( isset($parent_data->check_type) && $parent_data->check_type == 'programs_news_section' ) )
                                    @include('admin.ecarrer-items.additional.call_to_actions')
                                @endif --}}


                                @if( (isset($parent_data->check_type) && $parent_data->check_type == 'programs_testimonial') || ($ecarrer_section_slug == 'programs_sapbatches') || ($ecarrer_section_slug == 'programs_ennovatorbatches') )
                                    @include('admin.ecarrer-items.additional.testimonial_text')
                                @endif


                                <!-- Include additional field layout for individual section requirement -->
                                @if( $ecarrer_section_slug == 'life_at_bl_contact' )
                                    @include('admin.ecarrer-items.additional.alter_text_links')
                                @endif

                                <input type="hidden" name="carrer_parent_item" value="{{$parent_id}}">
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')


@endpush






