@extends('layouts.admin')
@section('title', 'About Career Item Create')
@section('card_name', 'About Career Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('about-career') }}">About Career</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('career-item.list', $careerId) }}">About Career Item List</a></li>
    <li class="breadcrumb-item active"> About Career Item Create</li>
@endsection
@section('action')
    <a href="{{ route('career-item.list', $careerId) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('career-item.store', $careerId) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter tag name"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter tag name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                    <label for="description_en" class="required">Description (English)</label>
                                    <textarea type="text" name="description_en"  class="form-control" placeholder="Enter description in English"
                                              required data-validation-required-message="Enter description in english"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_en'))
                                        <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                    <label for="description_bn" class="required">Description (Bangla)</label>
                                    <textarea type="text" name="description_bn"  class="form-control" placeholder="Enter description in Bangla"
                                              required data-validation-required-message="Enter description in bangla"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_bn'))
                                        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="alt_text" class="">Item Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="dropify" data-height="80">
                                    </div>
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name') ? ' error' : '' }}">
                                    <label>Image Name EN</label>
                                    <input type="text" name="image_name"  class="form-control" placeholder="Enter image name en"
                                           value="{{ old('image_name') ? old('image_name') : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name'))
                                        <div class="help-block">  {{ $errors->first('image_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                    <label>Image Name BN</label>
                                    <input type="text" name="image_name_bn"  class="form-control" placeholder="Enter image name bn"
                                           value="{{ old('image_name_bn') ? old('image_name_bn') : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('image_name_bn'))
                                        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Alt Text EN</label>
                                    <input type="text" name="alt_text"  class="form-control" placeholder="Enter alt text en"
                                        {{ old('alt_text') ? old('alt_text') : '' }}>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Alt Text BN</label>
                                    <input type="text" name="alt_text_bn"  class="form-control"  placeholder="Enter alt text bn"
                                        {{ old('alt_text') ? old('alt_text') : '' }}>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="alt_text">Alt Link</label>
                                    <input type="text" name="alt_links" placeholder="Enter alt link" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>

                                        @if ($errors->has('is_active'))
                                            <div class="help-block">  {{ $errors->first('is_active') }}</div>
                                        @endif
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });
        })
    </script>
@endpush






