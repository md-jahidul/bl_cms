@extends('layouts.admin')

@section('title', "Blog's Content")
@section('card_name', "Blog's Content")
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('blog-post') }}"> Blog List</a></li>
    <li class="breadcrumb-item active">Blog's Details</li>
@endsection

@section('action')
    <a href="{{ route('blog-component.create', ['section_id' => request()->blog_id])}}" class="btn btn-primary btn-glow px-2"><i class="la la-list"></i> Add Component </a>
@endsection
@section('content')

    @php
    
        $action = [
            'edit' => 'blog-component/edit',
            'destroy' => 'blog-component/destroy',
            'componentSort' => 'blog-component-sort',
            'section_id' => request()->blog_id
        ];

    @endphp
    @include('admin.components.index', $action)
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Ad Tech</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('blog.adtech.store') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}

                            {{-- {{ Form::hidden('reference_type', isset($adTech) ? $adTech->reference_id : '', ['class' => 'reference_type'] ) }} --}}
                            {{ Form::hidden('reference_id', isset($adTech) ? $adTech->reference_id : request()->blog_id, ['class' => 'reference_id'] ) }}

                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('img_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Ad Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="img_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($adTech->img_url) ? config('filesystems.file_base_url') . $adTech->img_url : '' }}">
                                    </div>
                                    {{--                                    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}
                                    <div class="help-block"></div>
                                    @if ($errors->has('img_url'))
                                        <div class="help-block">  {{ $errors->first('img_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('img_name_en') ? ' error' : '' }}" >
                                    <label for="img_name_en">Image Name (English)</label>
                                    <input type="text" name="img_name_en" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->img_name_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('img_name_bn') ? ' error' : '' }}" >
                                    <label for="img_name_bn">Image Name (Bangla)</label>
                                    <input type="text" name="img_name_bn" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->img_name_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('img_name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text_en">Alt Text (English)</label>
                                    <input type="text" name="alt_text_en" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->alt_text_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn">Alt Text (Bangla)</label>
                                    <input type="text" name="alt_text_bn" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->alt_text_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }} {{ (isset($adTech) && $adTech->is_external_url == 0) ? '' : (!isset($adTech) ? '' : 'd-none') }}" id="pageDynamic">
                                    <label for="url">Redirect URL</label>
                                    <input type="text" name="redirect_url_en" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->redirect_url_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>
                                

                                <div class="form-group col-md-6 {{ $errors->has('url') ? ' error' : '' }} {{ (isset($adTech) && $adTech->is_external_url == 1) ? '' : 'd-none' }}" id="externalLink">
                                    <label for="url">External URL</label>
                                    <input type="text" name="external_url" class="form-control" placeholder="Enter URL"
                                           value="{{ isset($adTech) ? $adTech->external_url : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('url'))
                                        <div class="help-block">  {{ $errors->first('url') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="external_link">Is External Link:</label>
                                        <input type="checkbox" name="is_external_url" value="1" id="external_link" {{ old("is_external_url") ? 'checked' : '' }}
                                            {{ (isset($adTech) && $adTech->is_external_url == 1) ? 'checked' : '' }}>
                                    </div>
                                </div>
                                


                                <div class="col-md-4 mt-3">
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <label for="title" class="required mr-1">Status:</label>
                                        <input type="radio" id="active" name="status" value="1" {{ isset($adTech->status) && $adTech->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" id="inactive" name="status" value="0" {{ isset($adTech->status) && $adTech->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                        <div class="help-block"></div>
                                            @if ($errors->has('status'))
                                            <div class="help-block">{{ $errors->first('status') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
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

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
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
            
            /*

            ## Temporay comment
            $(".file_sortable").sortable({
                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('update')
                        }
                    });
                    var save_url = "{{ url('about-page/sort-benefit-file') }}";
                    event.preventDefault();
                    saveNewPositions(save_url);
                }
            });

            function saveNewPositions(save_url) {
                var positions = [];
                $('.update').each(function () {
                    positions.push([
                        $(this).attr('data-index'),
                        $(this).attr('data-position')
                    ]);
                })
                $.ajax({
                    type: "GET",
                    url: "{{ url('') }}",
                    data: {
                        update: 1,
                        position: positions
                    },
                    success: function (data) {
                        alert(data)
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
                var url = "benefit-status-change/" + fileId;
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
                var url = "benefit-edit/" + fileId;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (data) {
                        $('.file_id').val(data['id']);
                        $('.file_name_en').val(data['title_en']);
                        $('.file_name_bn').val(data['title_en']);
                        var image = '<img src="{{ config("filesystems.file_base_url") }}'+data['image_url']+'" height="100" width="200">'
                        $('#image_url').children('img').remove();
                        $('#image_url').append(image);
                        $('.old_path').val(data['image_url']);

                        var status = parseInt(data['status']);

                        if (status === 1) {
                            $('.status_active').prop('checked', true);
                        } else {
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

            $('.file_delete').on('click', function () {
                var confrm = confirm("Are you sure? Do you want to delete this Item?");
                if (confrm) {
                    return true;
                }
                return false;
            });
            */

            //External Link
            $('#external_link').click(function () {
                if($(this).prop("checked") == true){
                    externalLink.removeClass('d-none');
                    pageDynamic.addClass('d-none');
                }else{
                    pageDynamic.removeClass('d-none')
                    externalLink.addClass('d-none')
                }
            });
            //show dropify for  photo
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for File/Photo',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        });
    </script>
@endpush

