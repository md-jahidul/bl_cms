@extends('layouts.admin')
@section('title', 'Slider Edit')
@section('card_name', 'Slider Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ strpos(url()->previous(), 'about-slider') !== false ? url(url()->previous()) : url($slider->slider_type.'-sliders') }}">Slider List</a></li>
    <li class="breadcrumb-item active"> {{$slider->title_en}}</li>
@endsection
@section('action')
    <a href="{{ strpos(url()->previous(), 'about-slider') !== false ? url(url()->previous()) : url($slider->slider_type.'-sliders') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("sliders/$slider->id/update") }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <input type="hidden" name="slider_type" value="{{ $slider->slider_type }}">
                                <input type="hidden" name="previous_url" value="{{ $previousUrl }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $slider->title_en }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $slider->title_bn }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label> URL (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="url_slug_en" class="form-control" value="{{ isset($data->url_slug_en) ? $data->url_slug_en : null }}"
                                           required placeholder="Enter URL in English" id="url_slug">
                                    <small class="text-info">
                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
                                    </small>
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
                                    <label> URL (Bangla) <span class="text-danger">*</span></label>
                                    <input type="text" name="url_slug_bn" class="form-control" value="{{ isset($data->url_slug_bn) ? $data->url_slug_bn : null }}"
                                           required placeholder="Enter URL in Bangla" id="url_slug">
                                    <small class="text-info">
                                        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
                                    </small>
                                </div>


                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header">{{ isset($data->page_header) ? $data->page_header : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($data->page_header_bn) ? $data->page_header_bn : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($data->schema_markup) ? $data->schema_markup : null }}</textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $slider->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop




