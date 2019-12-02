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
            <div class="card-header pb-0"><i class="la la-key"></i> Change Password</div><hr>
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            {{--                                <input type="hidden" name="token" value="{{ $token }}">--}}

                            <div class="form-group row">
                                <label for="old_pass" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="old_pass" type="password" class="form-control @error('old_password') is-invalid @enderror" placeholder="Enter current password"
                                           name="old_password" value="{{ $email ?? old('old_password') }}"  autocomplete="email" autofocus>

                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Enter new password"
                                           name="password"  autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm password"
                                            autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> <i class="la la-check-square-o"></i>
                                        {{ __('Change Password') }}
                                    </button>

                                    <a href="{{ url('home') }}" class="btn btn-warning"><i class="la la-arrow-circle-left"></i>
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


@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







