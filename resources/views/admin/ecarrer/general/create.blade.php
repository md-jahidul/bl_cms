@extends('layouts.admin')
@section('title', 'Section Create')
@section('card_name', 'Section Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Section Create</li>
@endsection
@section('action')
    <a href="{{ url('life-at-banglalink/general') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="general_section" role="form" action="{{ route('life.at.banglalink.general.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Give a name of the section (English)</label>
                                    <input type="text" name="title_en"  class="form-control section_name" placeholder="Section name"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Please enter Section name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                                    <label for="slug" class="required">Slug</label>
                                    <input type="text" name="slug"  class="form-control section_slug"
                                           value="{{ old("slug") ? old("slug") : '' }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                    <div class="help-block"></div>
                                    @if ($errors->has('slug'))
                                        <div class="help-block">  {{ $errors->first('slug') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Give a name of the section (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Section name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Please enter Section name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
                                    <label for="sliding_speed" class="required">Sliding Speed</label>
                                    <input type="text" name="sider_info[sliding_speed]" oninput="this.value =Number(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"  class="form-control" placeholder="Enter sliding speed (sec)"  min="1" max="300"
                                           value="{{ (!empty($sider_info['sliding_speed'])) ? $sider_info['sliding_speed'] : old("sider_info.sliding_speed") ?? '' }}"
                                           required data-validation-required-message="Enter slider info">
                                    <div class="help-block"><small>Default value 10</small></div>
                                    @if ($errors->has('sliding_speed'))
                                        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
                                    @endif
                                </div>

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
                                    <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                </div>


                                {{--<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description (Optional)</label>
                                        <textarea name="description" class="form-control" rows="5"
                                                  placeholder="Enter description"></textarea>
                                    </div>
                                </div> --}}
                                @include('layouts.partials.common_types.text_area_plane')
                                <div class="form-group col-md-6">
                                    <label for="category_type">Select section type</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="news_on_top">Life at banglalink section</option>
                                            <option value="programs_progeneral">Program section</option>
                                        </select>
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

    <script type="text/javascript">
        jQuery(document).ready(function($){


            $('input.section_name').on('keyup', function(){
                var sectionName = $('#general_section').find('.section_name').val();
                var sectionNameLower = sectionName.toLowerCase();
                var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

                $('#general_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

                // console.log(sectionNameRemoveSpace);
            });



        });
    </script>

@endpush






