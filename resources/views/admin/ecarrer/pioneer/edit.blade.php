@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('vacancy/pioneer') }}">Section List</a></li>
    <li class="breadcrumb-item active"> {{$sections->title_en}}</li>
@endsection
@section('action')
    <a href="{{ url("vacancy/pioneer") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <div class="card-body card-dashboard">
                        <form id="pioneer_section" role="form" action="{{ url("vacancy/pioneer/$sections->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
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
                                    <input type="text" name="title_bn"  class="form-control section_name" placeholder="Section name"
                                           value="{{ $sections->title_bn }}" required data-validation-required-message="Please enter Section name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label for="alt_text" class="required1">Alt text</label>
                                    <input type="text" name="alt_text"  class="form-control section_alt_text"
                                           value="{{ $sections->alt_text }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">  {{ $errors->first('alt_text') }}</div>
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
                                    @if( !empty($sections->image) )
                                        <img style="height:70px;width:70px;display:block" src="{{ config('filesystems.file_base_url') . $sections->image}}" id="imgDisplay">
                                    @else
                                        <img style="height:70px;width:70px;display:none" id="imgDisplay">
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
                                    <label for="category_type">Select section type</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="how_we_hire" @if($sections->category_type == 'how_we_hire') selected @endif>How we hire</option>
                                            <option value="bottom_news_media" @if($sections->category_type == 'bottom_news_media') selected @endif>Bottom News media section</option>
                                            <option value="job_offers_title" @if($sections->category_type == 'job_offers_title') selected @endif>Job offer sections title</option>
                                        </select>
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('video') ? ' error' : '' }}">
                                    <label for="video" class="required1">Youtube embeded video url</label>
                                    <input type="text" name="video"  class="form-control section_name" placeholder="Youtube video url"
                                           value="{{ $sections->video }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('video'))
                                        <div class="help-block">  {{ $errors->first('video') }}</div>
                                    @endif
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
            var sectionName = $('#pioneer_section').find('.section_name').val();
            var sectionNameLower = sectionName.toLowerCase();
            var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

            $('#pioneer_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

            // console.log(sectionNameRemoveSpace);
        });

        

    });
</script>

@endpush



