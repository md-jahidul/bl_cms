<div class="form-group col-md-6 {{ $errors->has('validity') ? ' error' : '' }}">
    <label for="validity">Validity Days</label>
    <input type="number" name="validity" class="form-control validity" placeholder="Enter validity days"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->validity)) ? $product->product_core->validity : old("validity") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('validity'))
        <div class="help-block">  {{ $errors->first('validity') }}</div>
    @endif
</div>
