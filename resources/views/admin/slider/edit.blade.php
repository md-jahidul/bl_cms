@extends('layouts.master-layout')


@section('main-content')

    <!-- general form elements -->
    <!-- general form elements -->
    <div class="col-md-6 offset-md-3">

        <div class="card card-primary mt-2">
            <div class="card-header">
                <h3 class="card-title">Slider Create</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ url("sliders/$slider->id") }}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="q_name">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $slider->title }}" id="q_name" placeholder="Enter question">
                    </div>

                    <div class="form-group">
                        <label>Slider Type</label>
                        <select class="form-control" name="slider_type_id">
                            <option>--Select slider type--</option>
                            @if(isset($slider_types))
                                @foreach($slider_types as $slider_type)
                                    <option value="{{ $slider_type->id }}" @if($slider_type->id == $slider->slider_type_id) {{'selected'}} @endif>{{ $slider_type->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="Enter description">{{ $slider->description }}</textarea>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->


    {{--{!! Form::open(array('url' => 'foo/bar','method' => 'POST')) !!}--}}

    {{--{{Form::text("username",--}}
    {{--old("username") ? old("username") : (!empty($user) ? $user->username : null),--}}
    {{--[--}}
    {{--"class" => "form-group user-email",--}}
    {{--"placeholder" => "Username",--}}
    {{--])--}}
    {{--}}--}}

    {{--{{Form::password("password",--}}
    {{--[--}}
    {{--"class" => "form-group",--}}
    {{--"placeholder" => "Your Password",--}}
    {{--])--}}
    {{--}}--}}

    {{--{!! Form::close() !!}--}}

@stop







