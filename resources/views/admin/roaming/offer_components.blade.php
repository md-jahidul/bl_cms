@extends('layouts.admin')
@section('title', 'Roaming Offer Components')
@section('card_name', 'Offer Components')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-offers') }}">Roaming Offers</a></li>
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
                                @foreach($components as $c)
                                <tr data-index="{{ $c->id }}" data-position="{{ $c->position }}">

                                    <td class="cursor-move">
                                        <i class="icon-cursor-move icons"></i> 
                                        <strong class="text-info">{{ ucwords($c->component_type) }} </strong>
                                    </td>

                                    <td>
                                        {{ $c->body_text_en }} 
                                    </td>
                                    <td>
                                        <a href="{{url('roaming/offer-component-delete/'.$offerId. '/'. $c->id)}}" class="pull-right text-danger delete_component">
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



    <form method="POST" action="{{ url('roaming/update-offer-component') }}" class="form" enctype="multipart/form-data">
        @csrf
        <input type="hidden"  value="{{$offerId}}" name="parent_id">




        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <strong>Add Component: </strong>
                    <a href="javascript:;" class="btn btn-sm btn-info add_text">Text Component</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_table">Table Component</a>

                    <hr>
                    <div class="row">

                        <div class="col-md-12 col-xs-12 element_wrap">
                            <?php $position = 1; ?>

                            @foreach($components as $com)

                            <?php
                            $position = $com->position;
                            ?>


                            @if($com->component_type == 'text')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$position}}]">

                                <div class="col-md-8 col-xs-12">
                                    <h5 class="font-weight-bold">Text Component</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label>Text (EN)</label>
                                            <textarea class="form-control details_editor_edit" name="free_textarea_en[{{$position}}]">{{$com->body_text_en}}</textarea>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Text (BN)
                                                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                                            </label>
                                            <textarea class="form-control details_editor_edit" name="free_textarea_bn[{{$position}}]">{{$com->body_text_bn}}</textarea>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <h6 class="font-weight-bold">Sample/Instruction (Free Text Component)</h6>
                                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_freetext.png')}}" width="100%">

                                </div>


                            </div>

                            @endif


                            @if($com->component_type == 'table')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$position}}]">

                                <div class="col-md-8 col-xs-12">
                                    <h5 class="font-weight-bold">Table Component</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Headline (EN) 
                                                <span class="text-danger">*</span>
                                                <strong class="pull-right text-danger">
                                                    <input type="checkbox" @if($com->show_button == 1) checked @endif value="1" name="show_button[{{$position}}]"> Show Button
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" value="{{$com->headline_en}}" name="headline_text_title_en[{{$position}}]"  placeholder="Headline EN">
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                                                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                                            </label>
                                            <input type="text" class="form-control" value="{{$com->headline_bn}}" name="headline_text_title_bn[{{$position}}]" placeholder="Headline BN">

                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Text (EN)</label>
                                            <textarea class="form-control" name="headline_text_textarea_en[{{$position}}]">{{$com->body_text_en}}</textarea>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Text (BN)</label>
                                            <textarea class="form-control" name="headline_text_textarea_bn[{{$position}}]">{{$com->body_text_bn}}</textarea>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <h6 class="font-weight-bold">Sample/Instruction (Headline & Text Component)</h6>
                                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_headline_text.png')}}" width="100%">

                                </div>

                            </div>

                            @endif







                            @endforeach

                        </div>






                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
    </form>


    <div class="text_component_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Text Component</h5>
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

                    <div class="col-md-6 col-xs-12">
                        <label>Text (EN)</label>
                        <textarea class="form-control details_editor textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Text (BN)</label>
                        <textarea class="form-control details_editor textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction (Text Component)</h6>
                <a href="{{asset('app-assets/images/roaming/offer_text_component.png')}}" target="_blank">
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_text_component.png')}}" width="100%">
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
                <h6 class="font-weight-bold">Sample/Instruction (List Component)</h6>
                <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_table_component.png')}}" width="100%">

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

    $('.delete_component').on('click', function () {
        var confrm = confirm("Do you want to delete this component?");
        if (confrm) {
            return true;
        }
        return false;
    });


    var position = "<?php echo $position + 1 ?>";


    //add list component
    $('.add_text').on('click', function () {

        var html = $(".text_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var head_en = 'headline_en[' + position + ']';
        $(html).find('.headline_en').attr('name', head_en);

        var head_bn = 'headline_bn[' + position + ']';
        $(html).find('.headline_bn').attr('name', head_bn);

        var text_en = 'textarea_en[' + position + ']';
        $(html).find('.textarea_en').attr('name', text_en);

        var text_bn = 'textarea_bn[' + position + ']';
        $(html).find('.textarea_bn').attr('name', text_bn);



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
    //add list component
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

        var tableHead = "<div class='col-md-12 col-xs-12'><h6>Table Head:</h6>";

        var i;
        var width = 100 / cols;
        for (i = 0; i < cols; i++) {
            tableHead += "<input type='text' placeholder='Head " + (i + 1) + "' name='head[" + pos + "][]' width='" + width + "%'>";
        }
        
         tableHead += "<hr></div>";

        var tableRows = "<div class='col-md-12 col-xs-12'><h6>Table Columns:</h6>";
        
        var r;
        for (r = 0; r < rows; r++) {
            
            var c;
            for (c = 0; c < cols; c++) {

                tableRows += "<input type='text' name='col[" + pos + "][]' width='" + width + "%'>";
            }
            tableRows += "<br>";
        }
         tableRows += "</div>";
         
         var tableData = tableHead + tableRows;

       

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




