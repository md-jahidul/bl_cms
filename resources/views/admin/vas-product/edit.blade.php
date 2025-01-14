@extends('layouts.admin')
@section('title', 'Edit VAS Product')
@section('card_name', 'Edit VAS Product')

@section('action')
    <a href="{{route('vas-products.index')}}" class="btn btn-info btn-glow px-2">
        Back
    </a>
@endsection
@section('content')
    <section id="form-control-repeater">
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form novalidate class="form row"
                              action="{{ route("vas-products.update",$vasProduct->id) }}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('put')

                            <div class="form-group col-md-6 mb-2">
                                <label for="subscription_offer_id" class="required">Subscription offer ID:</label>
                                <input
                                    data-validation-required-message="Subscription offer id is required"
                                    value="{{old('subscription_offer_id')?old('subscription_offer_id'):$vasProduct->subscription_offer_id}}" required id="subscription_offer_id"
                                    type="text" class="form-control @error('title_en') is-invalid @enderror"
                                    placeholder="Subscription offer id" name="subscription_offer_id">
                                <div class="help-block"></div>
                                @if ($errors->has('subscription_offer_id'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('subscription_offer_id') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="partner_id" class="required">Partner id:</label>
                                <input
                                    data-validation-required-message="Partner ID is required"
                                    value="{{old('partner_id')?old('partner_id'):$vasProduct->partner_id}}" required id="partner_id"
                                    type="text" class="form-control @error('partner_id') is-invalid @enderror"
                                    placeholder="Partner ID" name="partner_id">
                                <div class="help-block"></div>
                                @if ($errors->has('partner_id'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('partner_id') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="title_en" class="required">Title (EN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-regex-regex="(([aA-zZ' '])([0-9+!-=@#$%/(){}\._])*)*"
                                    data-validation-required-message="Title is required"
                                    data-validation-regex-message="Title must start with alphabets"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_en')?old('title_en'):$vasProduct->title_en}}" required id="title_en"
                                    type="text" class="form-control @error('title_en') is-invalid @enderror"
                                    placeholder="Title in English" name="title_en">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                    <div class="help-block">
                                            <small class="text-danger"> {{ $errors->first('title_en') }} </small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="title_bn" class="required">Title (BN):</label>
                                <input
                                    maxlength="200"
                                    data-validation-required-message="Title is required"
                                    data-validation-maxlength-message="Title can not be more then 200 Characters"
                                    value="{{old('title_bn')?old('title_bn'):$vasProduct->title_bn}}" required id="title_bn"
                                    type="text" class="form-control @error('title_bn') is-invalid @enderror"
                                    placeholder="Title in Bangla" name="title_bn">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('title_bn') }} </small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="desc_en" class="">Description (EN):</label>
                                <textarea
                                    class="form-control"
                                    placeholder="Description in English" name="desc_en"> {{old('desc_en')?old('desc_en'):$vasProduct->desc_en}} </textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('desc_en'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('desc_en') }} </small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="desc_bn" class="">Description (BN):</label>
                                <textarea
                                    class="form-control"
                                    placeholder="Description in Bangla" name="desc_bn"> {{old('desc_bn')?old('desc_bn'):$vasProduct->desc_bn}} </textarea>
                                <div class="help-block"></div>
                                @if ($errors->has('desc_bn'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('desc_bn') }} </small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="price" class="required">Price:</label>
                                <input
                                    data-validation-required-message="Price is required"
                                    value="{{old('price')?old('price'):$vasProduct->price}}" required id="price"
                                    type="number" class="form-control @error('price') is-invalid @enderror"
                                    placeholder="Product Price" name="price" step="0.01">
                                <div class="help-block"></div>
                                @if ($errors->has('price'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('price') }} </small>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="platform" class="required">Platform:</label>
                                    <select class="form-control" id="platform"
                                            name="platform">
                                        <option value="SDP" @if($vasProduct->platform == "SDP") selected @endif> SDP</option>
                                        <option value="RRBT" @if($vasProduct->platform == "RRBT") selected @endif> RRBT</option>
                                        <option value="CRBT" @if($vasProduct->platform == "CRBT") selected @endif> CRBT</option>
                                        <option value="stop_all" @if($vasProduct->platform == "stop_all") selected @endif> Stop All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="validity_en" class="required">Validity (EN):</label>
                                <input
                                    data-validation-required-message="Validity is required"
                                    value="{{old('validity_en')?old('validity_en'):$vasProduct->validity_en}}" required id="validity_en"
                                    type="text" class="form-control @error('validity_en') is-invalid @enderror"
                                    placeholder="Validity in English" name="validity_en">
                                <div class="help-block"></div>
                                @if ($errors->has('validity_en'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('validity_en') }} </small>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="validity_bn" class="required">Validity (BN):</label>
                                <input
                                    data-validation-required-message="Validity is required"
                                    value="{{old('validity_bn')?old('validity_bn'):$vasProduct->validity_bn}}" required id="validity_bn"
                                    type="text" class="form-control @error('validity_bn') is-invalid @enderror"
                                    placeholder="Validity in Bangla" name="validity_bn">
                                <div class="help-block"></div>
                                @if ($errors->has('validity_bn'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('validity_bn') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="is_renewable">Is Renewable:</label>
                                    <select class="form-control" id="is_renewable"
                                            name="is_renewable">
                                        <option value="1" @if($vasProduct->is_renewable == "1") selected @endif > Yes </option>
                                        <option value="0" @if($vasProduct->is_renewable == "0") selected @endif > No </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-2">
                                <label for="activation_type" class="required">Activation type:</label>
                                <div class="">
                                    <ul class="list list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="activation_type" id="Default" value="Default"
                                                {{$vasProduct->activation_type == 'Default' ? 'checked' : ''}}>
                                            <label for="Default" class="small">Default</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input id="Deeplink" type="radio" name="activation_type" value="Deeplink"
                                                {{$vasProduct->activation_type == 'Deeplink' ? 'checked' : ''}}>
                                            <label for="Deeplink" class="small">Deeplink</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="activation_deeplink" @if ($vasProduct->activation_type == 'Default')
                                            style="display: none" @endif>
                                            <label class="small">Deeplink</label>
                                            <div class='input-group'>
                                                <input
                                                    value="{{old('activation_deeplink')?old('activation_deeplink'):$vasProduct->activation_deeplink}}" id="activation_deeplink"
                                                    type="text" class="form-control @error('activation_deeplink') is-invalid @enderror"
                                                    placeholder="Activation Deeplink" name="activation_deeplink">
                                                <div class="help-block"></div>
                                                @if ($errors->has('activation_deeplink'))
                                                    <div class="help-block">
                                                        <small class="text-danger"> {{ $errors->first('activation_deeplink') }} </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="deactivation_type" class="required">Deactivation type:</label>
                                <div class="">
                                    <ul class="list list-inline">
                                        <li class="list-inline-item">
                                            <input type="radio" name="deactivation_type" id="Default" value="Default"
                                                {{$vasProduct->deactivation_type == 'Default' ? 'checked' : ''}}>
                                            <label for="Default" class="small">Default</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input id="Deeplink" type="radio" name="deactivation_type" value="Deeplink"
                                                {{$vasProduct->deactivation_type == 'Deeplink' ? 'checked' : ''}}>
                                            <label for="Deeplink" class="small">Deeplink</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" id="deactivation_deeplink" @if ($vasProduct->deactivation_type == 'Default')
                                            style="display: none" @endif>
                                            <label class="small">Deeplink</label>
                                            <div class='input-group'>
                                                <input
                                                    value="{{old('deactivation_deeplink')?old('deactivation_deeplink'):$vasProduct->deactivation_deeplink}}" id="deactivation_deeplink"
                                                    type="text" class="form-control @error('deactivation_deeplink') is-invalid @enderror"
                                                    placeholder="Activation Deeplink" name="deactivation_deeplink">
                                                <div class="help-block"></div>
                                                @if ($errors->has('deactivation_deeplink'))
                                                    <div class="help-block">
                                                        <small class="text-danger"> {{ $errors->first('deactivation_deeplink') }} </small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Active Status:</label>
                                    <select value="{{$vasProduct->status}}"
                                            class="form-control" id="status"
                                            name="status">
                                        <option value="1"
                                                @if($vasProduct->status == "1") selected @endif>
                                            Active
                                        </option>
                                        <option value="0"
                                                @if($vasProduct->status == "0") selected @endif>
                                            InActive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }}">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    {{-- <input
                                        accept="image/*"
                                        type="file" name="image" class="custom-file-input dropify" data-default-file="{{ asset($vasProduct->image) }}"
                                            data-height="80" data-allowed-file-extensions="png jpg jpeg gif json"> --}}
                                    <input
                                        value="{{old('image')?old('image'):$vasProduct->image}}" id="image"
                                        type="text" class="form-control @error('validity_en') is-invalid @enderror"
                                        placeholder="Image Url" name="image">
                                </div>
                                <div class="help-block"></div>
                                <div class="help-block"></div>
                                <small id="massage"></small>
                                @if ($errors->has('image'))
                                    <div class="help-block">
                                        <small class="text-danger"> {{ $errors->first('image') }} </small>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <button style="float: right" type="submit" id="submitForm"
                                        class="btn btn-success round px-2">
                                    <i class="la la-check-square-o"></i> Submit
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!$vasProduct)
        <h1>
            No VAS Product Available
        </h1>
    @else

    @endif
@endsection




@push('style')

@endpush

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

    <script>

        $(function () {
            $('input[name="activation_type"]').on('change', function () {
                let action = $(this).val();
                if (action === "Deeplink") {
                    $('#activation_deeplink').show();
                } else {
                    $('#activation_deeplink').hide();
                }
            });

            $('input[name="deactivation_type"]').on('change', function () {
                let action = $(this).val();
                if (action === "Deeplink") {
                    $('#deactivation_deeplink').show();
                } else {
                    $('#deactivation_deeplink').hide();
                }
            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image/Json File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct Image/Json file'
                },
                error: {
                    'imageFormat': 'The image must be valid format'
                }
            });
        });

    </script>
@endpush
