@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ url('programs/tab-title') }}">Section List</a></li>
<li class="breadcrumb-item active"> {{$sections->title_en}}</li>
@endsection
@section('action')
<a href="{{ url("programs/tab-title") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">


                <div class="card-body card-dashboard">
                    <form id="topbanner_section" role="form" action="{{ url('programs/tab-title/'.$sections->id.'/update') }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        {{method_field('POST')}}
                        <div class="row">
                            <input type="hidden" name="section_category" value="{{ $sections->category }}">
                            <div class="form-group col-md-4 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                       value="{{ $sections->title_en }}" required data-validation-required-message="Enter slider title_en (english)">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn" class="required1">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (bangla)"
                                       value="{{ $sections->title_bn }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('slug') ? ' error' : '' }}">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" name="slug"  class="form-control section_slug"
                                       value="{{ $sections->slug }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                <div class="help-block"></div>
                                @if ($errors->has('slug'))
                                <div class="help-block">  {{ $errors->first('slug') }}</div>
                                @endif
                            </div>

                            @include('layouts.partials.common_types.text_area_plane',['component'=>$sections])



                            <div class="form-group col-md-4 {{ $errors->has('page_header') ? ' error' : '' }}">
                                <label>Page Header EN (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header">{{$sections->page_header}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('page_header_bn') ? ' error' : '' }}">
                                <label>Page Header BN (HTML)</label>
                                <textarea class="form-control" rows="7" name="page_header_bn">{{$sections->page_header_bn}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                <label>Schema Markup</label>
                                <textarea class="form-control" rows="7" name="schema_markup">{{$sections->schema_markup}}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="col-md-12">
                                <label for="alt_text"></label>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label> URL EN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control slug-convert" value="{{$sections->route_slug}}" required name="route_slug" placeholder="URL">
                                        <small class="text-info">
                                            <strong>i.e:</strong> Strategic-Assistant-Program (no spaces)<br>
                                        </small>
                                        @if($errors->has('route_slug'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('route_slug') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label> URL BN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control slug-convert" value="{{$sections->route_slug_bn}}" required name="route_slug_bn" placeholder="URL">
                                        <small class="text-info">
                                            <strong>i.e:</strong> Strategic-Assistant-Program (no spaces)<br>
                                        </small>
                                        @if($errors->has('route_slug_bn'))
                                            <div class="help-block text-danger">
                                                {{ $errors->first('route_slug_bn') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $sections->is_active == 1 ) checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $sections->is_active == 0 ) checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
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

    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>

@endpush



