@extends('layouts.admin')
@section('title_en', 'TVC Video Create')
@section('card_name', 'TVC Video Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('tvc-video') }}">TVC Video List</a></li>
    <li class="breadcrumb-item active">TVC Video Create</li>
@endsection
@section('action')
    <a href="{{ url('tvc-video') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('tvc-video.update', $tvcVideo->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ $tvcVideo->title_en }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in English"
                                           value="{{ $tvcVideo->title_bn }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('year_en') ? ' error' : '' }}">
                                    <label for="year_en" class="required">Year English</label>
                                    <input type="text" name="year_en"  class="form-control" placeholder="Enter year in English"
                                           value="{{ $tvcVideo->year_en }}" required data-validation-required-message="Enter year in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('year_en'))
                                        <div class="help-block">  {{ $errors->first('year_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('year_bn') ? ' error' : '' }}">
                                    <label for="year_bn" class="required">Year Bangla</label>
                                    <input type="text" name="year_bn"  class="form-control" placeholder="Enter year in English"
                                           value="{{ $tvcVideo->year_bn }}" required data-validation-required-message="Enter year in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('year_bn'))
                                        <div class="help-block">{{ $errors->first('year_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
                                    <label for="video_url" class="required">Video Embed Code</label>
                                    <input type="text" name="video_url" class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ $tvcVideo->video_url }}" required data-validation-required-message="Enter embed code url">
                                    <span class="text-primary">Example: https://www.youtube.com/embed/m5r-chnFIaI</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('video_url'))
                                        <div class="help-block">  {{ $errors->first('video_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('video_url') ? ' error' : '' }}">
                                    <label for="video_url" class="required">Video Preview</label>
                                    <iframe width="490" height="150" src="{{ $tvcVideo->video_url }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" {{ $tvcVideo->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" id="inactive" {{ $tvcVideo->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            var date = new Date();
            date.setDate(date.getDate());
            $('#date').datetimepicker({
                format : 'YYYY-MM-DD',
                showClose: true,
            });
        });
    </script>
@endpush
