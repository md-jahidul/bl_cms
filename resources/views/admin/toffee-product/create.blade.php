@extends('layouts.admin')
@section('title', 'Create Product')
@section('card_name', 'Create Product')
@section('breadcrumb')
    <li class="breadcrumb-item active">Create Product</li>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('toffee-product.store') }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title" class="required">Title</label>
                                    <input class="form-control"
                                           name="title"
                                           id="title"
                                           placeholder="Title"
                                           required>
                                    @if($errors->has('title'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('title') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="required">Commercial Name En</label>
                                    <input class="form-control"
                                           name="commercial_name_en"
                                           id="commercial_name_en"
                                           placeholder="Commercial Name En"
                                           required>
                                    @if($errors->has('commercial_name_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('commercial_name_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="required">Commercial Name Bn</label>
                                    <input class="form-control"
                                           name="commercial_name_bn"
                                           id="commercial_name_bn"
                                           placeholder="Commercial Name bn"
                                           required>
                                    @if($errors->has('commercial_name_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('commercial_name_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="required">Product Code</label>
                                    <input class="form-control"
                                           name="product_code"
                                           id="product_code"
                                           placeholder="Enter Product Code"
                                           required>
                                    @if($errors->has('product_code'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('product_code') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="internet" class="required">Internet</label>
                                    <input class="form-control"
                                           type="number"
                                           name="internet"
                                           id="internet"
                                           placeholder="Enter MB."
                                           required>
                                    @if($errors->has('internet'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('internet') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="">Recharge Product Code</label>
                                    <input class="form-control"
                                           name="recharge_product_code"
                                           id="recharge_product_code"
                                           placeholder="Enter Product Code"
                                           required>
                                    @if($errors->has('recharge_product_code'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('recharge_product_code') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="validity" class="required">Validity</label>
                                    <input class="form-control"
                                           type="number"
                                           name="validity"
                                           id="validity"
                                           placeholder="Enter Validity."
                                           required>
                                    @if($errors->has('validity'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('validity') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Validity Unit</label>
                                        <select name="validity_unit" class="form-control">
                                            <option value="hours">Hours</option>
                                            <option value="days" >Days</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="header_title_en" class="required">Price</label>
                                    <input class="form-control"
                                           name="price"
                                           id="price"
                                           placeholder="Enter Price Amount."
                                           required>
                                    @if($errors->has('price'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('price') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="internet" class="required">Points</label>
                                    <input class="form-control"
                                           type="number"
                                           name="points"
                                           id="points"
                                           placeholder="Enter Point Amount."
                                           required>
                                    @if($errors->has('points'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('points') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="offer_breakdown_en" class="required">Offer Breakdown En</label>
                                    <input class="form-control"
                                           name="offer_breakdown_en"
                                           id="offer_breakdown_en"
                                           placeholder="Enter Offer Breakdown En"
                                           required>
                                    @if($errors->has('offer_breakdown_en'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('offer_breakdown_en') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="offer_breakdown_bn" class="required">Offer Breakdown Bn</label>
                                    <input class="form-control"
                                           name="offer_breakdown_bn"
                                           id="offer_breakdown_bn"
                                           placeholder="Enter Offer Breakdown Bn"
                                           required>
                                    @if($errors->has('offer_breakdown_bn'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('offer_breakdown_bn') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="display_sd_vat_tax" class="required">Display Sd Vat Tax</label>
                                    <input class="form-control"
                                           name="display_sd_vat_tax"
                                           id="display_sd_vat_tax"
                                           placeholder="Enter Display Sd Vat Tax"
                                           required>
                                    @if($errors->has('display_sd_vat_tax'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('display_sd_vat_tax') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Has Autorenew</label>
                                        <select name="has_autorenew" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Is Recharge</label>
                                        <select name="is_recharge" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0" >No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" >Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="eventInput3">Connection Type</label>
                                        <select name="connection_type" class="form-control">
                                            <option value="prepaid" >Prepaid</option>
                                            <option value="postpaid">Postpaid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="content_ids" class="">Content Ids</label>
                                    <input class="form-control"
                                           name="content_ids"
                                           id="content_ids"
                                           placeholder="Enter Content Ids with comma-separated value"
                                           required>
                                    @if($errors->has('content_ids'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('content_ids') }}</small>
                                        </p>
                                    @endif
                                    <span class="text-info"><strong><i class="la la-info-circle"></i></strong> Enter Content Ids with comma-separated value</span>
                                    <div class="help-block"></div>
                                </div>
                                <div id="image-input" class="form-group col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="image_url">Image</label>
                                        <input type="file"
                                               id="image_url"
                                               name="image"
                                               class="dropify_image"
                                               data-height="80"
                                               data-default-file="{{ isset($campaign->icon) ? url('/' .$campaign->icon) : ''}}"
                                               data-allowed-file-extensions="png jpg gif"/>
                                        <div class="help-block"></div>
                                        <small
                                            class="text-danger"> @error('image') {{ $message }} @enderror </small>
                                        <small id="massage"></small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/weekday-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('app-assets/js/recurring-schedule/recurring.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    {{--    <script src="{{ asset('app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js')}}"></script>--}}
    {{--    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>--}}
    <script>
        $('.dropify_image').dropify({
            messages: {
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            },
            error: {
                'imageFormat': 'The image must be valid format'
            }
        });
    </script>
@endpush
