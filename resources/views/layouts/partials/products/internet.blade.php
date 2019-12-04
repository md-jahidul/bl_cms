@php
    if (isset($product->product->offer_info['duration_category_id'])){
        $offertype = $product->product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

    <div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
        <label for="internet_volume_mb" class="required">Internet Volume (MB)</label>
        <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume in MB"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($product->internet_volume_mb)) ? $product->internet_volume_mb : old("internet_volume_mb") ?? '' }}"
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

    <div class="form-group col-md-6 {{ $errors->has('product_validity') ? ' error' : '' }}">
        <label for="product_validity" class="required">Validity (Days)</label>
        <input type="number" name="product_validity"  class="form-control validity_days" placeholder="Enter validity in days"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($product->product_validity)) ? $product->product_validity : old("product_validity") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('product_validity'))
            <div class="help-block">  {{ $errors->first('product_validity') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('balance_check_ussd') ? ' error' : '' }}">
        <label for="balance_check_ussd" class="required">Balance Check</label>
        <input type="text" name="balance_check_ussd"  class="form-control" placeholder="Enter balance check USSD"
               {{--oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"--}}
               value="{{ (!empty($product->balance_check_ussd)) ? $product->balance_check_ussd : old("balance_check_ussd") ?? '' }}"
               required data-validation-required-message="Enter balance check USSD">
        <div class="help-block"></div>
        @if ($errors->has('balance_check_ussd'))
            <div class="help-block">  {{ $errors->first('balance_check_ussd') }}</div>
        @endif
    </div>


