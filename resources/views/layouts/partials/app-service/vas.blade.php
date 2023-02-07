@include('layouts.partials.app-service.common-field.validity-unit')
@include('layouts.partials.app-service.common-field.price')
@include('layouts.partials.app-service.common-field.tag')

{{--@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgTwo', 'showImg' => 'imgShowTwo'])--}}

<div class="form-group col-md-6 {{ $errors->has('provider_url') ? ' error' : '' }}">
    <label for="provider_url" class="required">Subscription Vendor</label>
    <select class="form-control required" name="provider_url"
            required data-validation-required-message="Please select vendor">
        <option value="">---Select Vendor---</option>
        @foreach($vasVendorList as $vendor)
            <option value="{{ $vendor->end_point_url }}" {{ !empty($appServiceProduct->provider_url) == $vendor->end_point_url ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('provider_url'))
        <div class="help-block">{{ $errors->first('provider_url') }}</div>
    @endif
</div>

<div class="form-group col-md-6">
    <label for="ussd_en">USSD Code (English)</label>
    <input type="text" name="ussd_en" id="ussd_en" class="form-control" placeholder="Enter offer ussd code in English"
           value="{{ !empty($appServiceProduct->ussd_en) ? $appServiceProduct->ussd_en : null }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="ussd_bn">USSD Code (Bangla)</label>
    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
     value="{{ !empty($appServiceProduct->ussd_Bn) ? $appServiceProduct->ussd_Bn : null }}">
</div>

<div class="form-group col-md-6 ">
    <label for="subscribe_text_en">Subscribe Text (English)</label>
    <input type="text" name="subscribe_text_en" class="form-control" placeholder="Enter subscribe text in English"
     value="{{ !empty($appServiceProduct->subscribe_text_en) ? $appServiceProduct->subscribe_text_en : null }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="subscribe_text_bn">Subscribe Text (Bangla)</label>
    <input type="text" name="subscribe_text_bn" class="form-control" placeholder="Enter subscribe text in Bangla"
     value="{{ !empty($appServiceProduct->subscribe_text_bn) ? $appServiceProduct->subscribe_text_bn : null }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="send_to">Send To Number</label>
    <input type="text" name="send_to" class="form-control" placeholder="Enter send to number"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ !empty($appServiceProduct->send_to) ? $appServiceProduct->send_to : null }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="dial_code">Dial Code</label>
    <input type="text" name="dial_code" class="form-control" placeholder="Enter dial code"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ !empty($appServiceProduct->dial_code) ? $appServiceProduct->dial_code : null }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="web_link">Web Link</label>
    <input type="url" name="web_link" class="form-control" placeholder="Enter web link"
{{--           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"--}}
           value="{{ !empty($appServiceProduct->web_link) ? $appServiceProduct->web_link : null }}">
    <div class="help-block"></div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="can_active" class="mr-1">Show Active Button:</label>
        <input type="checkbox" name="can_active" value="1" id="can_active" {{ (isset($appServiceProduct) && ($appServiceProduct->can_active == 1)) ? 'checked' : '' }}>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="show_in_vas" class="mr-1">Show In VAS Tab:</label>
        @if(isset($appServiceProduct))
            <input type="checkbox" name="show_in_vas" value="1" id="show_in_vas"
                {{ (isset($appServiceProduct) && ($appServiceProduct->show_in_vas == 1) ? 'checked' : '')  }}>
        @else
            <input type="checkbox" name="show_in_vas" value="1" id="show_in_vas" checked>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="show_ussd" class="mr-1">Show USSD:</label>
        <input type="checkbox" name="show_ussd" value="1" id="show_ussd" {{ (isset($appServiceProduct->show_ussd) && ($appServiceProduct->show_ussd == 1)) ? 'checked' : '' }} >
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="show_subscribe" class="mr-1">Show Subscribe Text:</label>
        <input type="checkbox" name="show_subscribe" value="1" id="show_subscribe" {{ isset($appServiceProduct->show_subscribe) && ($appServiceProduct->show_subscribe == 1) ? 'checked' : '' }} >
    </div>
</div>
