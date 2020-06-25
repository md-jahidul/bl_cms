@extends('layouts.admin')
@section('title', 'Edit Roaming Operator')
@section('card_name', 'Roaming Operator')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming/operators') }}"> Roaming Operator list</a></li>
<li class="breadcrumb-item ">Operator Edit</li>
@endsection
@section('action')
<a href="{{ url('roaming/operators') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ route('operator.update') }}" class="form home_news_form" novalidate enctype="multipart/form-data">
                           <input type="hidden" value="{{$operator->id}}" name="operator_id">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="required">Country (EN)</label>
                                <input type="text" class="form-control" value="{{$operator->country_en}}"
                                       required name="country_en" placeholder="Enter country name in English">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Country (BN)</label>
                                <input type="text" class="form-control" value="{{$operator->country_bn}}"
                                       name="country_bn" placeholder="Enter country name in Bangla">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="required">Operator (EN)</label>
                                <input type="text" class="form-control" value="{{$operator->operator_en}}"
                                       required name="operator_en" placeholder="Enter operator name in English">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Operator (BN)</label>
                                <input type="text" class="form-control" value="{{$operator->operator_bn}}"
                                       name="operator_bn" placeholder="Enter operator name in Bangla">
                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 col-xs-12">
                                    <label> Instructions To Setup (EN)</label>
                                    <textarea class="form-control summernote_editor" name="details_en">{{$operator->details_en}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in offer page pop-up
                                    </small>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label>Instructions To Setup (BN)</label>
                                    <textarea class="form-control summernote_editor" name="details_bn">{{$operator->details_en}}</textarea>
                                    <small class="text-info">
                                        <strong>Note:</strong> It'll show in offer page pop-up
                                    </small>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tap Code</label>
                                <input type="text" class="form-control" value="{{$operator->tap_code}}"
                                       name="tap_code" placeholder="Enter tap code">
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
{{--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">--}}
@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
{{--<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>--}}

<script>
$(function () {


//     $(".text_editor").summernote({
//         toolbar: [
//             ['style', ['bold', 'italic', 'underline', 'clear']],
//             ['font', ['strikethrough', 'superscript', 'subscript']],
//             ['fontsize', ['fontsize']],
//             ['color', ['color']],
// // ['table', ['table']],
//             ['para', ['ul', 'ol', 'paragraph']],
//             ['view', ['fullscreen', 'codeview']]
//         ],
//         height: 170
//     });





});


</script>
@endpush
