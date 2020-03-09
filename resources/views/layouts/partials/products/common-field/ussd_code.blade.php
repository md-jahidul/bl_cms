<div class="form-group col-md-6">
    <label for="activation_ussd">USSD Code (English)</label>
    <input type="text" name="activation_ussd" id="activation_ussd" class="form-control" placeholder="Enter offer ussd code in English"
           value="{{ old("activation_ussd") ? old("activation_ussd") : '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="ussd_bn">USSD Code (Bangla)</label>
    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
           value="{{ old("ussd_bn") ? old("ussd_bn") : '' }}">
</div>
