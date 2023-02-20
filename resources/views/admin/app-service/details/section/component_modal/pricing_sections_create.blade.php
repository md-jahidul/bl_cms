
{{ Form::hidden('sections[section_name]', 'Pricing sections' ) }}
{{ Form::hidden('sections[section_type]', 'pricing_sections' ) }}
{{ Form::hidden('sections[tab_type]', $tab_type ) }}
{{ Form::hidden('sections[category]', 'component_sections' ) }}
{{ Form::hidden('component[0][component_type]', 'pricing_mutiple_table' ) }}
<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en" class="required1">
        Component Title (English)
    </label>
    <input type="text" name="component_title_en"  class="form-control section_name" placeholder="Enter title"
            value="{{ isset($section['sections']->title_en) ? $section['sections']->title_en : '' }}">
</div>


<div class="form-group col-md-6 {{ $errors->has('component_title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="required1">
        Component Title (Bangla)
    </label>
    <input type="text" name="component_title_bn"  class="form-control section_name" placeholder="Enter title"
            value="{{ isset($section['sections']->title_bn) ? $section['sections']->title_bn : '' }}">
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Left Table (English)</label>
        <textarea name="component[0][left_editor_en]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->description_en) ? $component->description_en : '' }}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Left Table (Bangla)</label>
        <textarea name="component[0][left_editor_bn]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->description_bn) ? $component->description_bn : '' }}</textarea>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Right Table (English)</label>
        <textarea name="component[0][right_editor_en]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_en) ? $component->editor_en : '' }}</textarea>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Right Table (Bangla)</label>
        <textarea name="component[0][right_editor_bn]" class="form-control summernote_editor" rows="5"
                  placeholder="Enter description">{{ isset($component->editor_bn) ? $component->editor_bn : '' }}</textarea>
    </div>
</div>


