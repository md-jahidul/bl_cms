@php
    $validityUnits = [
        'hour'  => 'Hour',
        'hours' => 'Hours',
        'day'   => 'Day',
        'days'  => 'Days',
        'month'  => 'Month',
        'months'  => 'Months',
        'year'  => 'Year',
        'years'  => 'Years',
        'free_text' => 'Free Text'
    ];

    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
    <label for="duration_category_id" class="validity_unit">Validity Unit</label>
    <select class="form-control required duration_categories validity_unit" name="validity_unit">
        <option value="">---Select Validity Unit---</option>
        @foreach($validityUnits as $key => $value)
            <option value="{{ $key }}" {{ $key == $validityType ? 'selected' : '' }}>{{ $value }}</option>
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

