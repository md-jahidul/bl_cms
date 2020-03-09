@extends('layouts.admin')
@section('title', 'Section Create')
@section('card_name', 'Section Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ route('section-list', [$productDetailsId]) }}"> Section List</a></li>
    <li class="breadcrumb-item active"> Section Create</li>
@endsection
@section('action')
    <a href="{{ route('section-list', [$productDetailsId]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('section-store', $productDetailsId) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="product_id" value="{{ $productDetailsId }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter section title in English"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter section title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter section title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter section title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tag_category_id">Section Type</label>
                                    <select class="form-control" name="section_type">
                                        <option value="">---Select Section Type---</option>
                                        <option value="multi_section">Multi Component Section</option>
                                        <option value="tab_section">Tab Section</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="tag_category_id"></label>
                                    <div class="form-group mt-1">
                                        <label for="is_tab_section" class="mr-1">Is Tab Section</label>
                                        <input type="checkbox" name="other_attributes[is_tab_section]" value="1" id="is_tab_section">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
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







