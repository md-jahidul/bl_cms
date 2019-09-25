@extends('layouts.admin')
@section('title', 'Slider Edit')
@section('card_name', 'Slider Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Slider Edit</li>
@endsection
@section('action')
    <a href="{{ url('sliders') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
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
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ old("title") ? old('title') : $slider->title }}" required data-validation-required-message="Enter slider title" readonly>
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('platform') ? ' error' : '' }}">
                                    <label for="platform" class="required">Platform</label>
                                    <input type="text" name="platform" class="form-control" placeholder="Enter platform"
                                           value="{{ old("platform") ? old('platform') : $slider->platform }}" required data-validation-required-message="Enter slider platform" readonly>
                                    <div class="help-block"></div>
                                    @if ($errors->has('platform'))
                                        <div class="help-block">  {{ $errors->first('platform') }}</div>
                                    @endif
                                </div>
{{--                                <div class="form-group col-md-6 {{ $errors->has('slider_type_id') ? ' error' : '' }}">--}}
{{--                                    <label class="required">Slider Type</label>--}}
{{--                                    <select class="form-control" name="slider_type_id" data-validation-required-message="Select slider type">--}}
{{--                                        <option value="">--Select slider type--</option>--}}
{{--                                        @if(isset($sliderTypes))--}}
{{--                                            @foreach($sliderTypes as $slider_type)--}}
{{--                                                <option value="{{ $slider_type->id }}" {{  ($slider_type->id == $slider->slider_type_id) ? 'selected' : ''}} >{{ $slider_type->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </select>--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('slider_type_id'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('slider_type_id') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" id="exampleInputPassword1" readonly
                                                  placeholder="Enter description">{!! $slider->description !!}</textarea>
                                    </div>
                                </div>

                                @if($slider->platform == 'Web')
                                    @include('layouts.partials.slider-other-attr.' . $type )
                                @endif

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




