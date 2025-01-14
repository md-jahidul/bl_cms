@php
    function match($id, $multiItems){
        foreach ($multiItems as $item)
        {
            if($item->id == $id){
                return true;
            }
        }
        return false;
    }
@endphp

@extends('layouts.admin')
@section('', 'Device|Edit')
@section('card_name', '4G Devices')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url("bl-4g-devices") }}">Devices List</a></li>
    <li class="breadcrumb-item active"> Device Create</li>
@endsection
@section('action')
    <a href="{{ url("bl-4g-devices") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("bl-4g-devices.update", $device->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en">Model Title English</label>
                                    <input type="text" name="title_en" class="form-control" placeholder="Enter title_en"
                                           value="{{ $device->title_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn">Model Title Bangla</label>
                                    <input type="text" name="title_bn" class="form-control" placeholder="Enter title_bn"
                                           value="{{ $device->title_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('offer_tag_id') ? ' error' : '' }}">
                                    <label for="offer_tag_id">Offer Tag</label>
                                    <select class="form-control" name="offer_tag_id" id="offer_tag_id">
                                        <option value="">---Select Tag---</option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ $device->offer_tag_id == $tag->id ? 'selected' : '' }}>{{ $tag->name_en }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('offer_tag_id'))
                                        <div class="help-block">  {{ $errors->first('offer_tag_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group select-role col-md-6 {{ $errors->has('device_tags') ? ' error' : '' }}">
                                    <label for="device_tags">Device Tag</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" id="device_tags" name="device_tags[]">
                                            @foreach($deviceTags as $tag)
                                                <option value="{{ $tag->id }}" {{ match($tag->id, $device->deviceTags) ? 'selected' : '' }}>{{ $tag->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('device_tags'))
                                        <div class="help-block">  {{ $errors->first('device_tags') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('card_logo') ? ' error' : '' }}">
                                    <label for="mobileImg">Brand Logo</label>
                                    <div class="custom-file">
                                        <input type="file" name="card_logo" class="dropify" data-height="80" id="image"
                                               data-default-file="{{ isset($device->card_logo) ?  config('filesystems.file_base_url') . $device->card_logo : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('card_logo'))
                                        <div class="help-block">  {{ $errors->first('card_logo') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_image') ? ' error' : '' }}">
                                    <label for="mobileImg">Device Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail_image" class="dropify" data-height="80" id="image"
                                               data-default-file="{{ isset($device->thumbnail_image) ?  config('filesystems.file_base_url') . $device->thumbnail_image : null  }}">
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_image'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('logo_alt_en') ? ' error' : '' }}">
                                    <label for="logo_alt_en">Logo Alt Text</label>
                                    <input type="text" name="logo_alt_en" class="form-control" placeholder="Enter logo alt text"
                                           value="{{ $device->logo_alt_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('logo_alt_en'))
                                        <div class="help-block">  {{ $errors->first('logo_alt_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('thumbnail_alt_en') ? ' error' : '' }}">
                                    <label for="thumbnail_alt_en">Device Alt Text</label>
                                    <input type="text" name="thumbnail_alt_en" class="form-control" placeholder="Enter thumbnail alt text"
                                           value="{{ $device->thumbnail_alt_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('thumbnail_alt_en'))
                                        <div class="help-block">  {{ $errors->first('thumbnail_alt_en') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 {{ $errors->has('current_price') ? ' error' : '' }}">
                                    <label for="current_price">Current Price</label>
                                    <input type="text" name="current_price" class="form-control" placeholder="Enter current price"
                                           value="{{ $device->current_price }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('current_price'))
                                        <div class="help-block">  {{ $errors->first('current_price') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('old_price') ? ' error' : '' }}">
                                    <label for="old_price">Old Price</label>
                                    <input type="text" name="old_price" class="form-control" placeholder="Enter old price"
                                           value="{{ $device->old_price }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('old_price'))
                                        <div class="help-block">  {{ $errors->first('old_price') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('view_details_url') ? ' error' : '' }}">
                                    <label for="view_details_url">View Details URL</label>
                                    <input type="url" name="view_details_url" class="form-control" placeholder="Enter view_details_url"
                                           value="{{ $device->view_details_url }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('view_details_url'))
                                        <div class="help-block">  {{ $errors->first('view_details_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('buy_url') ? ' error' : '' }}">
                                    <label for="buy_url">Buy Now URL</label>
                                    <input type="url" name="buy_url" class="form-control" placeholder="Enter buy_url"
                                           value="{{ $device->buy_url }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('buy_url'))
                                        <div class="help-block">  {{ $errors->first('buy_url') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" {{ $device->status == 1 ? 'checked' : '' }}>
                                        <label for="active" class="mr-1">Active</label>
                                        <input type="radio" name="status" value="0" {{ $device->status == 0 ? 'checked' : '' }}>
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
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
    <style>
        form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
            border-color: unset;
            -webkit-box-shadow: unset;
            -moz-box-shadow: unset;
            box-shadow: unset;
            border-width: 0;
            color : unset;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $(function (){
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














