@extends('layouts.admin')
@section('title', 'Section Create')
@section('card_name', 'Section Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Section Create</li>
@endsection
@section('action')
    <a href="{{ url('programs/photogallery') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="photogallery_section" role="form" action="{{ route('programs.photogallery.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
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
                                    <label for="title_bn" class="required1">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Section name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}"  data-validation-required-message="Please enter Section name">
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
                                
                                <div class="form-group col-md-6">
                                    <label for="category_type">Select Programs category</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="sap">Strategic Assistant Program</option>
                                            <option value="ennovators">Ennovators</option>
                                            <option value="aip">Advanced Internship Program</option>
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
                                @include('admin.ecarrer-items.additional.description')
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
                var sectionName = $('#photogallery_section').find('.section_name').val();
                var sectionNameLower = sectionName.toLowerCase();
                var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

                $('#photogallery_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

                // console.log(sectionNameRemoveSpace);
            });

            

        });
    </script>

@endpush






