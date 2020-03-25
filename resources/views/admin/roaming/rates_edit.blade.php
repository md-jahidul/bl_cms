@extends('layouts.admin')
@section('title', 'Edit Roaming Operator')
@section('card_name', 'Roaming Operator')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming/operators') }}"> Roaming Operator list</a></li>
<li class="breadcrumb-item active">Operator Edit</li>
@endsection
@section('action')
<a href="{{ url('roaming/operators') }}" class="btn btn btn-secondary"><i class="la la-arrow-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ route('operator.update', $operator->id) }}" class="form home_news_form" novalidate enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">Country English</label>
                                <input type="text" class="form-control" value="{{$operator->country_en}}"
                                       required name="country_en" placeholder="Enter country name in English">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required">Country Bangla</label>
                                <input type="text" class="form-control" value="{{$operator->country_bn}}"
                                       name="country_bn" placeholder="Enter country name in Bangla" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Operator English<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$operator->operator_en}}"
                                       required name="operator_en" placeholder="Enter operator name in English">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Operator Bangla</label>
                                <input type="text" class="form-control" value="{{$operator->operator_bn}}"
                                       name="operator_bn" placeholder="Enter operator name in Bangla">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tap Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$operator->tap_code}}"
                                       required name="tap_code" placeholder="Enter tap code">
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="title" class="required mr-1">Status:</label>

                                <input type="radio" name="status" value="1" id="input-radio-15" @if($operator->status == 1) {{ 'checked' }} @endif>
                                <label for="input-radio-15" class="mr-1">Active</label>

                                <input type="radio" name="status" value="0" id="input-radio-16" @if($operator->status == 0) {{ 'checked' }} @endif>
                                <label for="input-radio-16">Inactive</label>
                            </div>

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
@endpush




