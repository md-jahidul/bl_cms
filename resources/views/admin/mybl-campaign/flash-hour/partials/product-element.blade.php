<slot data-repeater-list="group-a" data-repeater-item>
{{--    {{ !$product->checkCampaignProductExpire() }}--}}
{{--    @if(isset($product) && !$product->checkCampaignProductExpire())--}}
        <input type="hidden" name="product_id" value="{{ isset($product) ? $product->id : "" }}">
{{--    @endif--}}
    <div id="image-input" class="form-group col-md-4 mb-2">
        <div class="form-group">
            <label for="image_url">Thumbnail Image</label>
            <input type="file"
                id="image_url"
                name="thumbnail_img"
                class="dropify_image"
                data-height="77"
                data-default-file="{{ isset($product) ? asset($product->thumbnail_img) : ''}}"
                data-allowed-file-extensions="png jpg jpeg gif"/>
            <div class="help-block"></div>
            <small
                class="text-danger"> @error('icon') {{ $message }} @enderror </small>
            <small id="massage"></small>
        </div>
    </div>
    <div class="form-group col-md-4 mb-2">
        <label for="desc_en" class="required">Description En</label>
        <textarea rows="3" id="desc_en" {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'readonly' : '' }}
                  name="desc_en" class="form-control @error('desc_en') is-invalid @enderror"
                  placeholder="Enter description in English">{{ isset($product) ? $product->desc_en : old('desc_en') }}</textarea>
        <small class="text-danger"> @error('desc_en') {{ $message }} @enderror </small>
        <div class="help-block"></div>
    </div>

    <div class="form-group col-md-4 mb-2">
        <label for="desc_bn" class="required">Description Bn</label>
        <textarea rows="3" id="desc_bn" {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'readonly' : '' }}
                  name="desc_bn"
                  class="form-control @error('desc_bn') is-invalid @enderror"
                  placeholder="Enter description in Bangla">{{ isset($product) ? $product->desc_bn : old('desc_bn') }}</textarea>
        <small class="text-danger"> @error('desc_bn') {{ $message }} @enderror </small>
        <div class="help-block"></div>
    </div>
    @php
        $productType = '<span class="text-success">(Prepaid) </span>'
    @endphp
    <div class="form-group col-md-4 mb-2" id="cta_action">
        <label for="product_code" class="required">Product Code</label>
        <input type="hidden" name="product_code" value="{{ isset($product) ? $product->product_code : null }}">
        <select id="product_code" name="product_code" {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'disabled' : '' }}
                class="browser-default custom-select product-list">
            <option value="">Select Product</option>
            @foreach ($products as $key => $value)
                <option value="{{ $value->product_code }}"
                    {{ isset($product) && $product->product_code == $value->product_code ? 'selected' : '' }}
                >{!! ($value->sim_type == 1 ? $productType : "(Postpaid) ") . $value->commercial_name_en . " / " . $value->product_code  !!}</option>
            @endforeach
        </select>
        <div class="help-block"></div>
    </div>

    <div class="form-group col-md-3 {{ $errors->has('start_date') ? ' error' : '' }}">
        <label for="start_date">Start Date</label>
        <div class='input-group'>
            <input type='text' class="form-control product_start_date" name="start_date"
                   placeholder="Please select start date" {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'readonly' : '' }}
                   value="{{ isset($product) ? $product->start_date : old('start_date') }}"
                   autocomplete="off"/>
        </div>
        <div class="help-block"></div>
        @if ($errors->has('start_date'))
            <div class="help-block">{{ $errors->first('start_date') }}</div>
        @endif
    </div>

    <div class="form-group col-md-3 {{ $errors->has('end_date') ? ' error' : '' }}">
        <label for="end_date">End Date</label>
        <input type="text" name="end_date" class="form-control product_end_date"
               placeholder="Please select end date"
               {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'readonly' : '' }}
               value="{{ isset($product) ? $product->end_date : old('end_date') }}" autocomplete="off">
        <div class="help-block"></div>
        @if ($errors->has('end_date'))
            <div class="help-block">{{ $errors->first('end_date') }}</div>
        @endif
    </div>
    <div class="form-group col-md-2 mb-2" id="cta_action">
        <label for="redirect_url">Product Status</label>
        <select id="navigate_action" name="status"
                class="browser-default custom-select" {{ (isset($product) && $product->checkCampaignProductExpire()) ? 'disabled' : '' }}>
            <option value="">Select Status</option>
            <option class="text-success" value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Enable</option>
            <option class="text-danger" value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Disable</option>
        </select>
        <div class="help-block"></div>
    </div>

    <!-- Product Row Delete -->
    {{-- @if(isset($product) && !$product->checkCampaignProductExpire()) --}}
        <div class="form-group col-md-12 mb-1">
            <button data-repeater-delete type="button"
                    class="btn-sm btn-danger cursor-pointer float-right">
                <i class="la la-trash"></i>
            </button>
        </div>
    {{-- @endif --}}
    <div class="form-group col-md-12 mb-2" id="cta_action">
        {!! (isset($product) && $product->checkCampaignProductExpire()) ? "<b class='text-danger'>(This product is expired. You can't change anymore)</b>" : '' !!}
    </div>
    <div class="form-actions col-md-12 mt-0 text-danger"></div>
</slot>

