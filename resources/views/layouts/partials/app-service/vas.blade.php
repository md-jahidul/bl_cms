
@include('layouts.partials.app-service.common-field.tag')

@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgTwo', 'showImg' => 'imgShowTwo'])

<div class="form-group col-md-6">
    <label for="ussd_en">USSD Code (English)</label>
    <input type="text" name="ussd_en" id="ussd_en" class="form-control" placeholder="Enter offer ussd code in English"
           value="{{ old("ussd_en") ? old("ussd_en") : '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="ussd_bn">USSD Code (Bangla)</label>
    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
     value="{{ old("ussd_bn") ? old("ussd_bn") : '' }}">
</div>

<div class="form-group col-md-6 ">
    <label for="subscribe_text_en">Subscribe Text (English)</label>
    <input type="text" name="subscribe_text_en" class="form-control" placeholder="Enter subscribe text in English"
     value="{{ old("subscribe_text_en") ? old("subscribe_text_en") : '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="subscribe_text_bn">Subscribe Text (Bangla)</label>
    <input type="text" name="subscribe_text_bn" class="form-control" placeholder="Enter subscribe text in Bangla"
     value="{{ old("subscribe_text_bn") ? old("subscribe_text_bn") : '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="send_to">Send To Number</label>
    <input type="text" name="send_to" class="form-control" placeholder="Enter send to number"
           value="{{ old("send_to") ? old("send_to") : '' }}">
    <div class="help-block"></div>
</div>
