@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

    <div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
        <label for="internet_volume_mb" class="required">Internet Volume (MB)</label>
        <input type="number" name="offer_info[internet_volume_mb]"  class="form-control" placeholder="Enter internet volume in MB"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['internet_volume_mb'])) ? $offerInfo['internet_volume_mb'] : old("offer_info.internet_volume_mb") ?? '' }}"
               required data-validation-required-message="Enter view list button label bangla ">
        <div class="help-block"></div>
        @if ($errors->has('internet_volume_mb'))
            <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
        @endif
    </div>


    <div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
        <label for="duration_category_id" class="required">Duration Type</label>
        <select class="form-control required duration_categories" name="offer_info[duration_category_id]"
                required data-validation-required-message="Please select offer">
            <option value="">---Select Duration Type---</option>
            @foreach($durations as $value)
                <option data-days="{{ $value->days }}" data-alias="{{ $value->alias }}" value="{{ $value->id }}" {{ $value->id == $offertype ? 'selected' : '' }}>{{ $value->name_en }}</option>
            @endforeach
        </select>
        <div class="help-block"></div>
        @if ($errors->has('duration_category_id'))
            <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
        <label for="validity_days" class="required">Validity (Days)</label>
        <input type="number" name="offer_info[validity_days]"  class="form-control validity_days" placeholder="Enter validity in days"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['validity_days'])) ? $offerInfo['validity_days'] : old("offer_info.validity_days") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('validity_days'))
            <div class="help-block">  {{ $errors->first('validity_days') }}</div>
        @endif
    </div>


