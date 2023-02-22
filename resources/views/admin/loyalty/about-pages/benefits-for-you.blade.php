@extends('layouts.admin')

@section('title', "Benefits For You")
@section('card_name', "Benefits For You")
@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="--}}{{--{{ route('product.list', ) }}--}}{{--"> List</a></li>--}}
    {{--    <li class="breadcrumb-item active"> <a href="{{ route('partner-offer', [$parentId, $partnerName]) }}"> Partner Offer List</a></li>--}}
    {{-- <li class="breadcrumb-item active">Component List</li> --}}
@endsection
@section('action')
    {{-- <a href="{{ route('about-page.component.create')}}" class="btn btn-primary btn-glow px-2"><i class="la la-list"></i> Add Component </a> --}}
@endsection
@section('content')
    {{-- @php
        $action = [
            'edit' => 'about-page/component/edit',
            'destroy' => 'about-page/component/destroy',
            'componentSort' => 'about-page-component-sort'
        ];
    @endphp
    @include('admin.components.index', $action) --}}

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("priyojon/ $priyojonLanding->id") }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $priyojonLanding->id }}">
                                <input type="hidden" name="parent_id" value="{{ $priyojonLanding->parent_id }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $priyojonLanding->title_en }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter duration name in english"
                                           value="{{ $priyojonLanding->title_bn }}" required data-validation-required-message="Enter duration name in english">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('desc_en') ? ' error' : '' }}">
                                    <label for="desc_en">Description (English)</label>
                                    <textarea type="text" name="desc_en" rows="5"
                                            class="form-control summernote_editor"
                                            placeholder="Enter page description in English"
                                    >{{ $priyojonLanding->desc_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('desc_bn'))
                                        <div class="help-block">{{ $errors->first('desc_bn') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('desc_bn') ? ' error' : '' }}">
                                    <label for="desc_bn">Description (Bangla)</label>
                                    <textarea type="text" name="desc_bn" rows="5"
                                            class="form-control summernote_editor"
                                            placeholder="Enter page description in Bangla"
                                    >{{ $priyojonLanding->desc_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('desc_bn'))
                                        <div class="help-block">{{ $errors->first('desc_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
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

    {{-- @php
        $action = [
                'section_id' => 0,
                'section_type' => 'benefits_for_you',
            ];
    @endphp
    @include('admin.al-banner.section', $action) --}}



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






