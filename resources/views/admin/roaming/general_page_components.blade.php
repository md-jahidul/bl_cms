@extends('layouts.admin')
@section('title', 'Roaming General Pages Edit')
@section('card_name', 'Page Edit')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming-general') }}"> Category & Page List</a></li>
<li class="breadcrumb-item active"> Update Components</li>
@endsection
@section('content')
<section>



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
                            <div class="form-group row">
                                <div class="col-md-4 col-xs-12">
                                    <label>Short Description (EN)</label>
                                    <textarea class="form-control summernote_editor" name="short_description_en">{{$page->short_description_en}}</textarea>

                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <label>Short Description (BN)</label>
                                    <textarea class="form-control summernote_editor" name="short_description_bn">{{$page->short_description_bn}}</textarea>
                                </div>


                                <div class="col-md-4 col-xs-12">
                                    <h4>Sample/Instruction</h4>
                                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_short_text.png')}}" width="100%">

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-6 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword En</label>
                                    <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                              placeholder="Enter keywords en"
                                    >{{ $page->searchableFeature->tag_en ?? '' }}</textarea>
                                    <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_en'))
                                        <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword Bn</label>
                                    <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                              placeholder="Enter keywords bn">{{ $page->searchableFeature->tag_bn ?? '' }}</textarea>
                                    <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_bn'))
                                        <div class="help-block">{{ $errors->first('tag_bn') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-xs-12">
                                    <label>Url Slug (EN) </label>
                                    <input type="text" class="form-control" name="url_slug_en" value="{{ $page->url_slug_en }}">
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label>Url Slug (BN) </label>
                                    <input type="text" class="form-control" name="url_slug_bn"
                                    value="{{ $page->url_slug_bn }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4 col-xs-12">
                                    <label>Page Header (EN) </label>
                                   <textarea name="page_header_en" class="form-control" cols="30" rows="2">{{ $page->page_header_en }}</textarea>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <label>Page Header (BN) </label>
                                   <textarea name="page_header_bn" class="form-control" cols="30" rows="2">{{ $page->page_header_bn }}</textarea>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <label>Schema Markup </label>
                                   <textarea name="schema_markup" class="form-control" cols="30" rows="2">{{ $page->schema_markup }}</textarea>
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
                    <h4 class="pb-1"><strong>{{ ucwords( str_replace('-', ' ', $page->page_type)) }} Components</strong></h4>
                    <div class="row">

                        <div class="col-md-12 col-xs-12">


                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">Type</th>
                                        <th width="70%">Title</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="component_sortable">
                                    @foreach($components as $c)
                                    <tr data-index="{{ $c->id }}" data-position="{{ $c->position }}">
                                        <td class="category_name cursor-move">
                                            <i class="icon-cursor-move icons"></i>
                                            <strong class="text-info">{{ ucwords( str_replace('_', ' ', $c->component_type)) }} </strong>
                                        </td>

                                        <td>
                                            {!! $c->headline_en !!}
                                        </td>
                                        <td>
                                            <a href="{{url('roaming/page-component-delete/'.$page->id. '/'. $c->id)}}" class="pull-right text-danger delete_component">
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


        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <strong>Add Component: </strong>
                    <a href="javascript:;" class="btn btn-sm btn-info add_headline_text">Headline & Text</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_list_component">List Component</a>
                    <a href="javascript:;" class="btn btn-sm btn-info add_free_text">Add Free Text</a>

                    <hr>
                    <div class="row">

                        <div class="col-md-12 col-xs-12 element_wrap">
                            <?php $position = 1; ?>

                            @foreach($components as $com)

                            <?php
                            $position = $com->position;
                            ?>

                            @if($com->component_type == 'headline-text')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$position}}]">

                                <div class="col-md-8 col-xs-12">
                                    <h5 class="font-weight-bold">Headline & Text Component</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Headline (EN)
                                                <span class="text-danger">*</span>
                                                <strong class="pull-right text-danger">
                                                    <input type="checkbox" @if($com->show_button == 1) checked @endif value="1" name="show_button[{{$position}}]"> Show Button
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" required value="{{$com->headline_en}}" name="headline_text_title_en[{{$position}}]"  placeholder="Headline EN">
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                                                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                                            </label>
                                            <input type="text" class="form-control" required value="{{$com->headline_bn}}" name="headline_text_title_bn[{{$position}}]" placeholder="Headline BN">

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

                            @if($com->component_type == 'list-component')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$position}}]">

                                <div class="col-md-8 col-xs-12">
                                    <h5 class="font-weight-bold">List Component</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <label>Headline (EN)
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" required value="{{$com->headline_en}}" name="list_headline_en[{{$position}}]"  placeholder="Headline EN">
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                                                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                                            </label>
                                            <input type="text" class="form-control" required value="{{$com->headline_bn}}" name="list_headline_bn[{{$position}}]" placeholder="Headline BN">

                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Text (EN)</label>
                                            <textarea class="form-control details_editor_edit" name="list_textarea_en[{{$position}}]">{{$com->body_text_en}}</textarea>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <label>Text (BN)</label>
                                            <textarea class="form-control details_editor_edit" name="list_textarea_bn[{{$position}}]">{{$com->body_text_bn}}</textarea>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <h6 class="font-weight-bold">Sample/Instruction (List Component)</h6>
                                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_list.png')}}" width="100%">

                                </div>


                            </div>

                            @endif

                            @if($com->component_type == 'free-text')

                            <div class="form-group row bg-light p-2 mr-1 mt-1">
                                <input type="hidden" name="component_position[{{$position}}]">

                                <div class="col-md-8 col-xs-12">
                                    <h5 class="font-weight-bold">Free Text Component</h5>
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




                            @endforeach

                        </div>






                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
    </form>

    <div class="headline_text_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Headline & Text Component</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Headline (EN)
                            <span class="text-danger">*</span>
                            <strong class="pull-right text-danger">
                                <input type="checkbox" value="1" class="show_button"> Show Button
                            </strong>
                        </label>
                        <input type="text" class="form-control headline_text_title_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" class="form-control headline_text_title_bn" placeholder="Headline BN">

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Text (EN)</label>
                        <textarea class="form-control headline_text_textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Text (BN)</label>
                        <textarea class="form-control headline_text_textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction (Headline & Text Component)</h6>
                <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_headline_text.png')}}" width="100%">

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
                        <label>Headline (EN)
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control list_headline_en"  placeholder="Headline EN">
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Headline (BN) <span class="text-danger">*</span>
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <input type="text" class="form-control list_headline_bn" placeholder="Headline BN">

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Text (EN)</label>
                        <textarea class="form-control details_editor list_textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label>Text (BN)</label>
                        <textarea class="form-control details_editor list_textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction (List Component)</h6>
                <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_list.png')}}" width="100%">

            </div>


        </div>

    </div>

    <div class="free_text_wrap display-hidden">

        <div class="form-group row bg-light p-2 mr-1 mt-1">
            <input type="hidden" class="component_position">

            <div class="col-md-8 col-xs-12">
                <h5 class="font-weight-bold">Free Text Component</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <label>Text (EN)</label>
                        <textarea class="form-control details_editor free_textarea_en"></textarea>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <label class="display-block">Text (BN)
                            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>
                        </label>
                        <textarea class="form-control details_editor free_textarea_bn"></textarea>
                    </div>


                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h6 class="font-weight-bold">Sample/Instruction (Free Text Component)</h6>
                <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/general_page_freetext.png')}}" width="100%">

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

    $('.delete_component').on('click', function(){
        var confrm = confirm("Do you want to delete this component?");
        if(confrm){
            return true;
        }
        return false;
    });


    var position = "<?php echo $position + 1 ?>";

    //add headline and text component
    $('.add_headline_text').on('click', function () {

        var html = $(".headline_text_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var btn = 'show_button[' + position + ']';
        $(html).find('.show_button').attr('name', btn);

        var headline_en = 'headline_text_title_en[' + position + ']';
        $(html).find('.headline_text_title_en').attr('name', headline_en);

        var headline_bn = 'headline_text_title_bn[' + position + ']';
        $(html).find('.headline_text_title_bn').attr('name', headline_bn);

        var text_en = 'headline_text_textarea_en[' + position + ']';
        $(html).find('.headline_text_textarea_en').attr('name', text_en);

        var text_bn = 'headline_text_textarea_bn[' + position + ']';
        $(html).find('.headline_text_textarea_bn').attr('name', text_bn);

        $('.element_wrap').append(html);

        position++;

    });


    //add list component
    $('.add_list_component').on('click', function () {

        var html = $(".list_component_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);



        var headline_en = 'list_headline_en[' + position + ']';
        $(html).find('.list_headline_en').attr('name', headline_en);

        var headline_bn = 'list_headline_bn[' + position + ']';
        $(html).find('.list_headline_bn').attr('name', headline_bn);

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

    //add list component
    $('.add_free_text').on('click', function () {

        var html = $(".free_text_wrap .form-group").clone();

        var comPosition = 'component_position[' + position + ']';
        $(html).find('.component_position').attr('name', comPosition);

        var text_en = 'free_textarea_en[' + position + ']';
        $(html).find('.free_textarea_en').attr('name', text_en);

        var text_bn = 'free_textarea_bn[' + position + ']';
        $(html).find('.free_textarea_bn').attr('name', text_bn);



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


    //remove component
    $('.element_wrap').on('click', '.remove_component', function () {

        $(this).parents('.form-group').fadeOut(300, function () {
            $(this).remove();
        });



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




