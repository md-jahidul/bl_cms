@extends('layouts.admin')
@section('title', 'Section Create')
@section('card_name', 'Section Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Section Create</li>
@endsection
@section('action')
    <a href="{{ url("programs/progeneral/$sections_type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="progeneral_section" role="form" action="{{ route('programs.progeneral.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="sections_type" value="{{ $sections_type }}">
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
                                    <input type="text" name="title_bn"  class="form-control section_name" placeholder="Section name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_type">Select Programs tab</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            @foreach ($program_lists as $program)
                                                <option value="{{$program->slug}}">{{$program->title_en}}</option>
                                            @endforeach
                                        </select>
                                </div>

                                @if( $sections_type == 'news_section' )
                                    {!! Form::hidden('programs_sections', 'programs_news_section') !!}
                                @elseif( $sections_type == 'steps' )
                                    {!! Form::hidden('programs_sections', 'programs_steps') !!}
                                @elseif( $sections_type == 'events' )
                                    {!! Form::hidden('programs_sections', 'programs_events') !!}
                                @elseif( $sections_type == 'testimonial' )
                                    {!! Form::hidden('programs_sections', 'programs_testimonial') !!}
                                @elseif( $sections_type == 'video' )
                                    {!! Form::hidden('programs_sections', 'programs_video') !!}
                                    <div class="form-group col-md-6">
                                        <label for="embed">Video Embed Code</label>
                                        <textarea name="video" class="form-control" aria-invalid="false"></textarea>
                                        <small class="text-info">If you have banner type component then it'll work</small>
                                    </div>
                                @endif

                                {{-- <div class="form-group col-md-6">
                                    <label for="category_type">Specify section type</label>
                                    <select class="form-control" name="programs_sections" aria-invalid="false">
                                            <option value="programs_news_section">Programs news section</option>
                                            <option value="programs_steps">Programs steps section</option>
                                            <option value="programs_events">Programs Events section</option>
                                            <option value="programs_testimonial">Programs testimonial section</option>
                                        </select>
                                </div> --}}


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
            var sectionName = $('#progeneral_section').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

            $('#progeneral_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

            // console.log(sectionNameRemoveSpace);
        });



    });
</script>

@endpush






