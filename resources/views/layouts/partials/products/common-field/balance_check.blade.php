<div class="form-group col-md-6 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">
    <label for="balance_check_ussd">Balance Check</label>
    <input type="text" name="balance_check_ussd" class="form-control balance_check_ussd" placeholder="Enter balance check USSD"
           {{--oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"--}}
           value="{{ (!empty($product->product_core->balance_check_ussd)) ? $product->product_core->balance_check_ussd : old("balance_check_ussd") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('balance_check_ussd'))
        <div class="help-block">  {{ $errors->first('balance_check_ussd') }}</div>
    @endif
</div>
