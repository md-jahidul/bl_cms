@php
    if (isset($product->product->offer_info['duration_category_id'])){
        $offertype = $product->product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
    <label for="duration_category_id" class="required">Duration Type</label>
    <select class="form-control required duration_categories" name="offer_info[duration_category_id]"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Duration Type---</option>
        @foreach($durations as $value)
            <option data-days="{{ $value->days }}" data-alias="{{ $value->alias }}" value="{{ $value->id }}" {{ $value->id == $offertype ? 'selected' : '' }}>{{ $value->name_en }}</option> {{--{{ !empty($value == $product->duration_category_id) ? 'selected' : '' }}--}}
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('duration_category_id'))
        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume" class="required">Minute Volume</label>
    <input type="text" name="minute_volume"  class="form-control" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->minute_volume)) ? $product->minute_volume : old("minute_volume") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('product_validity') ? ' error' : '' }}">
    <label for="product_validity" class="required">Validity Days</label>
    <input type="number" name="product_validity"  class="form-control product_validity" placeholder="Enter validity days" id="product_validity"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_validity)) ? $product->product_validity : old("product_validity") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('product_validity'))
        <div class="help-block">  {{ $errors->first('product_validity') }}</div>
    @endif
</div>
