@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('life-at-banglalink/contact') }}">Section List</a></li>
    <li class="breadcrumb-item active"> {{$sections->title}}</li>
@endsection
@section('action')
    <a href="{{ url("life-at-banglalink/contact") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <div class="card-body card-dashboard">
                        <form id="contact_section" role="form" action="{{ url("life-at-banglalink/contact/$sections->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="section_category" value="{{ $sections->category }}">
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
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title_bn (english)"
                                           value="{{ $sections->title_bn }}" >
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description (Optional) (English)</label>
                                        <textarea name="description_en" class="form-control" rows="5"
                                                  placeholder="Enter description">{{ $sections->description_en }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description (Optional) (Bangla)</label>
                                        <textarea name="description_bn" class="form-control" rows="5"
                                                  placeholder="Enter description">{{ $sections->description_bn }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="category_type">Select Contact type</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="contact_us" @if($sections->category_type == 'contact_us') selected @endif>Contact us</option>
                                            <option value="connect_us_social" @if($sections->category_type == 'connect_us_social') selected @endif>Connect Us At Social Media</option>
                                        </select>
                                </div>

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
            var sectionName = $('#contact_section').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

            $('#contact_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

            // console.log(sectionNameRemoveSpace);
        });

        

    });
</script>

@endpush



