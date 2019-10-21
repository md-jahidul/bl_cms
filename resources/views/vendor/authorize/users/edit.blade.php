@php
    function match($id,$roles){
        foreach ($roles as $role)
        {
            if($role->id == $id){
                return true;
            }
        }

        return false;
    }
@endphp

@extends('layouts.admin')
@section('title', 'User Create')
@section('card_name', 'User Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('authorize/users') }}"> User List</a></li>
    <li class="breadcrumb-item active"> User Edit</li>
@endsection
@section('action')
    <a href="{{ url('authorize/users') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("users.update", $user->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter company name english"
                                           value="{{ $user->name }}" required data-validation-required-message="Enter company name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>



                                <div class="form-group col-md-6 {{ $errors->has('email') ? ' error' : '' }}">
                                    <label for="email" class="required">Email address</label>
                                    <input type="text" name="email"  class="form-control" placeholder="Enter company name bangla"
                                           value="{{ $user->email }}" required data-validation-required-message="Enter company name bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('email'))
                                        <div class="help-block">  {{ $errors->first('email') }}</div>
                                    @endif
                                </div>


                                <div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                    <label for="role_id" class="required">Role</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" name="role_id[]"
                                                required data-validation-required-message="Please select role">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ match($role->id,$user->roles) ? 'selected' : ""}}>{{$role->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6 {{ $errors->has('password') ? ' error' : '' }}">--}}
{{--                                    <label for="password" class="required">Password</label>--}}
{{--                                    <input type="text" name="password"  class="form-control" placeholder="Enter password"--}}
{{--                                           value="{{ $user->password }}" required data-validation-required-message="Enter password">--}}
{{--                                    <div class="help-block"></div>--}}
{{--                                    @if ($errors->has('password'))--}}
{{--                                        <div class="help-block">  {{ $errors->first('password') }}</div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> UPDATE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            @method('put')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







