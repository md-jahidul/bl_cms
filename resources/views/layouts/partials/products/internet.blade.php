    <div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
        <label for="internet_volume_mb" class="required">Internet Volume</label>
        <input type="text" name="offer_info[internet_volume_mb]"  class="form-control" placeholder="Enter view list button label bangla "
               value="{{ (!empty($offerInfo['internet_volume_mb'])) ? $offerInfo['internet_volume_mb'] : old("offer_info.internet_volume_mb") ?? '' }}"
               required data-validation-required-message="Enter view list button label bangla ">
        <div class="help-block"></div>
        @if ($errors->has('internet_volume_mb'))
            <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
        @endif
    </div>


    <div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">
        <label for="duration_category_id" class="required">Duration Type</label>
        <select class="form-control required" name="offer_info[duration_category_id]"
                required data-validation-required-message="Please select offer">
            <option value="">---Select Duration Type---</option>
            @foreach($durations as $value)
                <option value="{{ $value->id }}" {{ $value->id == !empty($product->offer_info['duration_category_id']) ? 'selected' : '' }}>{{ $value->name }}</option>
            @endforeach
        </select>
        <div class="help-block"></div>
        @if ($errors->has('duration_category_id'))
            <div class="help-block">{{ $errors->first('duration_category_id') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('validity_days') ? ' error' : '' }}">
        <label for="validity_days" class="required">Validity Days</label>
        <input type="text" name="offer_info[validity_days]"  class="form-control" placeholder="Enter view list url"
               value="{{ (!empty($offerInfo['validity_days'])) ? $offerInfo['validity_days'] : old("offer_info.validity_days") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('validity_days'))
            <div class="help-block">  {{ $errors->first('validity_days') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('inspiration_quote_en') ? ' error' : '' }}">
        <label for="inspiration_quote_en" class="required">Inspiration Quote English</label>
        <input type="text" name="offer_info[inspiration_quote_en]"  class="form-control" placeholder="Enter view list url"
               value="{{ (!empty($offerInfo['inspiration_quote_en'])) ? $offerInfo['inspiration_quote_en'] : old("offer_info.inspiration_quote_en") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('inspiration_quote_en'))
            <div class="help-block">  {{ $errors->first('inspiration_quote_en') }}</div>
        @endif
    </div>

    <div class="form-group col-md-12 {{ $errors->has('inspiration_quote_bn') ? ' error' : '' }}">
        <label for="inspiration_quote_bn" class="required">Inspiration Quote Bangla</label>
        <input type="text" name="offer_info[inspiration_quote_bn]"  class="form-control" placeholder="Enter view list url"
               value="{{ (!empty($offerInfo['inspiration_quote_bn'])) ? $offerInfo['inspiration_quote_bn'] : old("offer_info.inspiration_quote_bn") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('inspiration_quote_bn'))
            <div class="help-block">  {{ $errors->first('inspiration_quote_bn') }}</div>
        @endif
    </div>

