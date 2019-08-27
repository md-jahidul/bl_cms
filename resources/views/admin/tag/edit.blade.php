@extends('layouts.master-layout')


@section('main-content')
    <!-- general form elements -->
    <div class="col-md-6 offset-md-3 py-3">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Tag</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ url("tag/$tag->id") }}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="m_name">Name</label>
                        <input type="text" name="title" class="form-control" id="m_name" placeholder="Enter question" value="{{ $tag->title }}">
                    </div>
                    <input type="hidden" name="id" value="{{ $tag->id }}">
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







