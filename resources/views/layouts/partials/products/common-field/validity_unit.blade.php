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
<div class="col-md-12">
    <span><h4><strong>Validity</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

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

@php
    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

<div class="form-group col-md-6 {{ $errors->has('validity') ? ' error' : '' }} {{ ($validityType == "free_text") ? 'hidden' : '' }} validity">
    <label for="validity">Validity</label>
    <input type="number" name="validity" class="form-control validity" placeholder="Enter validity"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->validity)) ? $product->product_core->validity : old("validity") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('validity'))
        <div class="help-block">  {{ $errors->first('validity') }}</div>
    @endif
</div>

@php
    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

{{--{{ dd($product->offer_info) }}--}}

<div class="form-group col-md-6 validity_free_text {{($validityType == "free_text") ? '' : 'hidden'}}">
    <label for="validity">Validity Free Text EN</label>
    <input type="text" name="offer_info[validity_free_text_en]" class="form-control"
           placeholder="Enter validity text EN"
           value="{{ (!empty($product->offer_info['validity_free_text_en'])) ? $product->offer_info['validity_free_text_en'] : old("validity") ?? '' }}">
</div>

<div class="form-group col-md-6 validity_free_text {{($validityType == "free_text") ? '' : 'hidden'}}">
    <label for="validity">Validity Free Text BN</label>
    <input type="text" name="offer_info[validity_free_text_bn]" class="form-control"
           placeholder="Enter validity text BN"
           value="{{ (!empty($product->offer_info['validity_free_text_bn'])) ? $product->offer_info['validity_free_text_bn'] : old("validity") ?? '' }}">
</div>

