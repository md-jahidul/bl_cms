@extends('layouts.admin')
@section('title', 'Vendor Api Create')
@section('card_name', 'Vendor Api')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('vendor-api.index') }}">Vendor Api List</a></li>
    <li class="breadcrumb-item active"> Vendor Api Create</li>
@endsection
@section('action')
    <a href="{{ route('category.index') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("vendor-api.store") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('vendor_name') ? ' error' : '' }}">
                                    <label for="vendor_name" class="required">Vendor Name</label>
                                    <input type="text" name="vendor_name"  class="form-control" placeholder="Enter vendor name"
                                           required data-validation-required-message="Enter vendor name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('vendor_name'))
                                        <div class="help-block">  {{ $errors->first('vendor_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('end_point_url') ? ' error' : '' }}">
                                    <label for="end_point_url" class="required">End Point URL</label>
                                    <input type="text" name="end_point_url"  class="form-control" placeholder="Enter end point url"
                                           required data-validation-required-message="Enter end point url">

                                    <span class="text-warning"><strong class="text-black-50">Example:</strong> cinematic or gameon</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('end_point_url'))
                                        <div class="help-block">  {{ $errors->first('end_point_url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1"><strong>Status</strong>:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
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














