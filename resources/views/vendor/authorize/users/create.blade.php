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
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('users.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
                                    <label for="name" class="required">Name</label>
                                    <input type="text" name="name"  class="form-control" placeholder="Enter company name english"
                                           value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter company name english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name'))
                                        <div class="help-block">  {{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('email') ? ' error' : '' }}">
                                    <label for="email" class="required">Email address</label>
                                    <input type="text" name="email"  class="form-control" placeholder="Enter company name bangla"
                                           value="{{ old("email") ? old("email") : '' }}" required data-validation-required-message="Enter company name bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('email'))
                                        <div class="help-block">  {{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-0{{ $errors->has('role_id') ? ' error' : '' }} ext-bold-600 font-medium-2">
                                    <label for="role_id" class="required">Role</label>
{{--                                    <fieldset class="form-group position-relative">--}}

{{--                                            <select class="select2-size-sm form-control" name="role_id" id="small-multiple" multiple="multiple" style="border: none impotent;">--}}
{{--                                                    <option value="AZ">Arizona</option>--}}
{{--                                                    <option value="CO">Colorado</option>--}}
{{--                                                    <option value="ID">Idaho</option>--}}
{{--                                                    <option value="MT">Montana</option>--}}
{{--                                                    <option value="NE">Nebraska</option>--}}
{{--                                                    <option value="NM">New Mexico</option>--}}
{{--                                                    <option value="ND">North Dakota</option>--}}
{{--                                                    <option value="UT">Utah</option>--}}
{{--                                                    <option value="WY">Wyoming</option>--}}
{{--                                            </select>--}}

                                        <select class="select2-size-sm form-control" name="role_id[]" id="small-multiple"
                                                required data-validation-required-message="Please select role" multiple="multiple">
{{--                                            <option selected="" value="">--Select role--</option>--}}
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{--{{ (old('partner_category_id') == $partnerCategory->id) ? 'selected' : ""}}--}}>
                                                    {{$role->name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('role_id'))
                                            <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                        @endif
{{--                                    </fieldset>--}}
                                </div>



                                <div class="form-group col-md-6 {{ $errors->has('password') ? ' error' : '' }}">
                                    <label for="password" class="required">Password</label>
                                    <input type="text" name="password"  class="form-control" placeholder="Enter company website"
                                           value="{{ old("password") ? old("password") : '' }}" required data-validation-required-message="Enter company website">
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

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush







