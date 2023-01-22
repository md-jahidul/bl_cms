@extends('layouts.admin')
@section('title', 'Config Item List')
@section('card_name', 'Config Item List')
{{--@section('breadcrumb')--}}
{{--    <li class="breadcrumb-item active">Config Item List</li>--}}
{{--@endsection--}}
{{--@section('action')--}}
{{--@endsection--}}
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="striped-row-layout-card-center"><i class="la la-gears"></i> Settings Page</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <hr class="mb-0">
                <div class="card-content collpase show">
                    <div class="card-body">
                        <form role="form" action="{{ url('config/update') }}" method="POST" class="form form-horizontal striped-rows" novalidate enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-body">
                                @foreach($configs as $key =>$config)
                                    @php($title = ucfirst(str_replace('_', ' ', $config->key )))

                                    @if($config->key == "site_logo")
                                        <div class="form-group row profile-pic">
                                            <label class="col-md-3 label-control pt-3"  for="row">{{ $title }}</label>
                                            <div class="pb-0">
                                                <img src="{{ config('filesystems.file_base_url') . $config->value }}" height="55" width="50" id="imgDisplay">
                                                    <input type="file" name="site_logo" class="input-logo pl-2" style="display: none" placeholder="Enter logo alt text" value="{{ old($config->key) ?? $config->value }}">
                                                    <a href="#" class="close-edit text-danger" style="display: none"><i class="la la-close" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="edit pt-3 pb-0">
                                                <a href="#" class="edit-btn"><i class="la la-pencil" title="Change Logo" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    <!-- customer image upload size -->
                                    @elseif($config->key == "login_page_banner")
                                        <div class="form-group row profile-pic">
                                            <label class="col-md-3 label-control pt-3"  for="row">{{ $title }}</label>
                                            <div class="pb-0">
                                                    <img src="{{ config('filesystems.file_base_url') . $config->value }}" height="55" width="50" id="imgDisplay" data-toggle="modal" data-target="#myModal">
                                                    <input type="file" name="login_page_banner" class="banner-input-logo pl-2" style="display: none" placeholder="Enter logo alt text" value="{{ old($config->key) ?? $config->value }}">
                                                    <a href="#" class="banner-close-edit text-danger" style="display: none"><i class="la la-close" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="edit pt-3 pb-0">
                                                <a href="#" class="banner-edit-btn"><i class="la la-pencil" title="Change Login Page Banner" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{  config('filesystems.file_base_url') . $config->value }}" id="imgDisplay">
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    <!-- customer image upload size -->
                                    @elseif($config->key == "image_upload_size")
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">{{ $title }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" required data-validation-required-message="Enter {{$title}}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"><small>Please enter file size upto 2M. </small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    <!-- customer image upload type -->
                                    @elseif($config->key == "image_upload_type")
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">{{ $title }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" required data-validation-required-message="Enter {{$title}}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"><small>Please enter file type with comma(,) separated.</small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    <!-- Admin user image upload size -->
                                    @elseif($config->key == "admin_image_upload_size")
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">CMS image upload size</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" required data-validation-required-message="Enter {{$title}}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"><small>Please enter file size upto 2M. </small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    <!-- Admin user image upload type -->
                                    @elseif($config->key == "admin_image_upload_type")
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">CMS image upload type</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" required data-validation-required-message="Enter {{$title}}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"><small>Please enter file type with comma(,) separated.</small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    @elseif($config->key == "advance_minimum_balance")
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">Bl advance minimum balance</label>
                                            <div class="col-md-9">
                                                <input type="number" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" required data-validation-required-message="Enter {{$title}}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"><small>Default value 10 taka</small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif($config->key == "header_script")
                                    <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">Header Script</label>
                                            <div class="col-md-9">
                                                <textarea id="row{{$key}}" rows="8" class="form-control" placeholder="Enter {{ $title }}" name="{{ $config->key }}">{{ old($config->key) ?? $config->value }}</textarea>
                                                <div class="help-block"><small>Google and other analytics and social media head scripts.</small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>



                                    @elseif($config->key == "body_script")
                                    <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">Body Script </label>
                                            <div class="col-md-9">
                                                <textarea id="row{{$key}}" rows="8" class="form-control" placeholder="Enter {{ $title }}" name="{{ $config->key }}">{{ old($config->key) ?? $config->value }}</textarea>
                                                <div class="help-block"><small>Google tag manager or any &lt;body&gt; script .</small></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    @else
                                        <div class="form-group row {{ $errors->has($config->key) ? ' error' : '' }}">
                                            <label class="col-md-3 label-control" for="row{{$key}}">{{ $title }}</label>
                                            <div class="col-md-9">
                                                <input type="text" id="row{{$key}}" class="form-control"  value="{{ old($config->key) ?? $config->value }}" placeholder="Enter {{ $title }}" name="{{ $config->key }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has($config->key))
                                                    <div class="help-block">  {{ $errors->first($config->key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                @endforeach



                            </div>
                            <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="eventRegInput5"></label>
                                    <div class="col-md-9 pt-0 pb-0">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save Changes
                                        </button>
                                        <a href="{{ url('/home') }}" class="btn btn-warning">
                                            <i class="la la-arrow-circle-left"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


<style>
    .profile-pic {
        position: relative;
        display: inline-block;
    }
    .profile-pic:hover .edit {
        display: block;
    }
    .edit {
        display: none;
    }
</style>

@push('page-js')
    <script>
        (function () {
            $(".edit-btn").on('click', function () {
                $('.edit-btn').hide();
                $('.input-logo').show();
                $('.close-edit').show();
            });
            $(".close-edit").on('click', function () {
                $('.edit-btn').show();
                $('.input-logo').hide();
                $('.close-edit').hide();
            })

            //Logiin page banner change image hide show JS
            $(".banner-edit-btn").on('click', function () {
                $('.banner-edit-btn').hide();
                $('.banner-input-logo').show();
                $('.banner-close-edit').show();
            });
            $(".banner-close-edit").on('click', function () {
                $('.banner-edit-btn').show();
                $('.banner-input-logo').hide();
                $('.banner-close-edit').hide();
            })
        })()

    </script>
@endpush





