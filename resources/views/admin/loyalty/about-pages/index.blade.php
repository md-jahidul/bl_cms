@extends('layouts.admin')

@section('title', "About Priyojon")
@section('card_name', "About Priyojon")
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="--}}{{--{{ route('product.list', ) }}--}}{{--"> List</a></li>--}}
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active">About Priyojon Details</li>
@endsection
@section('action')
    {{--<a href="{{ url("offers/") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>About Priyojon Details</strong></h5>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form" id="product_form" action="{{ route('about-page.update') }}" method="POST"
                              novalidate enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="slug" value="{{ $slug }}">
                                <div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
                                    <label for="details_en" class="required">Details (English)</label>
                                    <textarea type="text" name="details_en" class="form-control summernote_editor"
                                              placeholder="Enter offer details in english"
                                              required
                                              data-validation-required-message="Enter offer details in english">{{ $details->details_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_en'))
                                        <div class="help-block">{{ $errors->first('details_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
                                    <label for="details_bn" class="required">Details (Bangla)</label>
                                    <textarea type="text" name="details_bn" class="form-control summernote_editor"
                                              placeholder="Enter offer details in english"
                                              required
                                              data-validation-required-message="Enter offer details in english">{{ $details->details_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('details_bn'))
                                        <div class="help-block">{{ $errors->first('details_bn') }}</div>
                                    @endif
                                </div>

                                @if($slug == 'reward_points')
                                    <div class="form-group col-md-6 {{ $errors->has('left_card_title_en') ? ' error' : '' }}">
                                        <label for="left_card_title_en" class="required">Left Card Title (English)</label>
                                        <input type="text" name="other_attributes[left_card_title_en]"
                                               class="form-control" placeholder="Enter title in English"
                                               value="{{ $details->other_attributes['left_card_title_en'] }}" required
                                               data-validation-required-message="Enter title in English">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_card_title_en'))
                                            <div class="help-block">  {{ $errors->first('left_card_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('right_card_title_en') ? ' error' : '' }}">
                                        <label for="right_card_title_en" class="required">Right Card Title (English)</label>
                                        <input type="text" name="other_attributes[right_card_title_en]"
                                               class="form-control" placeholder="Enter title in Eangla"
                                               value="{{ $details->other_attributes['right_card_title_en'] }}" required
                                               data-validation-required-message="Enter title in English">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_card_title_en'))
                                            <div class="help-block">  {{ $errors->first('right_card_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('left_card_title_bn') ? ' error' : '' }}">
                                        <label for="left_card_title_bn" class="required">Left Card Title (Bangla)</label>
                                        <input type="text" name="other_attributes[left_card_title_bn]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ $details->other_attributes['left_card_title_bn'] }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_card_title_bn'))
                                            <div class="help-block">  {{ $errors->first('left_card_title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div
                                        class="form-group col-md-6 {{ $errors->has('right_card_title_bn') ? ' error' : '' }}">
                                        <label for="right_card_title_bn" class="required">Right Card Title (Bangla)</label>
                                        <input type="text" name="other_attributes[right_card_title_bn]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ $details->other_attributes['right_card_title_bn'] }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_card_title_bn'))
                                            <div class="help-block">  {{ $errors->first('right_card_title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('left_button_title_en') ? ' error' : '' }}">
                                        <label for="left_button_title_en" class="required">Left Button (English)</label>
                                        <input type="text" name="other_attributes[left_button_title_en]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['left_button_title_en']) ? $details->other_attributes['left_button_title_en'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_button_title_en'))
                                            <div class="help-block">  {{ $errors->first('left_button_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('right_button_title_en') ? ' error' : '' }}">
                                        <label for="right_button_title_en" class="required">Right Button (English)</label>
                                        <input type="text" name="other_attributes[right_button_title_en]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['right_button_title_en']) ? $details->other_attributes['right_button_title_en'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_button_title_en'))
                                            <div class="help-block">  {{ $errors->first('right_button_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('left_button_title_bn') ? ' error' : '' }}">
                                        <label for="left_button_title_bn" class="required">Left Button (Bangla)</label>
                                        <input type="text" name="other_attributes[left_button_title_bn]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['left_button_title_bn']) ? $details->other_attributes['left_button_title_bn'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_button_title_bn'))
                                            <div class="help-block">  {{ $errors->first('left_button_title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('right_button_title_en') ? ' error' : '' }}">
                                        <label for="right_button_title_en" class="required">Right Button (Bangla)</label>
                                        <input type="text" name="other_attributes[right_button_title_en]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['right_button_title_en']) ? $details->other_attributes['right_button_title_en'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_button_title_en'))
                                            <div class="help-block">  {{ $errors->first('right_button_title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('left_button_url') ? ' error' : '' }}">
                                        <label for="left_button_url" class="required">Left Button URL</label>
                                        <input type="text" name="other_attributes[left_button_url]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['left_button_url']) ? $details->other_attributes['left_button_url'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('left_button_url'))
                                            <div class="help-block">  {{ $errors->first('left_button_url') }}</div>
                                        @endif
                                    </div>

                                    <div
                                        class="form-group col-md-6 {{ $errors->has('right_button_url') ? ' error' : '' }}">
                                        <label for="right_button_url" class="required">Right Button URL</label>
                                        <input type="text" name="other_attributes[right_button_url]"
                                               class="form-control" placeholder="Enter title in Bangla"
                                               value="{{ isset($details->other_attributes['right_button_url']) ? $details->other_attributes['right_button_url'] : '' }}" required
                                               data-validation-required-message="Enter title in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('right_button_url'))
                                            <div class="help-block">  {{ $errors->first('right_button_url') }}</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group col-md-6 {{ $errors->has('left_side_img') ? ' error' : '' }}">
                                    <label for="mobileImg">Left Side Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="left_side_img" data-height="90" class="dropify"
                                               data-default-file="{{ isset($details->left_side_img) ? config('filesystems.file_base_url') . $details->left_side_img : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('left_side_img'))
                                        <div class="help-block">  {{ $errors->first('left_side_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('right_side_ing') ? ' error' : '' }}">
                                    <label for="mobileImg">Right Side Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="right_side_ing" class="dropify" data-height="90"
                                               data-default-file="{{ isset($details->right_side_ing) ? config('filesystems.file_base_url') . $details->right_side_ing : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('right_side_ing'))
                                        <div class="help-block">  {{ $errors->first('right_side_ing') }}</div>
                                    @endif
                                </div>

                                <!-- Left Image Name EN -->
                                <div class="form-group col-md-6 {{ $errors->has('left_img_name_en') ? ' error' : '' }}">
                                    <label>Image Name EN</label>
                                    <input type="text" name="left_img_name_en" class="form-control" placeholder="Enter Image Name EN"
                                           value="{{ old('left_img_name_en') ? old('left_img_name_en') : $details->left_img_name_en }}">
                                    @if ($errors->has('left_img_name_en'))
                                        <div class="help-block text-danger">{{ $errors->first('left_img_name_en') }}</div>
                                    @endif
                                </div>

                                <!-- Right Image Name EN -->
                                <div class="form-group col-md-6 {{ $errors->has('right_img_name_en') ? ' error' : '' }}">
                                    <label>Image Name EN</label>
                                    <input type="text" name="right_img_name_en" class="form-control" placeholder="Enter Image Name EN"
                                           value="{{ old('right_img_name_en') ? old('right_img_name_en') : $details->right_img_name_en }}">
                                    @if ($errors->has('right_img_name_en'))
                                        <div class="help-block text-danger">{{ $errors->first('right_img_name_en') }}</div>
                                    @endif
                                </div>

                                <!-- Left Image Name BN -->
                                <div class="form-group col-md-6 {{ $errors->has('left_img_name_bn') ? ' error' : '' }}">
                                    <label>Image Name BN</label>
                                    <input type="text" name="left_img_name_bn" class="form-control" placeholder="Enter Image Name BN"
                                           value="{{ old('left_img_name_bn') ? old('left_img_name_bn') : $details->left_img_name_bn }}">
                                    @if ($errors->has('left_img_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('left_img_name_bn') }}</div>
                                    @endif
                                </div>

                                <!-- Right Image Name BN -->
                                <div class="form-group col-md-6 {{ $errors->has('right_img_name_bn') ? ' error' : '' }}">
                                    <label>Image Name BN</label>
                                    <input type="text" name="right_img_name_bn" class="form-control" placeholder="Enter Image Name BN"
                                           value="{{ old('right_img_name_bn') ? old('right_img_name_bn') : $details->right_img_name_bn }}">
                                    @if ($errors->has('right_img_name_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('right_img_name_bn') }}</div>
                                    @endif
                                </div>

                                <!-- Left Image Alt Text EN -->
                                <div class="form-group col-md-6 {{ $errors->has('left_img_alt_text_en') ? ' error' : '' }}">
                                    <label>Alt Text EN</label>
                                    <input type="text" name="left_img_alt_text_en" class="form-control" placeholder="Enter Alt Text EN"
                                           value="{{ old('left_img_alt_text_en') ? old('left_img_alt_text_en') : $details->left_img_alt_text_en }}">
                                    @if ($errors->has('left_img_alt_text_en'))
                                        <div class="help-block text-danger">{{ $errors->first('left_img_alt_text_en') }}</div>
                                    @endif
                                </div>

                                <!-- Right Image Alt Text EN -->
                                <div class="form-group col-md-6 {{ $errors->has('right_img_alt_text_en') ? ' error' : '' }}">
                                    <label>Alt Text EN</label>
                                    <input type="text" name="right_img_alt_text_en" class="form-control" placeholder="Enter Alt Text EN"
                                           value="{{ old('right_img_alt_text_en') ? old('right_img_alt_text_en') : $details->right_img_alt_text_en }}">
                                    @if ($errors->has('right_img_alt_text_en'))
                                        <div class="help-block text-danger">{{ $errors->first('right_img_alt_text_en') }}</div>
                                    @endif
                                </div>

                                <!-- Left Image Alt Text BN -->
                                <div class="form-group col-md-6 {{ $errors->has('left_img_alt_text_bn') ? ' error' : '' }}">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="left_img_alt_text_bn" class="form-control" placeholder="Enter Alt Text BN"
                                           value="{{ old('left_img_alt_text_bn') ? old('left_img_alt_text_bn') : $details->left_img_alt_text_bn }}">
                                    @if ($errors->has('left_img_alt_text_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('left_img_alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <!-- Right Image Alt Text BN -->
                                <div class="form-group col-md-6 {{ $errors->has('right_img_alt_text_bn') ? ' error' : '' }}">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="right_img_alt_text_bn" class="form-control" placeholder="Enter Alt Text BN"
                                           value="{{ old('right_img_alt_text_bn') ? old('right_img_alt_text_bn') : $details->right_img_alt_text_bn }}">
                                    @if ($errors->has('right_img_alt_text_bn'))
                                        <div class="help-block text-danger">{{ $errors->first('right_img_alt_text_bn') }}</div>
                                    @endif
                                </div>

                                <!-- Page ID -->
                                <input type="hidden" value="{{ $details->id }}" name="about_page_id">
                                <div class="form-group col-md-6">
                                    @if($details->left_side_img)
                                        <input type="checkbox" name="remove_img_left" id="remove_img_left" value="1">
                                        <label for="remove_img_left">Remove Left Side Image</label>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('right_side_ing') ? ' error' : '' }}">
                                    @if($details->right_side_ing)
                                        <input type="checkbox" name="remove_img_right" id="remove_img_right" value="1">
                                        <label for="remove_img_right">Remove Right Side Image</label>
                                    @endif
                                </div>



                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" id="save" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Benefits List</strong></h4>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="40%">Title</th>
                                    <th width="22%">Image</th>
                                    <th width="">Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody> <!--class="file_sortable"-->
                                @foreach($benefits as $data)
                                    <tr data-index="{{ $data->id }}" data-position="{{ $data->sort }}">
                                        <td>
                                            <i class="icon-cursor-move icons"></i>
                                            {{$data->title_en}}
                                        </td>
                                        <td>
                                            <img src="{{ config('filesystems.file_base_url') . $data->image_url  }}"
                                                 height="40" width="60">
                                        </td>
                                        <td class="status_btn_wrap">
                                            @if($data->status == 1)
                                                <a href="{{$data->id}}" class="btn btn-sm btn-info change_status">
                                                    Active
                                                </a>
                                            @else
                                                <a href="{{$data->id}}" class="btn btn-sm btn-warning change_status">
                                                    Inactive
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{$data->id}}" class="file_edit"><i class="la la-edit"></i></a>
                                            <a href="{{ url("about-page/benefit-delete/$slug/$data->id")}}"
                                               class="file_delete text-danger"><i class="la la-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <h4 class="pb-1"><strong>Add/Edit File</strong></h4>
                            <form method="POST" action="{{ url("lms/benefit-save/$slug") }}" class="form"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="file_id" class="file_id">
                                <input type="hidden" name="page_type" value="{{ $slug }}">
                                <div class="form-group">
                                    <label>Title (EN) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control file_name_en" required name="title_en"
                                           placeholder="File Name EN">
                                </div>
                                <div class="form-group">
                                    <label>Title (BN) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control file_name_bn" required name="title_bn"
                                           placeholder="File Name BN">
                                </div>
                                <div class="form-group">
                                    <label>Benefits Icon</label>
                                    <input type="file" class="dropify" name="image_url" data-height="70"
                                           data-default-file="{{ isset($image['image_url']) ? config('filesystems.file_base_url') . $image['image_url'] : '' }}">
                                    <input type="hidden" name="old_path" class="old_path">
                                </div>
                                <div class="form-group" id="image_url">
{{--                                    <label>Benefits Icon</label>--}}

                                </div>
                                <div class="form-group">
                                    <label class="mr-1">
                                        <input type="radio" name="status" value="1" class="status_active"> Active
                                    </label>
                                    <label>
                                        <input type="radio" name="status" value="0" class="status_inactive">Inactive
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
                    url: "{{ url('about-page/sort-benefit-file') }}",
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






