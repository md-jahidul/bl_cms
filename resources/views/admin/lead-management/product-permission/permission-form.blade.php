@extends('layouts.admin')
@section('title', 'Add Permission')
@section('card_name', 'Add Permission')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('lead-product-permission') }}"> Lead Permitted User List</a></li>
    <li class="breadcrumb-item active"> Add Permission</li>
@endsection
@section('action')
    <a href="{{ url("lead-product-permission") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-arrow-left"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ route('permission.save')}}" class="form home_news_form" role="form"
                          novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-12 mb-2 {{ $errors->has('user_id') ? ' error' : '' }}">
                                <label><h4><strong class="text-primary">Users</strong></h4></label>
                                <select name="user_id" class="form-control" data-validation-required-message="Please select user" required>
                                    <option value="">--Select User--</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <div class="help-block"></div>
                                @if ($errors->has('user_id'))
                                    <div class="help-block">  {{ $errors->first('user_id') }}</div>
                                @endif
                            </div>
                            <br>
                            <div class="col-md-12 col-xs-12">
                                @foreach($categories as $category)
                                    <div class="form-group mb-3">
{{--                                        {{ dd($category) }}--}}
                                        <h4><strong class="text-primary">{{ $category['category']['title'] }}</strong></h4>
                                        <hr class="mt-0">
                                        <div class="row">
                                            @foreach($category['products'] as $product)
                                                <div class="col-md-3 col-xs-12">
                                                    <label class="text-bold-600 cursor-pointer">
                                                        <input type="checkbox" value="{{ $product->id }}" name="{{ $category['category']['slug'] }}[]">
                                                        {{$product->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group text-right">
                                    <button class="btn btn-info" type="submit">Save</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush




