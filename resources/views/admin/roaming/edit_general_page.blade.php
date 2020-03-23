@extends('layouts.admin')
@section('title', 'Roaming General Pages Edit')
@section('card_name', 'Roaming General Pages Edit')

@section('content')
<section>

    <form method="POST" action="{{ url('roaming/update-general-page') }}" class="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  value="{{$page->id}}" name="page_id">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Page: {{ ucwords( str_replace('-', ' ', $page->page_type)) }}</strong></h4>
                    <div class="row">

                        <div class="col-md-12 col-xs-12">


                            <div class="form-group row">
                                <div class="col-md-6 col-xs-12">
                                    <label>Title (EN) <span class="text-danger">*</span></label>
                                    <input type="text"  value="{{$page->title_en}}" class="form-control name_en" required name="title_en" placeholder="Title EN">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label>Title (BN) <span class="text-danger">*</span></label>
                                    <input type="text" value="{{$page->title_bn}}" class="form-control name_bn" required name="title_bn" placeholder="Title BN">
                                </div>

                            </div>



                        </div>



                    </div>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <strong>Add Elements: </strong>
                    <a href="javascript:;" class="btn btn-sm btn-info add_feature_title">Add Feature Title</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_highlights_title">Add Highlights Title</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_advance_title">Add Advance Title</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_condition_list">Add Condition List</a>
                    <hr>
                    <div class="row">

                        <div class="col-md-7 col-xs-12 element_wrap">


                        </div>


                        <div class="col-md-5 col-xs-12">
                            <h4>Sample/Instruction</h4>
                            <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/roaming_general_page_sample.png')}}" width="100%">

                        </div>



                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
    </form>

    <div class="feature_title_wrap display-hidden">

        <div class="form-group row">
            <div class="col-md-6 col-xs-12">
                <label>Feature Title (EN) <span class="text-danger">*</span></label>
                <input type="text" class="form-control feature_title_en" placeholder="Feature Title EN">
            </div>
            <div class="col-md-6 col-xs-12">
                <label>Feature Title (BN) <span class="text-danger">*</span></label>
                <input type="text" class="form-control feature_title_bn" placeholder="Feature Title BN">
            </div>

        </div>


    </div>



</section>

@stop

@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>


<script>
$(function () {

    //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
        swal.fire({
            title: "{{ Session::get('sussess') }}",
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    <?php
}
if (Session::has('error')) {
    ?>

        swal.fire({
            title: "{{ Session::get('error') }}",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

<?php } ?>

    var position = 1;

    $('.add_feature_title').on('click', function () {

        var feature = $(".feature_title_wrap .form-group").clone();
        
        var name_en = 'feature_title_en[' + position + ']';
        $(feature).find('.feature_title_en').attr('name', name_en);
        
        var name_bn = 'feature_title_bn[' + position + ']';
        $(feature).find('.feature_title_bn').attr('name', name_bn);
        
        $('.element_wrap').append(feature);
        
        position++;

    });


    //text editor for package details
    $("textarea.textarea_details").summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            // ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']]
        ],
        height: 170
    });

});


</script>
@endpush




