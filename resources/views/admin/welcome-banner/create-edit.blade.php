@extends('layouts.admin')
@php $cardname = isset($welcome_banner)? 'Edit Welcome Banner':'Create Welcome Banner' @endphp
@section('title', "Welcome Banner")
@section('card_name', "Welcome Banner")
@section('breadcrumb')
    <li class="breadcrumb-item"> <a href="{{ url('welcome-banner') }}"> Welcome Banner List</a></li>
    <li class="breadcrumb-item active">
        @if(isset($welcome_banner))
            Edit Welcome Banner
        @else
            Create Welcome Banner
        @endif
    </li>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                @if(isset($welcome_banner))
                    Edit Welcome Banner
                @else
                    Create Welcome Banner
                @endif
            </h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            <!-- /short cut add form -->
            @if(isset($welcome_banner))
                <form novalidate action="{{ route('welcome-banner.update',$welcome_banner->id) }}" method="post"
                      enctype="multipart/form-data">
                    @else
                        <form action="{{ route('welcome-banner.store') }}" method="post"
                              enctype="multipart/form-data">
                            @endif

                            @csrf
                            @if(isset($welcome_banner))
                                @method('put')
                            @else
                                @method('post')
                            @endif

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="required">Banner Title En:</label>
                                        <input required
                                               maxlength="200"
                                               data-validation-required-message="Banner Title is required"
                                               data-validation-regex-message="Banner Title must start with alphabets"
                                               data-validation-maxlength-message="Banner Name can not be more then 200 Characters"
                                               id="title_en"
                                               value="@if(isset($welcome_banner)){{$welcome_banner->title_en}} @elseif(old("title_en")) {{old("title_en")}} @endif"
                                               type="text" name="title_en"
                                               class="form-control @error('name') is-invalid @enderror" id="title"
                                               placeholder="Enter Welcome Banner Title in English">
                                        <small class="text-danger"> @error('name') {{ $message }} @enderror </small>
                                        <div class="help-block">
                                            <small class="text-warning">Banner Name can not be more then 200
                                                Characters</small>
                                        </div>
                                    </div>
                                    @if(isset($welcome_banner)) <input type="hidden" name="id"
                                                                       value="{{$welcome_banner->id}}"> @endif
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="required">Banner Title Bn:</label>
                                        <input required
                                               maxlength="200"
                                               data-validation-required-message="Banner Title is required"
                                               data-validation-regex-message="Banner Title must start with alphabets"
                                               data-validation-maxlength-message="Banner Name can not be more then 200 Characters"
                                               id="title_en"
                                               value="@if(isset($welcome_banner)){{$welcome_banner->title_bn}} @elseif(old("title_bn")) {{old("title_bn")}} @endif"
                                               type="text" name="title_bn"
                                               class="form-control @error('title_bn') is-invalid @enderror"
                                               id="title_bn"
                                               placeholder="Enter Welcome Banner Title in Bangla">
                                        <small class="text-primary"> @error('title_bn') {{ $message }} @enderror </small>
                                        <div class="help-block">
                                            <small class="text-warning">Banner Title can not be more then 200
                                                Characters</small>
                                        </div>
                                    </div>
                                    @if(isset($welcome_banner)) <input type="hidden" name="id"
                                                                       value="{{$welcome_banner->id}}"> @endif
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="dashboard_card_sub_title">Description En</label>
                                        <textarea rows="4" required name="description_en" class="form-control"
                                                  placeholder="Enter description in English">@if(isset($welcome_banner)){{$welcome_banner->description_en}} @elseif(old("description_en")) {{old("description_en")}} @endif</textarea>
                                        <small class="text-danger"> @error('description_en') {{ $message }} @enderror </small>
                                        <div class="help-block">
                                            <small class="text-warning">Description can not be more then 200
                                                Characters</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="dashboard_card_sub_title">Description Bn</label>
                                        <textarea rows="4" required name="description_bn" class="form-control"
                                                  placeholder="Enter description in Bangla">@if(isset($welcome_banner)){{$welcome_banner->description_bn}} @elseif(old("description_bn")) {{old("description_bn")}} @endif</textarea>
                                        <small class="text-danger"> @error('description_en') {{ $message }} @enderror </small>
                                        <div class="help-block">
                                            <small class="text-warning">Description can not be more then 200
                                                Characters</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 offset-6">
                                    <div id="image-input" class="form-group">
                                        <div class="form-group">
                                            <label for="image_url">Upload Welcome Banner </label>
                                            <input type="file" id="image_url" name="banner_img" class="dropify_image" required
                                                   data-width="800"
                                                   data-min-width="799" data-min-height="799"
                                                   data-max-width="801" data-max-height="801"
                                                   data-validation-required-message="Banner Image required"
                                                   data-default-file="{{ isset($welcome_banner) ? asset($welcome_banner->banner_img) : ''}}"
                                                   data-allowed-file-extensions="png jpg gif"/>
                                            <small class="text-danger"> @error('banner_img') {{ $message }} @enderror </small>
                                            <div class="help-block">
                                                <small class="text-warning">Banner image dimension must be <strong>800 X 800</strong> and size must not exceed <strong>100
                                                        kb</strong></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="col-2 offset-10">
                                            <button type="submit" id="submitForm" style="width:100%"
                                                    class="btn @if(isset($welcome_banner)) btn-success @else btn-info @endif ">
                                                @if(isset($welcome_banner)) Update Banner @else Create Banner @endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </form>
                        <!-- /short cut add form -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->



@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dropify_image').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });
    </script>
@endpush
