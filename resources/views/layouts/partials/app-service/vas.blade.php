
@include('layouts.partials.app-service.common-field.tag')

@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgTwo', 'showImg' => 'imgShowTwo'])

<div class="form-group col-md-6 {{ $errors->has('validity_unit') ? ' error' : '' }}">
    <label for="validity_unit" class="required">Subscription Vendor</label>
    <select class="form-control required" name="subscription_url"
            required data-validation-required-message="Please select vendor">
        <option value="">---Select Vendor---</option>
        @foreach($vasVendorList as $vendor)
            <option value="{{ $vendor->end_point_url }}" {{ !empty($appServiceProduct->subscription_url) == $vendor->end_point_url ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('validity_unit'))
        <div class="help-block">{{ $errors->first('validity_unit') }}</div>
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
     value="{{ !empty($appServiceProduct->ussd_bn) ? $appServiceProduct->ussd_bn : null }}">
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
