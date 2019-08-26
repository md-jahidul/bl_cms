@extends('layouts.master-layout')


@section('main-content')
    <!-- general form elements -->
    <div class="col-md-6 offset-md-3 py-3">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Menu</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ url("menu/$menu->id") }}" method="POST">
                @csrf
                {{method_field('PUT')}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="m_name">Name</label>
                        <input type="text" name="name" class="form-control" id="m_name" placeholder="Enter question" value="{{ $menu->name }}">
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="Enter question" value="{{ $menu->url }}">
                    </div>
                    <div class="form-group mt-4">
                        <label for="m_status">Status:</label>
                        <div class="d-inline ml-3 mr-3">
                            <input type="radio" name="status" id="m_active" value="1" @if($menu->status == 1) {{ 'checked' }} @endif>
                            <label class="text-muted" for="m_active">Active</label>
                        </div>
                        <div class="d-inline">
                            <input type="radio" name="status" id="m_deactivate" value="0" @if($menu->status == 0) {{ 'checked' }} @endif>
                            <label class="text-muted" for="m_deactivate">
                                Inactive
                            </label>
                        </div>
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







