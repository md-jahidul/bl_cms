@extends('layouts.admin')
@section('title', 'Roaming General Pages Edit')
@section('card_name', 'Page Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-general') }}"> Category & Page List</a></li>
<li class="breadcrumb-item active"> Update Components</li>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>{{ ucwords( str_replace('-', ' ', $page->page_type)) }} Components</strong></h4>
                <div class="row">

                    <div class="col-md-12 col-xs-12">


                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="22%">Type</th>
                                    <th width="72%">Text</th>
                                </tr>
                            </thead>
                            <tbody class="component_sortable">
                                @foreach($components as $cam)
                                <tr data-index="{{ $cam->id }}" data-position="{{ $cam->position }}">

                                    <td class="category_name cursor-move">
                                        <i class="icon-cursor-move icons"></i> 

                                        <strong class="text-info">

                                            {{ ucwords( str_replace('_', ' ', $cam->component_type)) }} </strong>
                                    </td>

                                    <td>
                                        {{ $cam->body_text_en }} 
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>



                </div>

            </div>
        </div>
    </div>


    <form method="POST" action="{{ url('roaming/update-general-page') }}" class="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  value="{{$page->id}}" name="page_id">
        <input type="hidden"  value="{{$page->page_type}}" name="page_type">

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Page: {{ ucwords( str_replace('-', ' ', $page->page_type)) }}</strong></h4>
                    <div class="row">

                        <div class="col-md-12 col-xs-12">


                            <div class="form-group row">
                                <div class="col-md-6 col-xs-12">
                                    <label>Page Title (EN) <span class="text-danger">*</span></label>
                                    <input type="text"  value="{{$page->title_en}}" class="form-control name_en" required name="title_en" placeholder="Title EN">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label>Page Title (BN) <span class="text-danger">*</span></label>
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
                            <?php $position = 1; ?>
                            
                            @foreach($components as $com)
                            
                            <?php
                            $position = $com->position;
                            ?>

                            @if($com->component_type == 'feature_title')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$com->position}}]">
                                <div class="col-md-6 col-xs-12">
                                    <label>Feature Title (EN) 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{$com->body_text_en}}"  name="feature_title_en[{{$com->position}}]">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Feature Title (BN) <span class="text-danger">*</span>
                                        <a href="javascript:;" class="pull-right text-danger remove_feature_title"><i class="la la-close"></i></a>
                                    </label>
                                    <input type="text" class="form-control" value="{{$com->body_text_bn}}" name="feature_title_bn[{{$com->position}}]">

                                </div>

                            </div>

                            @endif


                            @if($com->component_type == 'highlights_title')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$com->position}}]">
                                <div class="col-md-6 col-xs-12">
                                    <label>Highlights Title (EN) 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{$com->body_text_en}}" name="highlights_title_en[{{$com->position}}]">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Highlights Title (BN) <span class="text-danger">*</span>
                                        <a href="javascript:;" class="pull-right text-danger remove_highlights_title"><i class="la la-close"></i></a>
                                    </label>
                                    <input type="text" class="form-control" value="{{$com->body_text_bn}}" name="highlights_title_bn[{{$com->position}}]">
                                </div>
                            </div>

                            @endif

                            @if($com->component_type == 'advance_title')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$com->position}}]">
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Advance Title (EN) 
                                        <span class="text-danger">*</span>

                                        <strong class="pull-right text-info">
                                            <input type="checkbox" value="1" name="advance_title_big_font[{{$com->position}}]" @if($com->big_font == 1) checked @endif> Big Font
                                        </strong>

                                    </label>
                                    <textarea class="form-control" name="advance_title_en[{{$com->position}}]">{{$com->body_text_en}}</textarea>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Advance Title (BN) <span class="text-danger">*</span>
                                        <a href="javascript:;" class="pull-right text-danger remove_advance_title"><i class="la la-close"></i></a>
                                    </label>
                                    <textarea class="form-control" name="advance_title_bn[{{$com->position}}]">{{$com->body_text_bn}}</textarea>
                                </div>
                            </div>


                            @endif

                            @if($com->component_type == 'condition_list')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$com->position}}]">
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Condition List (EN) 
                                        <span class="text-danger">*</span>

                                        <strong class="pull-right text-info">
                                            <input type="checkbox" value="1" name="payment_block[{{$com->position}}]" @if($com->payment_block == 1) checked @endif> Payment Block
                                        </strong>

                                    </label>
                                    <textarea class="form-control details_editor_edit" name="condition_list_en[{{$com->position}}]">{{$com->body_text_en}}</textarea>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label class="display-block">Condition Title (BN) <span class="text-danger">*</span>
                                        <a href="javascript:;" class="pull-right text-danger remove_condition_list"><i class="la la-close"></i></a>
                                    </label>
                                    <textarea class="form-control details_editor_edit" name="condition_list_bn[{{$com->position}}]">{{$com->body_text_bn}}</textarea>
                                </div>
                            </div>


                            @endif

                            @endforeach

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

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">
            <div class="col-md-6 col-xs-12">
                <label>Feature Title (EN) 
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control feature_title_en"  placeholder="Feature Title EN">
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Feature Title (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_feature_title"><i class="la la-close"></i></a>
                </label>
                <input type="text" class="form-control feature_title_bn" placeholder="Feature Title BN">

            </div>

        </div>

    </div>

    <div class="highlights_title_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">
            <div class="col-md-6 col-xs-12">
                <label>Highlights Title (EN) 
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control highlights_title_en"  placeholder="Highlights Title EN">
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Highlights Title (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_highlights_title"><i class="la la-close"></i></a>
                </label>
                <input type="text" class="form-control highlights_title_bn" placeholder="Highlights Title BN">
            </div>
        </div>

    </div>

    <div class="advance_title_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Advance Title (EN) 
                    <span class="text-danger">*</span>

                    <strong class="pull-right text-info">
                        <input type="checkbox" value="1" class="advance_title_big_font"> Big Font
                    </strong>

                </label>
                <textarea class="form-control advance_title_en"></textarea>
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Advance Title (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_advance_title"><i class="la la-close"></i></a>
                </label>
                <textarea class="form-control advance_title_bn"></textarea>
            </div>
        </div>

    </div>


    <div class="condition_list_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Condition List (EN) 
                    <span class="text-danger">*</span>

                    <strong class="pull-right text-info">
                        <input type="checkbox" value="1" class="payment_block"> Payment Block
                    </strong>

                </label>
                <textarea class="form-control details_editor condition_list_en"></textarea>
            </div>
            <div class="col-md-6 col-xs-12">
                <label class="display-block">Condition Title (BN) <span class="text-danger">*</span>
                    <a href="javascript:;" class="pull-right text-danger remove_condition_list"><i class="la la-close"></i></a>
                </label>
                <textarea class="form-control details_editor condition_list_bn"></textarea>
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


    function saveNewPositions(save_url)
    {
        var positions = [];
        $('.component_sortable tr').each(function () {
            positions.push([
                $(this).attr('data-index'),
                $(this).attr('data-position')
            ]);
        })
        $.ajax({
            type: "GET",
            url: save_url,
            data: {
                update: 1,
                position: positions
            },
            success: function (data) {
            },
            error: function () {
                swal.fire({
                    title: 'Failed to sort data',
                    type: 'error',
                });
            }
        });
    }

    $(".component_sortable").sortable({

        update: function (event, ui) {
            $(this).children().each(function (index) {
                if ($(this).attr('data-position') != (index + 1)) {
                    $(this).attr('data-position', (index + 1)).addClass('update')
                }
            });
            var save_url = "{{ url('roaming/page-component-sort') }}";
            saveNewPositions(save_url);
        }
    });


    var position = "<?php echo $position+1 ?>";

    //add feature title
    $('.add_feature_title').on('click', function () {

        var html = $(".feature_title_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var name_en = 'feature_title_en[' + position + ']';
        $(html).find('.feature_title_en').attr('name', name_en);

        var name_bn = 'feature_title_bn[' + position + ']';
        $(html).find('.feature_title_bn').attr('name', name_bn);

        $('.element_wrap').append(html);

        position++;

    });

    //remove feature title
    $('.element_wrap').on('click', '.remove_feature_title', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });

     

    });

    //add highlights title
    $('.add_highlights_title').on('click', function () {

        var html = $(".highlights_title_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var name_en = 'highlights_title_en[' + position + ']';
        $(html).find('.highlights_title_en').attr('name', name_en);

        var name_bn = 'highlights_title_bn[' + position + ']';
        $(html).find('.highlights_title_bn').attr('name', name_bn);

        $('.element_wrap').append(html);

        position++;

    });

    //remove highlights title
    $('.element_wrap').on('click', '.remove_highlights_title', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });

 

    });

    //add highlights title
    $('.add_advance_title').on('click', function () {

        var html = $(".advance_title_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var font = 'advance_title_big_font[' + position + ']';
        $(html).find('.advance_title_big_font').attr('name', font);

        var name_en = 'advance_title_en[' + position + ']';
        $(html).find('.advance_title_en').attr('name', name_en);

        var name_bn = 'advance_title_bn[' + position + ']';
        $(html).find('.advance_title_bn').attr('name', name_bn);

        $('.element_wrap').append(html);

        position++;

    });

    //remove highlights title
    $('.element_wrap').on('click', '.remove_advance_title', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });

     

    });

    //add highlights title
    $('.add_condition_list').on('click', function () {

        var html = $(".condition_list_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var block = 'payment_block[' + position + ']';
        $(html).find('.payment_block').attr('name', block);

        var name_en = 'condition_list_en[' + position + ']';
        $(html).find('.condition_list_en').attr('name', name_en);

        var name_bn = 'condition_list_bn[' + position + ']';
        $(html).find('.condition_list_bn').attr('name', name_bn);

        $('.element_wrap').append(html);

        $(".element_wrap textarea.details_editor").summernote({
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
        });

        position++;

    });

    //remove highlights title
    $('.element_wrap').on('click', '.remove_condition_list', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });



    });
    
    
     $(".element_wrap textarea.details_editor_edit").summernote({
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
        });



});


</script>
@endpush




