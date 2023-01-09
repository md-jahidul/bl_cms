@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('programs/progeneral') }}">Section List</a></li>
    <li class="breadcrumb-item active"> {{$sections->title_en}}</li>
@endsection
@section('action')
    <a href="{{ url("programs/progeneral/$sections_type") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <div class="card-body card-dashboard">
                        <form id="progeneral_section" role="form" action="{{ url("programs/progeneral/$sections->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="section_category" value="{{ $sections->category }}">
                                <input type="hidden" name="sections_type" value="{{ $sections_type }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                           value="{{ $sections->title_en }}" required data-validation-required-message="Enter slider title_en (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                                    <label for="slug" class="required">Slug</label>
                                    <input type="text" name="slug"  class="form-control section_slug"
                                           value="{{ $sections->slug }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                    <div class="help-block"></div>
                                    @if ($errors->has('slug'))
                                        <div class="help-block">  {{ $errors->first('slug') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control section_name" placeholder="Section name"
                                           value="{{ $sections->title_bn }}" >
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="category_type">Select Programs category</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="sap" @if($sections->category_type == 'sap') selected @endif>Strategic Assistant Program</option>
                                            <option value="ennovators" @if($sections->category_type == 'ennovators') selected @endif>Ennovators</option>
                                            <option value="aip" @if($sections->category_type == 'aip') selected @endif>Advanced Internship Program</option>
                                        </select>
                                </div>

                                {{-- {{ dd($sections->additional_info) }} --}}

                                @if( !empty($sections->additional_info) )
                                    @php $additional_info = json_decode($sections->additional_info); @endphp
                                @endif

                                @if( isset($additional_info->additional_type) )
                                    {!! Form::hidden('programs_sections', $additional_info->additional_type) !!}
                                @endif

                                {{-- <div class="form-group col-md-6">
                                    <label for="category_type">Specify section type</label>
                                    <select class="form-control" name="programs_sections" aria-invalid="false">
                                            <option value="programs_news_section" @if( isset($additional_info->additional_type) && $additional_info->additional_type == 'programs_news_section') selected @endif>Programs news section</option>
                                            <option value="programs_steps" @if( isset($additional_info->additional_type) && $additional_info->additional_type == 'programs_steps') selected @endif>Programs steps section</option>
                                            <option value="programs_events" @if( isset($additional_info->additional_type) && $additional_info->additional_type == 'programs_events') selected @endif>Programs Events section</option>
                                            <option value="programs_testimonial" @if( isset($additional_info->additional_type) && $additional_info->additional_type == 'programs_testimonial') selected @endif>Programs testimonial section</option>
                                        </select>
                                </div> --}}



                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $sections->is_active == 1 ) checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $sections->is_active == 0 ) checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>


                                @include('admin.ecarrer-items.additional.description',['ecarrer_item'=> $sections])
                                @include('admin.ecarrer-items.additional.call_to_actions',['ecarrer_item'=>$sections])
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $sections->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


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



