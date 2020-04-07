@php
    $validityUnits = ['hour', 'hours', 'day', 'days'];

    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
    <label for="duration_category_id" class="required validity_unit">Validity Unit</label>
    <select class="form-control required duration_categories" name="validity_unit" id="validity_unit">
        <option value="">---Select Validity Unit---</option>
        @foreach($validityUnits as $value)
            <option value="{{ $value }}" {{ $value == $validityType ? 'selected' : '' }}>{{ ucfirst($value) }}</option>
        @endforeach
{{--        TODO:: Duration Category Rework --}}
{{--        @foreach($durations as $value)--}}
{{--            <option data-days="{{ $value->days }}" data-alias="{{ $value->alias }}" value="{{ $value->id }}" {{ $value->id == $offertype ? 'selected' : '' }}>{{ $value->name_en }}</option>--}}
{{--        @endforeach--}}
    </select>
    <div class="help-block"></div>
    @if ($errors->has('duration_category_id'))
        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
    @endif
</div>

