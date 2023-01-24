@extends('layouts.admin')

@section('title', "C's Content")
@section('card_name', "C's Content")
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('explore-c') }}"> Explore C List</a></li>
    <li class="breadcrumb-item active">C's Content Details</li>
@endsection
@section('action')
    <a href="{{ route('explore-c-component.create', ['section_id' => request()->explore_c_id])}}" class="btn btn-primary btn-glow px-2"><i class="la la-list"></i> Add Component </a>
@endsection
@section('content')

    @php
    
        $action = [
            'edit' => 'explore-c-component/edit',
            'destroy' => 'explore-c-component/destroy',
            'componentSort' => 'explore-c-component-sort',
            'section_id' => request()->explore_c_id
        ];

    @endphp
    @include('admin.components.index', $action)

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Fixed Section</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ isset($banner) ? route('al-banner.update', $banner->id) : route('al-banner.store') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            @if (isset($banner))
                                
                                {{method_field('PUT')}}
                            @else
                                
                                {{method_field('POST')}}
                            @endif
                            {{ Form::hidden('section_id', $action['section_id'] ) }}
                            {{ Form::hidden('section_type', 'explore_c' ) }}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en">Title (English)</label>
                                    <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter explore name in English"
                                        value="{{ old("title_en") ? old("title_en") : (isset($banner) ? $banner->title_en : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                    <div class="help-block">{{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn">Title (Bangla)</label>
                                    <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter explore name in Bangla"
                                        value="{{ old("title_bn") ? old("title_bn") : (isset($banner) ? $banner->title_bn : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                    <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 ">
                                    <label for="desc_en">Description (English)</label>
                                    <textarea type="text" name="desc_en" id="" class="form-control summernote_editor" placeholder="Enter description in English"
                                            >{{ (isset($banner) ? $banner->desc_en : null) }}</textarea>
                                    <div class="help-block"></div>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="desc_bn">Description (Bangla)</label>
                                    <textarea type="text" name="desc_bn" id="" class="form-control summernote_editor" placeholder="Enter description in Bangla"
                                            >{{ $banner->desc_bn ?? null }}</textarea>
                                    <div class="help-block"></div>
                                </div>
                                
                                <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                    <label for="alt_text">Alt Text (English)</label>
                                    <input type="text" name="alt_text_en" id="alt_text_en" class="form-control"
                                           placeholder="Enter alt text" value="{{ old("alt_text_en") ? old("alt_text_en") : (isset($banner) ? $banner->alt_text_en : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_en'))
                                        <div class="help-block">{{ $errors->first('alt_text_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                    <label for="alt_text_bn">Alt Text (Bangla)</label>
                                    <input type="text" name="alt_text_bn" id="alt_text_bn" class="form-control"
                                           placeholder="Enter alt text" value="{{ old("alt_text_bn") ? old("alt_text_bn") : (isset($banner) ? $banner->alt_text_bn : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text_bn'))
                                        <div class="help-block">{{ $errors->first('alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                    <label for="image_name_en">Image Name(English)</label>
                                    <input type="text" name="image_name_en" id="image_name_en" class="form-control" placeholder="Enter Image name in English"
                                        value="{{ old("image_name_en") ? old("image_name_en") : (isset($banner) ? $banner->image_name_en : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_en'))
                                    <div class="help-block">{{ $errors->first('image_name_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label for="image_name_bn">Image Name (Bangla)</label>
                                    <input type="text" name="image_name_bn" id="image_name_bn" class="form-control" placeholder="Enter Image name in Bangla"
                                        value="{{ old("image_name_bn") ? old("image_name_bn") : (isset($banner) ? $banner->image_name_bn : '') }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                    <div class="help-block">{{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('button_label_en') ? ' error' : '' }}">
                                    <label for="button_label_en">Button Label (English)</label>
                                    <input type="text" name="other_attributes[button_label_en]" id="button_label_en" class="form-control" placeholder="Enter Image name in Bangla"
                                        value="{{ (!empty($banner->other_attributes['button_label_en'])) ? $banner->other_attributes['button_label_en'] : old("other_attributes.button_label_en") ?? '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('button_label_en'))
                                    <div class="help-block">{{ $errors->first('button_label_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('button_label_bn') ? ' error' : '' }}">
                                    <label for="button_label_bn">Button Label (Bangla)</label>
                                    <input type="text" name="other_attributes[button_label_bn]" id="button_label_bn" class="form-control" placeholder="Enter Image name in Bangla"
                                        value="{{ (!empty($banner->other_attributes['button_label_bn'])) ? $banner->other_attributes['button_label_bn'] : old("other_attributes.button_label_bn") ?? '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('button_label_bn'))
                                    <div class="help-block">{{ $errors->first('button_label_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('button_url') ? ' error' : '' }}">
                                    <label for="button_url">Button Url</label>
                                    <input type="text" name="other_attributes[button_url]" id="button_url" class="form-control" placeholder="Enter Image name in Bangla"
                                        value="{{ (!empty($banner->other_attributes['button_url'])) ? $banner->other_attributes['button_url'] : old("other_attributes.button_url") ?? '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('button_url'))
                                    <div class="help-block">{{ $errors->first('button_url') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="image" value="{{ isset($banner) ? $banner->image : '' }}">
                                        <input type="file" name="image" class="dropify" data-height="90"
                                               data-default-file="{{ isset($banner) ? config('filesystems.file_base_url') . $banner->image : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image'))
                                        <div class="help-block">  {{ $errors->first('image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
                                    <label for="title">Google Play Store Link</label>
                                    <input type="text" name="other_attributes[google_play_link]"  class="form-control" placeholder="Enter play store link"
                                        value="{{ (!empty($banner->other_attributes['google_play_link'])) ? $banner->other_attributes['google_play_link'] : old("other_attributes.google_play_link") ?? '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('google_play_link'))
                                        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
                                    <label for="title">App Store Link</label>
                                    <input type="text" name="other_attributes[app_store_link]"  class="form-control" placeholder="Enter app store link"
                                        value="{{ (!empty($banner->other_attributes['app_store_link'])) ? $banner->other_attributes['app_store_link'] : old("other_attributes.app_store_link") ?? '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('app_store_link'))
                                        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
                                    @endif
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






