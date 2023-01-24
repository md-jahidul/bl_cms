@extends('layouts.admin')
@section('title', 'Ethics & compliance')
@section('card_name', 'Page Info & File list')

@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>Update Page Information</strong></h4>
                <hr>
                <div class="row">
                    <div class="col-md-12 col-xs-12 update_form">

                        <form method="POST" action="{{ url('ethics/update-page-info') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $pageInfo->id }}" name="page_id">

                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Page Name (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required name="page_name_en" value="{{ $pageInfo->page_name_en }}" placeholder="Page Name EN">
                                    </div>
                                    <div class="form-group">
                                        <label>Banner (Web)</label>
                                        <input type="file" class="dropify" name="banner_web" data-height="70"
                                               data-default-file="{{ isset($pageInfo->banner_web) ? config('filesystems.file_base_url') . $pageInfo->banner_web : '' }}"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>

                                    <div class="form-group {{ $errors->has('banner_name') ? ' error' : '' }}">
                                        <label for="banner_name">Banner Name EN</label>
                                        <input type="text" name="banner_name" id="banner_name" class="form-control"
                                               placeholder="Enter banner name en" value="{{ isset($pageInfo->banner_name) ? $pageInfo->banner_name : '' }}">
                                        @if ($errors->has('banner_name'))
                                            <div class="help-block text-danger">{{ $errors->first('banner_name') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text English</label>
                                        <input type="text" class="form-control" name="alt_text" value="{{ $pageInfo->alt_text }}" placeholder="Alt Text">
                                    </div>

                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Page Name (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required name="page_name_bn" value="{{ $pageInfo->page_name_bn }}"  placeholder="Page Name BN">
                                    </div>

                                    <div class="form-group">
                                        <label>Banner (Mobile)</label>
                                        <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                               data-default-file="{{ isset($pageInfo->banner_mobile) ? config('filesystems.file_base_url') . $pageInfo->banner_mobile : '' }}"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>

                                    <div class="form-group {{ $errors->has('banner_name_bn') ? ' error' : '' }}">
                                        <label for="banner_name_bn">Banner Name BN</label>
                                        <input type="text" name="banner_name_bn" id="banner_name_bn" class="form-control"
                                               placeholder="Enter banner name bn" value="{{ isset($pageInfo->banner_name_bn) ? $pageInfo->banner_name_bn : '' }}">
                                        @if ($errors->has('banner_name_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('banner_name_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text Bangla</label>
                                        <input type="text" class="form-control" name="alt_text" value="{{ $pageInfo->alt_text }}" placeholder="Alt Text">
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Page Header English (HTML)</label>
                                        <textarea class="form-control" rows="7" name="page_header">{{ $pageInfo->page_header }}</textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Page Header Bangla (HTML)</label>
                                        <textarea class="form-control" rows="7" name="page_header_bn">{{ $pageInfo->page_header_bn }}</textarea>
                                        <small class="text-info">
                                            <strong>Note : </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label>Schema Markup</label>
                                        <textarea class="form-control" rows="7" name="schema_markup">{{ $pageInfo->schema_markup }}</textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" class="old_web" value="{{ $pageInfo->banner_web }}" name="old_web">
                            <input type="hidden" class="old_mobile" value="{{ $pageInfo->banner_mobile }}" name="old_mobile">

                            <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
                        </form>

                    </div>



                </div>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>File List</strong></h4>
                <div class="row">

                    <div class="col-md-6 col-xs-12">

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="50%">File</th>
                                    <th width="22%">Download</th>
                                    <th width="">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="file_sortable">
                                @foreach($files as $f)
                                <tr data-index="{{ $f->id }}" data-position="{{ $f->sort }}">
                                    <td>
                                        <i class="icon-cursor-move icons"></i>
                                        {{$f->file_name_en}}
                                    </td>
                                    <td>
                                        <a href="{{ config('filesystems.file_base_url'). $f->file_path}}" target="_blank" class="btn btn-sm btn-warning">
                                            Download
                                        </a>
                                    </td>
                                    <td class="status_btn_wrap">
                                        @if($f->status == 1)
                                            <a href="{{$f->id}}" class="btn btn-sm btn-info change_status">
                                                Active
                                            </a>
                                        @else
                                            <a href="{{$f->id}}" class="btn btn-sm btn-warning change_status">
                                                Inactive
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{$f->id}}" class="file_edit">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="{{ url('ethics/file-delete/'. $f->id)}}" class="file_delete text-danger">
                                            <i class="la la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <h4 class="pb-1"><strong>Add/Edit File</strong></h4>
                        <form method="POST" action="{{ url('ethics/save-ethics-file') }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="file_id" class="file_id">
                            <div class="form-group {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (English)</label>
                                <input type="text" name="title_en"  class="form-control title_en" placeholder="Enter english title"
                                       value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter english title">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                    <div class="help-block">{{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group  {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_en" class="required">Title (Bangla)</label>
                                <input type="text" name="title_bn"  class="form-control title_bn" placeholder="Enter bangla title"
                                       value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter bangla title">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                    <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group  {{ $errors->has('description_en') ? ' error' : '' }}">
                                <label for="description_en">Description</label>
                                <textarea type="text" name="description_en" rows="5" id=""
                                          class="form-control description_en" placeholder="Enter description">{{ (!empty($component->description_en)) ? $component->description_en : old("description_en") ?? '' }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('description_en'))
                                <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group  {{ $errors->has('description_bn') ? ' error' : '' }}">
                                <label for="description_bn">Description (bangla)</label>
                                <textarea type="text" name="description_bn" rows="5" id=""
                                          class="form-control description_bn" placeholder="Enter description (bangla)">{{ (!empty($component->description_bn)) ? $component->description_bn : old("description_bn") ?? '' }}</textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('description_bn'))
                                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('file_name_en') ? ' error' : '' }}">
                                <label>File Name (EN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control file_name_en" required name="file_name_en"   placeholder="File Name EN">
                                @if ($errors->has('file_name_en'))
                                    <div class="help-block text-danger">{{ $errors->first('file_name_en') }}</div>
                                 @endif
                            </div>
                            <div class="form-group {{ $errors->has('file_name_bn') ? ' error' : '' }}">
                                <label>File Name (BN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control file_name_bn" required name="file_name_bn"   placeholder="File Name BN">
                                @if ($errors->has('file_name_bn'))
                                    <div class="help-block text-danger">{{ $errors->first('file_name_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="dropify" name="file_path" data-height="70"
                                       data-allowed-file-extensions='["doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf"]'>
                                <input type="hidden" name="old_path" class="old_path">
                            </div>
                            <div class="form-group">
                                <label>Image Url</label>
                                <input type="file" class="dropify" name="image_url" data-height="70"
                                       data-allowed-file-extensions='["jpg", "png", "svg"]'>
                                <input type="hidden" name="old_path_image_url" class="old_path_image_url">
                            </div>
                            <div class="form-group">
                                <label>Mobile View Img</label>
                                <input type="file" id="mobile_view_img"class="dropify" name="mobile_view_img" data-height="70"
                                       data-allowed-file-extensions='["jpg", "png", "svg"]'>
                                <input type="hidden" name="old_path_mobile_view_img" class="old_path_mobile_view_img">
                            </div>

                            <div class="form-group  {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                <label>Image Name EN</label>
                                <input type="text" name="image_name_en"  class="form-control image_name_en" placeholder="Image Name EN"
                                       value="{{ old("image_name_en") ? old("image_name_en") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name_en'))
                                    <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                <label>Image Name BN</label>
                                <input type="text" name="image_name_bn"  class="form-control image_name_bn" placeholder="Image Name BN"
                                       value="{{ old("image_name_bn") ? old("image_name_bn") : '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name_bn'))
                                    <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Alt Text English</label>
                                <input type="text" class="form-control file_alt_text" name="alt_text" id="file_alt_text" placeholder="Alt Text EN">
                            </div>
                            <div class="form-group">
                                <label>Alt Text Bangla</label>
                                <input type="text" class="form-control file_alt_text_bn" name="alt_text_bn" id="file_alt_text_bn" placeholder="Alt Text BN">
                            </div>

                            <div class="form-group">
                                <label class="mr-1">
                                    <input type="radio" name="status" value="1" class="status_active"> Active
                                </label>
                                <label>
                                    <input type="radio" name="status" value="0" class="status_inactive">
                                    Inactive
                                </label>
                            </div>
                            <button type="submit" class="btn btn-sm btn-info pull-right">Save</button>
                        </form>
                    </div>

                </div>

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
@push('page-js')old_path_image_url
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>


<script>
$(function () {
let serverUrl = "{{config('filesystems.file_base_url')}}"
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


    $(".file_sortable").sortable({

        update: function (event, ui) {
            $(this).children().each(function (index) {
                if ($(this).attr('data-position') != (index + 1)) {
                    $(this).attr('data-position', (index + 1)).addClass('update')
                }
            });
            var save_url = "{{ url('ethics/sort-ethics-file') }}";
            saveNewPositions(save_url);
        }
    });

    function saveNewPositions(save_url)
    {
        var positions = [];
        $('.update').each(function () {
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


    $(".status_btn_wrap").on('click', '.change_status', function (e) {
        e.preventDefault();

        var thisObj = $(this);

        var fileId = $(this).attr('href');
        var url = "ethics/status-change/" + fileId;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                if (data['success'] == 1) {

                    var statusHtml = "";
                    if (data['status'] == 1) {
                        statusHtml = '<a href="' + fileId + '" class="btn btn-sm btn-info change_status">Active</a>';
                    } else {
                        statusHtml = '<a href="' + fileId + '" class="btn btn-sm btn-warning change_status">Inactive</a>';
                    }
                    $(thisObj).parents('tr').find('.status_btn_wrap').html(statusHtml);

                    swal.fire({
                        title: "File status is changed",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function () {
                swal.fire({
                    title: 'Failed to change status',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    //edit file
    $(".file_edit").on('click', function (e) {
        e.preventDefault();


        var fileId = $(this).attr('href');
        var url = "ethics/get-file-data/" + fileId;
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
               $('.file_id').val(data['id']);
               $('.file_name_en').val(data['file_name_en']);
               $('.file_name_bn').val(data['file_name_bn']);
               $('.title_en').val(data['title_en']);
               $('.title_bn').val(data['title_bn']);
               $('.description_bn').val(data['description_bn']);
               $('.description_en').val(data['description_en']);
               $('.image_name_en').val(data['image_name_en']);
               $('.image_name_bn').val(data['image_name_bn']);
               $('.file_alt_text').val(data['alt_text']);
               $('.file_alt_text_bn').val(data['alt_text_bn']);
               $('.old_path').val(data['file_path']);
               $('.old_path_image_url').val(data['image_url']);
               $('.old_path_mobile_view_img').val(data['mobile_view_img']);
                // $('#mobile_view_img').attr('data-default-file',serverUrl+data['mobile_view_img']);
                // $('.dropify').dropify();
               var status = parseInt(data['status']);

               if(status === 1){
                    $('.status_active').prop('checked', true);
               }else{
                   $('.status_inactive').prop('checked', true);
               }
            },
            error: function () {
                swal.fire({
                    title: 'Failed to change status',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    $('.file_delete').on('click', function(){
        var confrm = confirm("Are you sure? Do you wnat to delete this file?");
        if(confrm){
            return true;
        }
        return false;
    });

//show dropify for  photo
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for File/Photo',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        },
    });


});


</script>
@endpush




