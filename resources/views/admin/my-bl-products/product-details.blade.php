@extends('layouts.admin')
@section('title', 'Mybl Products')

@section('card_name', "Product Details")

@section('action')
    <a href="{{ route('mybl.product.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back To Product List
    </a>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div class="card-body">
                    <form class="form"
                          action="{{ route('mybl.product.update',  $details->details->product_code )}}"
                          enctype="multipart/form-data"
                          method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sim_type">Connection Type</label>
                                        <input class="form-control"
                                               value="@if($details->details->sim_type == 1) PREPAID @else POSTPAID @endif"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="product_code">Product Code</label>
                                        <input class="form-control" value="{{ $details->details->product_code }}"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input class="form-control" value="{{ $details->details->name }}" name="name" id="name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="content_type">Content Type</label>
                                        <input class="form-control"
                                               value="{{ ucfirst($details->details->content_type) }}" name="content_type">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <input class="form-control" value="{{ $details->details->short_description }}" name="short_description">
                                    </div>
                                </div>
                                @if( $details->details->activation_ussd)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Activation USSD </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->activation_ussd }}" name="activation_ussd">
                                        </div>
                                    </div>
                                @endif
                                @if( $details->details->balance_check_ussd)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Balance USSD</label>
                                            <input class="form-control"
                                                   value="{{ $details->details->balance_check_ussd }}" name="balance_check_ussd">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>MRP Price</label>
                                        <input class="form-control" value="{{ $details->details->mrp_price }}" name="mrp_price">
                                    </div>
                                </div>
                                @if($details->details->data_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Data Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->data_volume }} {{ $details->details->data_volume_unit }}" name="data_volume">
                                        </div>
                                    </div>
                                @endif
                                @if($details->details->minute_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Minute Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->minute_volume }} Minutes" name="minute_volume">
                                        </div>
                                    </div>
                                @endif

                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMS Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->sms_volume }} SMS" name="sms_volume">
                                        </div>
                                    </div>
                                @endif
                                @if($details->details->sms_volume)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>SMS Volume </label>
                                            <input class="form-control"
                                                   value="{{ $details->details->sms_volume }} SMS">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Validity </label>
                                        <input class="form-control"
                                               value="{{ $details->details->validity }} {{ ucfirst($details->details->validity_unit) }}" name="validity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Has Auto Renew Code? </label>
                                        <input class="form-control"
                                               value="{{ ($details->details->renew_product_code)? "YES" : "NO" }}" disabled>
                                    </div>
                                </div>
                                @if($details->details->renew_product_code)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Auto Renewable Code</label>
                                            <input class="form-control"
                                                   value="{{ $details->details->renew_product_code }}"
                                                   disabled>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                @if(strtolower($details->details->content_type) == 'data')
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Data Section </label>
                                            <select
                                                class="form-control"
                                                name="offer_section_slug" required>
                                                <option value=""> Please Select Data Section</option>
                                                @foreach($internet_categories as $category)
                                                    <option value="{{ $category->slug }}"
                                                            @if($category->slug == $details->offer_section_slug) selected @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tag </label>
                                        <input class="form-control" name="tag" value="{{ $details->tag }}" placeholder="e.g. Hot, New etc">
                                        @if($errors->has('tag'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('tag') }}</small>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="show_in_home" value="1" name="show_in_app"
                                               @if($details->show_in_home) checked @endif>
                                        <label for="show_in_home">Show in Home</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-4 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_rate_cutter_offer" value="1"
                                               name="is_rate_cutter_offer"
                                               @if($details->is_rate_cutter_offer) checked @endif>
                                        <label for="show_in_home">Is Rate Cutter offer</label>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @if($errors->has('media'))
                                            <p class="text-left">
                                                <small class="danger text-muted">{{ $errors->first('media') }}</small>
                                            </p>
                                        @endif
                                        @if ($details->media)
                                            <input type="file"
                                                   id="input-file-now-custom-1"
                                                   class="dropify"
                                                   name="media"
                                                   data-default-file="{{ url('storage/' .$details->media) }}"
                                            />
                                        @else
                                            <input type="file" id="input-file-now" name="media" class="dropify"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block">
                                            <i class="ft-save"></i> Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush
@push('page-js')
    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        // Translated
        $('.dropify').dropify({
            messages: {
                'default': 'Browse for an Image to upload',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct Image file'
            }
        });
    </script>
@endpush
