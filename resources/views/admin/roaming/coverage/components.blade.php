@extends('layouts.admin')
@section('title', 'Roaming Info & Tips Components')
@section('card_name', 'Info & Tips Components')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-info-tips') }}">Info & Tips</a></li>
<li class="breadcrumb-item active"> Update Components</li>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>Component List</strong></h4>
                <div class="row">

                    <div class="col-md-12 col-xs-12">


                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20%">Type</th>
                                    <th width="70%">Text</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="component_sortable">

                                <?php
                                $position = 0;
                                ?>

                                @foreach($components as $c)

                                <?php
                                $position = $c->position;
                                ?>
                                <tr data-index="{{ $c->id }}" data-position="{{ $c->position }}">

                                    <td class="cursor-move">
                                        <i class="icon-cursor-move icons"></i>
                                        <strong class="text-info">{{ ucwords($c->component_type) }} </strong>
                                    </td>

                                    <td>
                                        <?php
                                        $textEn = json_decode($c->body_text_en);
                                        ?>

                                        @if($c->component_type == 'photo')
                                        <strong>Photo Headline: </strong> {{ $textEn->headline_en }}
                                        @endif

                                        @if($c->component_type == 'table')
                                        <strong>Heads: </strong> {{ implode(', ', $textEn->head_en) }}

                                        @endif

                                        @if($c->component_type == 'headline')
                                        <strong>Headline: </strong> {{ $textEn->headline_only_en }}
                                        @endif

                                        @if($c->component_type == 'accordion')
                                        <strong>Accordion Head: </strong> {{ $textEn->accordion_headline_en }}
                                        @endif

                                        @if($c->component_type == 'list')
                                        <strong>List Headline: </strong> {{ $textEn->list_headline_en }}
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{url('roaming/info-component-delete/'.$infoId. '/'. $c->id)}}" class="pull-right text-danger delete_component">
                                            <i class="la la-trash"></i>
                                        </a>
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



    <form method="POST" action="{{ url('roaming/update-info-component') }}" class="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  value="{{$infoId}}" name="parent_id">




        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <strong>Add Component: </strong>
                    <a href="javascript:;" class="btn btn-sm btn-info add_photo">Photo</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_table">Table</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_headline">Headline (only)</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_accordion">Accordion</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_list">List</a>


                    <hr>
                    <div class="row">

                        <div class="col-md-12 col-xs-12 element_wrap">


                            @include('admin.roaming.partials.info_component_edit_view')

                        </div>






                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
    </form>


    <div class="photo_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Photo Component</h5>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-xs-12">
                        <label>Headline (EN)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" required class="form-control headline_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" required class="form-control headline_bn" placeholder="Headline BN">

                    </div>

                    <div class="col-md-3 col-xs-12">
                        <label>Photo 1 <span class="text-danger">*</span></label>
                        <input type="hidden" class="photo_one_old" value="">

                        <input type="file" class="dropify photo_one" required data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        <label>Alt Text</label>
                        <input type="text" class="form-control alt_one" placeholder="Alt Text">
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <label>Photo 2</label>
                        <input type="hidden" class="photo_two_old" value="">

                        <input type="file" class="dropify photo_two" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        <label>Alt Text</label>
                        <input type="text" class="form-control alt_two" placeholder="Alt Text">
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <label>Photo 3</label>
                        <input type="hidden" class="photo_three_old" value="">

                        <input type="file" class="dropify photo_three" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        <label>Alt Text</label>
                        <input type="text" class="form-control alt_three" placeholder="Alt Text">
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <label>Photo 4</label>
                        <input type="hidden" class="photo_four_old" value="">
                        <input type="file" class="dropify photo_four" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        <label>Alt Text</label>
                        <input type="text" class="form-control alt_four" placeholder="Alt Text">
                    </div>



                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction</h6>
                <a href="{{asset('app-assets/images/roaming/info_photo_component.png')}}" target="_blank">
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/info_photo_component.png')}}" width="100%">
                </a>

            </div>


        </div>

    </div>

    <div class="table_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-10 col-xs-12">
                <h5 class="font-weight-bold">Table Component</h5>
                <hr>

                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <input type="text" placeholder="Rows" class="form-control table_rows">
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <input type="text" placeholder="Columns" class="form-control table_columns">
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <button class="btn btn-sm btn-info generate_table">Generate Table</button>
                    </div>
                </div>
                <div class="row table_wrap">
                </div>
            </div>
            <div class="col-md-2 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction</h6>
                <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_table_component.png')}}" width="100%">

            </div>


        </div>

    </div>

    <div class="headline_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Headline Component (For H2)</h5>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-xs-12">
                        <label>Headline (EN)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" required class="form-control headline_only_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" required class="form-control headline_only_bn" placeholder="Headline BN">

                    </div>

                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction</h6>
                <a href="{{asset('app-assets/images/roaming/info_headline.png')}}" target="_blank">
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/info_headline.png')}}" width="100%">
                </a>

            </div>


        </div>

    </div>

    <div class="accordion_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Accordion Component</h5>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-xs-12">
                        <label>Accordion Head (EN)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" required class="form-control accordion_headline_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Accordion Head (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" required class="form-control accordion_headline_bn" placeholder="Headline BN">

                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label>Body Text (EN)</label>
                        <textarea class="form-control details_editor accordion_textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Body Text (BN)</label>
                        <textarea class="form-control details_editor accordion_textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction</h6>
                <a href="{{asset('app-assets/images/roaming/info_accordion.png')}}" target="_blank">
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/info_accordion.png')}}" width="100%">
                </a>

            </div>


        </div>

    </div>

    <div class="list_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">List Component</h5>
                <hr>
                <div class="row">

                    <div class="col-md-6 col-xs-12">
                        <label>List Headline (EN)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" required class="form-control list_headline_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">List Headline (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" required class="form-control list_headline_bn" placeholder="Headline BN">

                    </div>

                    <div class="col-md-6 col-xs-12">
                        <label>List Body (EN)</label>
                        <textarea class="form-control details_editor list_textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>List Body (BN)</label>
                        <textarea class="form-control details_editor list_textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction</h6>
                <a href="{{asset('app-assets/images/roaming/offer_text_component.png')}}" target="_blank">
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_text_component.png')}}" width="100%">
                </a>

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

    var position = "<?php echo $position + 1 ?>";

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
            var save_url = "{{ url('roaming/info-component-sort') }}";
            saveNewPositions(save_url);
        }
    });

    $('.delete_component').on('click', function () {
        var confrm = confirm("Do you want to delete this component?");
        if (confrm) {
            return true;
        }
        return false;
    });





    //add photo component
    $('.add_photo').on('click', function () {

        var html = $(".photo_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var head_en = 'headline_en[' + position + ']';
        $(html).find('.headline_en').attr('name', head_en);

        var head_bn = 'headline_bn[' + position + ']';
        $(html).find('.headline_bn').attr('name', head_bn);

        var photo1 = 'photo_one[' + position + ']';
        $(html).find('.photo_one').attr('name', photo1);

        var alt1 = 'alt_one[' + position + ']';
        $(html).find('.alt_one').attr('name', alt1);

        var photo2 = 'photo_two[' + position + ']';
        $(html).find('.photo_two').attr('name', photo2);
        var alt2 = 'alt_two[' + position + ']';
        $(html).find('.alt_two').attr('name', alt2);

        var photo3 = 'photo_three[' + position + ']';
        $(html).find('.photo_three').attr('name', photo3);
        var alt3 = 'alt_three[' + position + ']';
        $(html).find('.alt_three').attr('name', alt3);

        var photo4 = 'photo_four[' + position + ']';
        $(html).find('.photo_four').attr('name', photo4);
        var alt4 = 'alt_four[' + position + ']';
        $(html).find('.alt_four').attr('name', alt4);

        var photo1Old = 'photo_one_old[' + position + ']';
        $(html).find('.photo_one_old').attr('name', photo1Old);

        var photo2Old = 'photo_two_old[' + position + ']';
        $(html).find('.photo_two_old').attr('name', photo2Old);

        var photo3Old = 'photo_three_old[' + position + ']';
        $(html).find('.photo_three_old').attr('name', photo3Old);

        var photo4Old = 'photo_four_old[' + position + ']';
        $(html).find('.photo_four_old').attr('name', photo4Old);


        $('.element_wrap').append(html);

        //show dropify for  photo
        $('.element_wrap .dropify').dropify({
            messages: {
                'default': 'Browse for photo',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });



        position++;

    });


    //add headline component
    $('.add_headline').on('click', function () {

        var html = $(".headline_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var head_en = 'headline_only_en[' + position + ']';
        $(html).find('.headline_only_en').attr('name', head_en);

        var head_bn = 'headline_only_bn[' + position + ']';
        $(html).find('.headline_only_bn').attr('name', head_bn);

        $('.element_wrap').append(html);
        position++;

    });



    //add list component
    $('.add_accordion').on('click', function () {

        var html = $(".accordion_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var head_en = 'accordion_headline_en[' + position + ']';
        $(html).find('.accordion_headline_en').attr('name', head_en);

        var head_bn = 'accordion_headline_bn[' + position + ']';
        $(html).find('.accordion_headline_bn').attr('name', head_bn);

        var text_en = 'accordion_textarea_en[' + position + ']';
        $(html).find('.accordion_textarea_en').attr('name', text_en);

        var text_bn = 'accordion_textarea_bn[' + position + ']';
        $(html).find('.accordion_textarea_bn').attr('name', text_bn);



        $('.element_wrap').append(html);

        $(".element_wrap textarea.details_editor").summernote({

            tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
            toolbar: [
                ['style',['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ],
            popover: {
                table: [
                    ['custom', ['tableHeaders']],
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                ],
            },

            height:200

            // toolbar: [
            //     ['style', ['bold', 'italic', 'underline', 'clear']],
            //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     ['fontsize', ['fontsize']],
            //     ['color', ['color']],
            //     // ['table', ['table']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['view', ['fullscreen', 'codeview']]
            // ],
            // height: 200
        });

        position++;

    });

    //add list component
    $('.add_list').on('click', function () {

        var html = $(".list_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var head_en = 'list_headline_en[' + position + ']';
        $(html).find('.list_headline_en').attr('name', head_en);

        var head_bn = 'list_headline_bn[' + position + ']';
        $(html).find('.list_headline_bn').attr('name', head_bn);

        var text_en = 'list_textarea_en[' + position + ']';
        $(html).find('.list_textarea_en').attr('name', text_en);

        var text_bn = 'list_textarea_bn[' + position + ']';
        $(html).find('.list_textarea_bn').attr('name', text_bn);



        $('.element_wrap').append(html);

        $(".element_wrap textarea.details_editor").summernote({

            tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
            toolbar: [
                ['style',['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']]
            ],
            popover: {
                table: [
                    ['custom', ['tableHeaders']],
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                ],
            },

            height:200

            // toolbar: [
            //     ['style', ['bold', 'italic', 'underline', 'clear']],
            //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     ['fontsize', ['fontsize']],
            //     ['color', ['color']],
            //     // ['table', ['table']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['view', ['fullscreen', 'codeview']]
            // ],
            // height: 200
        });

        position++;

    });

    //add table component
    $('.add_table').on('click', function () {

        var html = $(".table_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);
        $(html).find('.component_position').val(position);

        $('.element_wrap').append(html);


        position++;

    });

    $(".element_wrap").on('click', '.generate_table', function () {
        var rows = $(this).parents('.row').find('.table_rows').val();
        var cols = $(this).parents('.row').find('.table_columns').val();
        var pos = $(this).parents('.form-group').find('.component_position').val();

        //English table
        var tableHeadEn = "<div class='col-md-12 col-xs-12'><h6>Table Head (EN):</h6>";

        var i;
        var width = 100 / cols;
        for (i = 0; i < cols; i++) {
            tableHeadEn += "<input type='text' placeholder='Head (EN) " + (i + 1) + "' name='head_en[" + pos + "][]' width='" + width + "%'>";
        }

        tableHeadEn += "<hr></div>";

        var tableRowsEn = "<div class='col-md-12 col-xs-12'><h6>Table Columns (EN):</h6>";

        var r;
        for (r = 0; r < rows; r++) {

            var c;
            for (c = 0; c < cols; c++) {

                tableRowsEn += "<input type='text' name='col_en[" + pos + "][" + r + "][]' width='" + width + "%'>";
            }
            tableRowsEn += "<br>";
        }
        tableRowsEn += "</div>";





        //bangla table
        var tableHeadBn = "<div class='col-md-12 col-xs-12'><h6><hr>Table Head (BN):</h6>";

        var i;
        var width = 100 / cols;
        for (i = 0; i < cols; i++) {
            tableHeadBn += "<input type='text' placeholder='Head (BN) " + (i + 1) + "' name='head_bn[" + pos + "][]' width='" + width + "%'>";
        }

        tableHeadBn += "<hr></div>";

        var tableRowsBn = "<div class='col-md-12 col-xs-12'><h6>Table Columns (BN):</h6>";

        var r;
        for (r = 0; r < rows; r++) {

            var c;
            for (c = 0; c < cols; c++) {

                tableRowsBn += "<input type='text' name='col_bn[" + pos + "][" + r + "][]' width='" + width + "%'>";
            }
            tableRowsBn += "<br>";
        }
        tableRowsBn += "</div>";



        var tableData = tableHeadEn + tableRowsEn + tableHeadBn + tableRowsBn;



        $(this).parents(".form-group").find(".table_wrap").html(tableData);

        return false;
    });


    //remove component
    $('.element_wrap').on('click', '.remove_component', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });



    });

    $(".element_wrap").on("keypress keyup blur", '.table_rows, .table_columns', function (event) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });





    $(".element_wrap textarea.details_editor_edit").summernote({
        tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
        toolbar: [
            ['style',['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ],
        popover: {
            table: [
                ['custom', ['tableHeaders']],
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
            ],
        },

        height:200


        // toolbar: [
        //     ['style', ['bold', 'italic', 'underline', 'clear']],
        //     ['font', ['strikethrough', 'superscript', 'subscript']],
        //     ['fontsize', ['fontsize']],
        //     ['color', ['color']],
        //     // ['table', ['table']],
        //     ['para', ['ul', 'ol', 'paragraph']],
        //     ['view', ['fullscreen', 'codeview']]
        // ],
        // height: 200
    });



});


</script>
@endpush




