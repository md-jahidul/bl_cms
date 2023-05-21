@extends('layouts.admin')

@section('title', "About Priyojon")
@section('card_name', "About Priyojon")
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="--}}{{--{{ route('product.list', ) }}--}}{{--"> List</a></li>--}}
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    <li class="breadcrumb-item active">Component List</li>
@endsection
@section('action')
    <a href="{{ route('about-page.component.create')}}" class="btn btn-primary btn-glow px-2"><i class="la la-list"></i> Add Component </a>
@endsection
@section('content')
    @php
        $action = [
            'edit' => 'about-page/component/edit',
            'destroy' => 'about-page/component/destroy',
            'componentSort' => 'about-page-component-sort'
        ];
    @endphp
    @include('admin.components.index', $action)

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Loyalty Banner Image</strong></h4>
                    <hr>
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ url('about-page/banner-image/upload') }}"
                              method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Desktop)</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="loyalty_web_banner_old" value="{{ isset($aboutLoyaltyBanner->banner_image_url) ? $aboutLoyaltyBanner->banner_image_url : '' }}">
                                        <input type="file" name="banner_image_url" data-height="90" class="dropify"
                                               data-default-file="{{ isset($aboutLoyaltyBanner->banner_image_url) ? config('filesystems.file_base_url') . $aboutLoyaltyBanner->banner_image_url : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image_url'))
                                        <div class="help-block">  {{ $errors->first('banner_image_url') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('banner_mobile_view') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image (Mobile)</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="loyalty_mobile_banner_old" value="{{ isset($aboutLoyaltyBanner->banner_mobile_view) ? $aboutLoyaltyBanner->banner_mobile_view : '' }}">
                                        <input type="file" name="banner_mobile_view" class="dropify" data-height="90"
                                               data-default-file="{{ isset($aboutLoyaltyBanner->banner_mobile_view) ? config('filesystems.file_base_url') . $aboutLoyaltyBanner->banner_mobile_view : '' }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_mobile_view'))
                                        <div class="help-block">  {{ $errors->first('banner_mobile_view') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="alt_text">Title En</label>
                                    <input type="text" name="title_en" id="alt_text" class="form-control"
                                           placeholder="Enter title en" value="{{ isset($aboutLoyaltyBanner->title_en) ? $aboutLoyaltyBanner->title_en : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('alt_text'))
                                        <div class="help-block">{{ $errors->first('alt_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Title Bn</label>
                                    <input type="text" name="title_bn" id="alt_text" class="form-control"
                                           placeholder="Enter title bn" value="{{ isset($aboutLoyaltyBanner->title_bn) ? $aboutLoyaltyBanner->title_bn : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('desc_en') ? ' error' : '' }}">
                                    <label for="alt_text">Short Description En</label>
                                    <textarea name="desc_en" id="desc_en" class="form-control" rows="4"
                                           placeholder="Enter description en"
                                    >{{ isset($aboutLoyaltyBanner->desc_en) ? $aboutLoyaltyBanner->desc_en : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('desc_en'))
                                        <div class="help-block">{{ $errors->first('desc_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Short Description Bn</label>
                                    <textarea type="text" name="desc_bn" id="alt_text" class="form-control" rows="4"
                                              placeholder="Enter description bn">{{ isset($aboutLoyaltyBanner->desc_bn) ? $aboutLoyaltyBanner->desc_bn : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('desc_bn'))
                                        <div class="help-block">{{ $errors->first('desc_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('tag_en') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword En</label>
                                    <textarea name="tag_en" id="tag_en" class="form-control" rows="4"
                                              placeholder="Enter keywords en"
                                    >{{ isset($aboutLoyaltyBanner->tag_en) ? $aboutLoyaltyBanner->tag_en : '' }}</textarea>
                                    <small class="warning"><strong>Example: Internet Packs, Tier Based Tenure, Eligible Customers, Point Status</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_en'))
                                        <div class="help-block">{{ $errors->first('tag_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('tag_bn') ? ' error' : '' }}">
                                    <label for="alt_text">Search Special Keyword Bn</label>
                                    <textarea type="text" name="tag_bn" id="alt_text" class="form-control" rows="4"
                                              placeholder="Enter keywords bn">{{ isset($aboutLoyaltyBanner->tag_bn) ? $aboutLoyaltyBanner->tag_bn : '' }}</textarea>
                                    <small class="warning"><strong>Example: পয়েন্ট স্ট্যাটাস, টিয়ার সিস্টেম, অরেঞ্জ ক্লাব এর সদস্য</strong></small>
                                    <div class="help-block"></div>
                                    @if ($errors->has('tag_bn'))
                                        <div class="help-block">{{ $errors->first('tag_bn') }}</div>
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






