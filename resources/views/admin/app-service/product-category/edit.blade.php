@extends('layouts.admin')
@section('title', 'App & Service Category Edit')
@section('card_name', 'App & Service Category Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">App & Service Category List</a></li>
    <li class="breadcrumb-item active"> App & Service Category Edit</li>
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
                        <form role="form" action="{{ route("category.update", $appServiceCat->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">

                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $appServiceCat->title_en }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter duration name in bangla"
                                           value="{{ $appServiceCat->title_bn }}" required data-validation-required-message="Enter duration name in bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">App Service Tab</label>
                                    <select class="form-control" name="app_service_tab_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($appServiceTabs as $appServiceTab)
                                            <option value="{{ $appServiceTab->id }}" {{ ($appServiceTab->id == $appServiceCat->app_service_tab_id ) ? 'selected' : '' }}>{{ $appServiceTab->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="title" class="mr-1"><strong>Status</strong>:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $appServiceCat->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive" {{ $appServiceCat->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
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














