<div class="form-group col-md-6 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">
    <label for="balance_check_ussd">Balance Check And App Visit (English)</label>
    <textarea type="text" name="balance_check_ussd" class="form-control balance_check_ussd summernote_editor" placeholder="Enter balance check USSD in English"
    >{{ (!empty($product->product_core->balance_check_ussd)) ? $product->product_core->balance_check_ussd : old("balance_check_ussd") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('balance_check_ussd'))
        <div class="help-block">  {{ $errors->first('balance_check_ussd') }}</div>
    @endif
</div>
{{--{{ dd($product) }}--}}
<div class="form-group col-md-6 {{ $errors->has('balance_check_ussd_bn') ? ' error' : '' }}">
    <label for="balance_check_ussd_bn">Balance Check And App Visit (Bangla)</label>
    <textarea type="text" name="balance_check_ussd_bn" class="form-control balance_check_ussd_bn summernote_editor" placeholder="Enter balance check USSD in Bangla"
    >{{ (!empty($product->balance_check_ussd_bn)) ? $product->balance_check_ussd_bn : old("balance_check_ussd_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('balance_check_ussd_bn'))
        <div class="help-block">  {{ $errors->first('balance_check_ussd_bn') }}</div>
    @endif
</div>
