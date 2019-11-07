@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
    <label for="minute_volume" class="required">Minute Volume</label>
    <input type="text" name="offer_info[minute_volume]"  class="form-control" placeholder="Enter minute volume"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['minute_volume'])) ? $offerInfo['minute_volume'] : old("offer_info.minute_volume") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('minute_volume'))
        <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
    <label for="duration_category_id" class="required">Duration Type</label>
    <select class="form-control required" name="offer_info[duration_category_id]"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Duration Type---</option>
        @foreach($durations as $value)
            <option value="{{ $value->id }}" {{ $value->id == $offertype ? 'selected' : '' }}>{{ $value->name_en }}</option> {{--{{ !empty($value == $product->duration_category_id) ? 'selected' : '' }}--}}
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('duration_category_id'))
        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
    <label for="validity_days" class="required">Validity Days</label>
    <input type="number" name="offer_info[validity_days]"  class="form-control" placeholder="Enter validity days"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($offerInfo['validity_days'])) ? $offerInfo['validity_days'] : old("offer_info.validity_days") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('validity_days'))
        <div class="help-block">  {{ $errors->first('validity_days') }}</div>
    @endif
</div>
