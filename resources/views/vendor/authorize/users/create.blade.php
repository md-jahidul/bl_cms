@extends('layouts.admin')
@section('title', 'User Create')
@section('card_name', 'User Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('authorize/users') }}"> User List</a></li>
    <li class="breadcrumb-item active"> User Create</li>
@endsection
@section('action')
    <a href="{{ url('authorize/users') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('users.store') }}" method="POST" novalidate enctype="multipart/form-data" id="createUser">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter user name"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter user name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('email') ? ' error' : '' }}">
                                    <label for="email" class="required">Email address</label>
                                    <input type="email" name="email"  class="form-control" placeholder="Enter email address"
                                           value="{{ old("email") ? old("email") : '' }}" required data-validation-required-message="Enter email address">
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
                                                    <option value="{{ $role->id }}">{{$role->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif

{{--                                    <label for="role_id" class="required">Role</label>--}}
{{--                                        <select class="select2-size-sm form-control" name="role_id[]" id="small-multiple"--}}
{{--                                                required data-validation-required-message="Please select role" multiple="multiple">--}}
{{--                                            @foreach($roles as $role)--}}
{{--                                                    <option value="{{ $role->id }}">{{$role->name}} </option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                        <div class="help-block"></div>--}}
{{--                                        @if ($errors->has('role_id'))--}}
{{--                                            <div class="help-block">  {{ $errors->first('role_id') }}</div>--}}
{{--                                        @endif--}}
                                </div>


{{--                                {{ dd(old("password")) }}--}}

                                <div class="form-group col-md-6 {{ $errors->has('password') ? ' error' : '' }}">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" name="password"  class="form-control" placeholder="Enter password"
                                           value="{{ old("password") ? old("password") : '' }}" required data-validation-required-message="Enter password">
                                    <div class="help-block"></div>
                                    @if ($errors->has('password'))
                                        <div class="help-block">  {{ $errors->first('password') }}</div>
                                    @endif
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
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
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/validation/form-validation.min.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $.validator.addMethod("loginRegex", function (value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&.])[A-Za-z\d$@$!%*?&.]{8,}/.test(value);
            // return this.optional(element) || /^[a-zA-Z0-9]{8,}$/i.test(value);
        }, "The password must be minimum 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character");
        $(document).ready(function() {

            $("#createUser").validate({
                rules: {
                    old_password: {
                        required: true,
                        minlength:8,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength:8,
                        maxlength: 20,
                        loginRegex:true

                    },
                    password_confirmation: {
                        equalTo: "#password",
                        minlength: 8,
                        maxlength: 20,
                        loginRegex:true
                    }
                },
                messages: {
                    password: {
                        required: "Password field is required",
                        loginRegex: 'The password must be minimum 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',

                    }
                }

            });

        });
    </script>
@endpush








