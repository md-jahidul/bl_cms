@php
    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('validity') ? ' error' : '' }} {{ ($validityType == "bill_period") ? 'hidden' : '' }}" id="validity">
    <label for="validity">Validity</label>
    <input type="number" name="validity" class="form-control validity" placeholder="Enter validity"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->validity)) ? $product->product_core->validity : old("validity") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('validity'))
        <div class="help-block">  {{ $errors->first('validity') }}</div>
    @endif
</div>

