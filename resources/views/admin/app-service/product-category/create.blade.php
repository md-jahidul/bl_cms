@extends('layouts.admin')
@section('title', 'Offer Category Create')
@section('card_name', 'Offer Category Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">App & Service Tabs List</a></li>
    <li class="breadcrumb-item active"> App & Service Tabs Edit</li>
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
                        <form role="form" action="{{ route("category.store") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter duration name in english"
                                           required data-validation-required-message="Enter title name in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title name in Bangla"
                                           required data-validation-required-message="Enter title name in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">App Service Tab</label>
                                    <select class="form-control" name="app_service_tab_id" required data-validation-required-message="Please select App Service Tab">
                                        <option value="">---Select App Service Tab---</option>
                                        @foreach($appServiceTabs as $appServiceTab)
                                            <option value="{{ $appServiceTab->id }}">{{ $appServiceTab->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
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














