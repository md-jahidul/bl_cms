@extends('layouts.admin')

{{--@php --}}
{{--$types = array(1=> 'Internet', 2 => 'Voice', 3 => 'Bundle');--}}
{{--$detailsType = $types[$detailsData->type];--}}
{{--@endphp--}}

@section('title', "Edit Amar Offer Details: $detailsData->type")
@section('card_name', "Amar Offer Details ($detailsData->type)")
@section('breadcrumb')
<li class="breadcrumb-item active"> Edit Amar Offer Details {{ $detailsData->type }}</li>
@endsection
@section('action')
<a href="{{ url("amaroffer/details") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="menu-title"><strong>Amar Offer Details Edit {{ ucfirst($detailsData->type) }} </strong></h4><hr>
                <div class="card-body card-dashboard">
                    <form role="form" id="product_form" action="{{ route('amaroffer.update', [$detailsData->type] ) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <input type="hidden" name="product_details_id" value="{{ $detailsData->id }}">
                            <div class="form-group col-md-6 ">
                                <label for="details_en">Offer Details (English)</label>
                                <textarea type="text" name="details_en"  class="form-control summernote_editor">{{ $detailsData->details_en }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="details_bn">Offer Details (Bangla)</label>
                                <textarea type="text" name="details_bn"  class="form-control summernote_editor">{{ $detailsData->details_bn }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i class="la la-check-square-o"></i> Update
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


<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
<script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>



<script>
$(function () {
$("textarea.details").summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        // ['table', ['table']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['fullscreen', 'codeview']]
    ],
    height: 200
})

// $('#design_structure').change(function () {
//     if($(this).val() === 'structure_1') {
//         // alert($(this).val());
//         $('#structure_1').show();
//         $('#structure_2').hide();
//     }else if ($(this).val() === 'structure_2'){
//         $('#structure_2').show();
//         $('#structure_1').hide();
//     }
// })
//
// $('#save').click(function () {
//
//     $(this).submit();
// })

})
            </script>
            @endpush






