@extends('layouts.admin')
@section('title', 'User Create')
{{--@section('card_name', 'User Create')--}}
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item active"> <a href="{{ url('authorize/users') }}"> User List</a></li>--}}
{{--    <li class="breadcrumb-item active"> User Create</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--    <a href="{{ url('authorize/users') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
{{--@endsection--}}
@section('content')
    <section>
        <div class="card">
            <div class="card-header pb-0"><i class="la la-key"></i> Change Password</div>
            <hr>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">

                        <form method="POST" action="{{ route('password.update') }}" id="change-password">
                            @csrf

                            {{--                                <input type="hidden" name="token" value="{{ $token }}">--}}

                            <div class="form-group row">
                                <label for="old_pass"
                                       class="col-md-4 col-form-label text-md-right required">{{ __('Current Password') }}</label>
                                <div class="col-md-6">
                                    <input id="old_pass" type="password"
                                           class="form-control required @error('old_password') is-invalid @enderror"
                                           placeholder="Enter current password"
                                           name="old_password" value="{{ $old_password ?? old('old_password') }}"
                                           autocomplete="email" required autofocus>
                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right required">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Enter new password"
                                           name="password" autocomplete="new-password"
                                           value="{{ $password ?? old('password') }}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right required">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Enter confirm password"
                                           autocomplete="new-password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i>
                                        {{ __('Change Password') }}
                                    </button>

                                    <a href="{{ url('home') }}" class="btn btn-warning"><i
                                            class="la la-arrow-circle-left"></i>
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@php
    $username=explode("@",Auth::user()->email);
    $username=$username[0];
@endphp

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    <script type="text/javascript"
            src="{{ asset('theme/js/scripts/forms/validation/form-validation.min.js') }}"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $.validator.addMethod("loginRegex", function (value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&.])[A-Za-z\d$@$!%*?&.]{6,}/.test(value);
            // return this.optional(element) || /^[a-zA-Z0-9]{8,}$/i.test(value);
        }, "The password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character");
        $.validator.addMethod("username", function (value, element) {
            let Username = '<?php echo $username; ?>';
            let lengthAfterCheck = Username.length;
            if (value.length >= lengthAfterCheck) {
                let index = value.search(Username);
                if (index !== -1) {
                    console.log('Substring found!');
                    // alert("Substring found!");
                    return false;
                } else {
                    console.log('Substring not found!');
                    // alert("Substring not found!");
                    return true;
                }
            }
            return true;
        }, "Username can't use in password");
        $(document).ready(function () {

            $("#change-password").validate({
                rules: {
                    old_password: {
                        required: true,
                        minlength: 6,
                        maxlength: 14
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20,
                        loginRegex: true,
                        username: true,
                        // loginRegexSpecial:true,


                    },
                    password_confirmation: {
                        equalTo: "#password",
                        minlength: 6,
                        maxlength: 20,
                        loginRegex: true
                    }
                },
                messages: {
                    password: {
                        required: "Password field is required",
                        username: 'Username can not use in password',
                        loginRegex: 'The password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character',


                    }
                }

            });

        });
    </script>
@endpush