<!-- <div class="table_component_wrap">
    <div class="form-group row bg-light ml-1 mr-1 p-2">
        <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
            <label for="title_en" class="required1">
                Component Title (English)
            </label>
            <input type="text" name="component_title_en"  class="form-control section_name" placeholder="Enter title"
                   value="{{ old("component_title_en") ? old("component_title_en") : '' }}">
        </div>


        <div class="form-group col-md-6 {{ $errors->has('component_title_bn') ? ' error' : '' }}">
            <label for="title_bn" class="required1">
                Component Title (Bangla)
            </label>
            <input type="text" name="component_title_bn"  class="form-control section_name" placeholder="Enter title"
                   value="{{ old("component_title_bn") ? old("component_title_bn") : '' }}">
        </div>



        <input type="hidden" name="component_position[2]" value="2" class="component_position">

        <div class="col-md-12 col-xs-12">
            <h5 class="font-weight-bold">Table Component</h5>
            <hr>

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <b>Left Table Generator</b>
                    <hr>
                </div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" placeholder="Rows" class="form-control table_rows">
                </div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" placeholder="Columns" class="form-control table_columns" max="15">
                    <div class="help-block"></div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <button type="button" class="btn btn-sm btn-info generate_table">Generate Table</button>
                </div>

                <slot class="table_wrap left_table">

                </slot>


                <div class="col-md-12 col-xs-12 mt-1">
                    <b>Right Table Generator</b>
                    <hr>
                </div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" placeholder="Rows" class="form-control right_table_rows">
                </div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" placeholder="Columns" class="form-control right_table_columns">
                </div>
                <div class="col-md-4 col-xs-12">
                    <button class="btn btn-sm btn-info generate_right_table">Generate Table</button>
                </div>
                <slot class="table_wrap right_table">

                </slot>
            </div>

        </div>
        {{--                                    <div class="col-md-2 col-xs-12">--}}
        {{--                                        <h6 class="font-weight-bold">Sample/Instruction (List Component)</h6>--}}
        {{--                                        <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/offer_table_component.png')}}" width="100%">--}}
        {{--                                    </div>--}}
    </div>
</div> -->


@push('page-css')
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
 <style>
     .modal-xl.modal_xl_custom {
         max-width: 80%;
         margin-left: 10%;
       	margin-right: 10%;
     }
 </style>
@endpush




@push('page-js')
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>

 <script>
     $(function () {
         $(".generate_table").click(function () {

             var rows = $(this).parents('.row').find('.table_rows').val();
             var cols = $(this).parents('.row').find('.table_columns').val();
             var pos = $(this).parents('.form-group').find('.component_position').val();
             //Left English table
             var tableHeadEn = '<div class="col-md-6 mt-1">' +
                               "<label><b>Left Table Title English</b></label>" +
                               "<input type='text' class='form-control' name='left_table_title_en'>" +
                               "</div>";

                 tableHeadEn += '<div class="col-md-6 mt-1">' +
                               "<label><b>Left Table Title Bangla</b></label>" +
                               "<input type='text' class='form-control' name='left_table_title_bn'>" +
                               "</div>";

                 tableHeadEn += ' <div class="col-md-12">\n' +
                                '<label class="label pt-2"><b>Left Table (English)</b></label>\n' +
                                '<table class="table table-bordered">\n' +
                                '<thead>\n' +
                                '<tr>';

             for (var i = 0; i < cols; i++) {
                 tableHeadEn += "<th><input type='text' class='form-control' placeholder='Table head English' name='left_head_en[" + pos + "][]'></th>";
             }

             tableHeadEn += "<th width='1%'></th></tr>\n" +
                            "</thead>";
             var tableRowsEn = "<tbody>";

             for (var r = 0; r < rows; r++) {
                 tableRowsEn += "<tr>";
                     for (var c = 0; c < cols; c++) {
                         tableRowsEn += "<td><input type='text' class='form-control' name='left_col_en[" + pos + "][" + r + "][]'></td>";
                     }
                 // tableRowsEn += "<td><button class='btn-sm btn-danger'><i class='la la-trash'></i></button></td>";
                 tableRowsEn += "</tr>";
             }
             tableRowsEn += "</tbody><table><div>";

             //Left bangla table
             var tableHeadBn = '<div class="col-md-12 pl-0">\n' +
                 '<label class="label"><b>Left Table (Bangla)</b></label>\n' +
                 '<table class="table table-bordered">\n' +
                 '<thead>\n' +
                 '<tr>';

             for (var i = 0; i < cols; i++) {
                 tableHeadBn += "<th><input type='text' class='form-control' placeholder='Table head Bangla' name='left_head_bn[" + pos + "][]'></th>";
             }

             tableHeadBn += "</tr>\n" +
                 "</thead>";
             var tableRowsBn = "<tbody>";

             for (var r = 0; r < rows; r++) {
                 tableRowsBn += "<tr>";
                 for (var c = 0; c < cols; c++) {
                     tableRowsBn += "<td><input type='text' class='form-control' name='left_col_bn[" + pos + "][" + r + "][]'></td>";
                 }
                 tableRowsBn += "</tr>";
             }
             tableRowsBn += "</tbody><table><div>";

             var tableData = tableHeadEn + tableRowsEn + tableHeadBn + tableRowsBn;

             $(this).parents(".form-group").find(".left_table").html(tableData);

             return false;
         });


         $(".generate_right_table").click(function () {

             var rows = $('.right_table_rows').val();
             var cols = $('.right_table_columns').val();
             var pos = $(this).parents('.form-group').find('.component_position').val();

             //============Right Table English Start=================
             var rightTableHeadEn = '<div class="col-md-6 mt-1">' +
                 "<label><b>Right Table Title English</b></label>" +
                 "<input type='text' class='form-control' name='right_table_title_en'>" +
                 "</div>";

             rightTableHeadEn += '<div class="col-md-6 mt-1">' +
                 "<label><b>Right Table Title Bangla</b></label>" +
                 "<input type='text' class='form-control' name='right_table_title_bn'>" +
                 "</div>";

             rightTableHeadEn += ' <div class="col-md-12">\n' +
                 '<label class="label pt-2"><b>Right Table (English)</b></label>\n' +
                 '<table class="table table-bordered">\n' +
                 '<thead>\n' +
                 '<tr>';

             for (var i = 0; i < cols; i++) {
                 rightTableHeadEn += "<th><input type='text' class='form-control' placeholder='Table head English' name='right_head_en[" + pos + "][]'></th>";
             }
             rightTableHeadEn += "</tr></thead>";

             var rightTableRowsEn = "<tbody>";

             for (var r = 0; r < rows; r++) {
                 rightTableRowsEn += "<tr>";
                 for (var c = 0; c < cols; c++) {
                     rightTableRowsEn += "<td><input type='text' class='form-control' name='right_col_en[" + pos + "][" + r + "][]'></td>";
                 }
                 rightTableRowsEn += "</tr>";
             }
             rightTableRowsEn += "</tbody><table><div>";
             //============Right Table English End=================

             // ===============Right Table Bangla Start=========================
             var rightTableHeadBn = '<div class="col-md-12 pl-0">\n' +
                 '<label class="label"><b>Right Table (Bangla)</b></label>\n' +
                 '<table class="table table-bordered">\n' +
                 '<thead>\n' +
                 '<tr>';
             for (var i = 0; i < cols; i++) {
                 rightTableHeadBn += "<th><input type='text' class='form-control' placeholder='Table head Bangla' name='right_head_bn[" + pos + "][]'></th>";
             }

             rightTableHeadBn += "</tr></thead>";
             var rightTableRowsBn = "<tbody>";

             for (var r = 0; r < rows; r++) {
                 rightTableRowsBn += "<tr>";
                 for (var c = 0; c < cols; c++) {
                     rightTableRowsBn += "<td><input type='text' class='form-control' name='right_col_bn[" + pos + "][" + r + "][]'></td>";
                 }
                 rightTableRowsBn += "</tr>";
             }
             rightTableRowsBn += "</tbody><table><div>";
             // ===============Right Table Bangla End=========================

             var rightTableData = rightTableHeadEn + rightTableRowsEn + rightTableHeadBn + rightTableRowsBn;
             $(".right_table").html(rightTableData);

             return false;
         });

         $(".element_wrap").on("keypress keyup blur", '.table_rows, .table_columns', function (event) {
             $(this).val($(this).val().replace(/[^0-9]/g, ''));
             if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                 event.preventDefault();
             }
         });


         $('.js_editor_box').each(function(k, v){
            $(this).summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                height:200
            });
         });

         // Basic TineMCE
         // tinymce.init({
         //     selector: '.js_editor_box',
         //     height: 350,
         //     theme: 'modern',
         //     plugins: [
         //         'advlist autolink lists link image charmap print preview hr anchor pagebreak',
         //         'searchreplace wordcount visualblocks visualchars code fullscreen',
         //         'insertdatetime media nonbreaking save table contextmenu directionality',
         //         'emoticons template paste textcolor colorpicker textpattern imagetools'
         //     ],
         //
         //     table_default_attributes: {
         //         class: 'table table-primary table_large offer_table'
         //     },
         //
         //     toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
         //     toolbar2: 'print preview media | forecolor backcolor emoticons',
         //     image_advtab: true,
         //     templates: [
         //         {title: 'Test template 1', content: 'Test 1'},
         //         {title: 'Test template 2', content: 'Test 2'}
         //     ],
         //     content_css: [
         //         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
         //         '//www.tinymce.com/css/codepen.min.css'
         //     ]
         // });

         $("textarea#details_en").summernote({
             toolbar: [
                 ['style', ['bold', 'italic', 'underline', 'clear']],
                 ['font', ['strikethrough', 'superscript', 'subscript']],
                 ['fontsize', ['fontsize']],
                 ['color', ['color']],
                 // ['table', ['table']],
                 ['para', ['ul', 'ol', 'paragraph']],
                 ['view', ['fullscreen', 'codeview']]
             ],
             height:200
         });

         // $("textarea#details_bn").summernote({
         //     toolbar: [
         //         ['style', ['bold', 'italic', 'underline', 'clear']],
         //         ['font', ['strikethrough', 'superscript', 'subscript']],
         //         ['fontsize', ['fontsize']],
         //         ['color', ['color']],
         //         // ['table', ['table']],
         //         ['para', ['ul', 'ol', 'paragraph']],
         //         ['view', ['fullscreen', 'codeview']]
         //     ],
         //     height:200
         // });
     })
 </script>
 @endpush
