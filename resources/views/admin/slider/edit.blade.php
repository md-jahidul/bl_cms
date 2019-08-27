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
                        <form role="form" action="{{ url("sliders/$slider->id") }}" method="POST">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 required">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ $slider->title }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Slider Type</label>
                                    <select class="form-control" name="slider_type_id">
                                        <option>--Select slider type--</option>
                                        @if(isset($sliderTypes))
                                            @foreach($sliderTypes as $slider_type)
                                                <option value="{{ $slider_type->id }}" {{  ($slider_type->id == $slider->slider_type_id) ? 'selected' : ''}} >{{ $slider_type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="Enter description">{!! $slider->description !!}</textarea>
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
                            <input type="hidden" name="id" value="{{ $slider->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop




