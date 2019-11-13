@php

    if (isset($product->offer_info['other_offer_type_id'])){
        $offertype = $product->offer_info['other_offer_type_id'];
    }elseif (isset($product->offer_info['package_offer_type_id'])){
        $offertype = $product->offer_info['package_offer_type_id'];
    }

    isset($offertype) ? $offertype : $offertype = '';

    isset($product->offer_info) ? $product : $offertype = null
@endphp

<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Other Offer Types</label>
    <select class="form-control required" name="offer_info[other_offer_type_id]" id="other_offer_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($others_offer_child as $offer)
            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}" {{ $offertype == $offer->id ? 'selected' : '' }}>{{ $offer->name_en }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>

{{--Amar Offer--}}
<slot class="{{ $offertype == 12 ? '' : 'd-none' }}" id="amar_offer">
    <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
        <label for="description_en" class="required">Description (English)</label>
        <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                  required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description_en'))
            <div class="help-block">  {{ $errors->first('description_en') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
        <label for="description_bn" class="required">Description (Bangla)</label>
        <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                  required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description_bn'))
            <div class="help-block">  {{ $errors->first('description_bn') }}</div>
        @endif
    </div>
</slot>

@if(strtolower($type) == 'prepaid')
    {{-- Balance transfer --}}
    <slot class="{{ $offertype == 10 ? '' : 'd-none' }}" id="balance_transfer">
        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>

    {{--Emergency Balance--}}
    <slot class="{{ $offertype == 11 ? '' : 'd-none' }}" id="emergency_balance">

        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>

    {{-- MFS Offers --}}
    <slot class="{{ $offertype == 18 ? '' : 'd-none' }}" id="mfs_offers">

        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>

    {{--Device Offers--}}
    <slot class="{{ $offertype == 15 ? '' : 'd-none' }}" id="device_offers">
        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>

    {{--MNP Offer--}}
    <slot class="{{ $offertype == 14 ? '' : 'd-none' }}" id="mnp_offers">
        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>

    {{--4G Offers--}}
    <slot class="{{ $offertype == 16 ? '' : 'd-none' }}" id="4g_offers">

        <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
            <label for="description_en" class="required">Description (English)</label>
            <textarea type="text" name="offer_info[description_en]"  class="form-control" placeholder="Enter description in english"
                      required data-validation-required-message="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_en'))
                <div class="help-block">  {{ $errors->first('description_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
            <label for="description_bn" class="required">Description (Bangla)</label>
            <textarea type="text" name="offer_info[description_bn]"  class="form-control" placeholder="Enter description in bangla"
                      required data-validation-required-message="Enter description in bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
            <div class="help-block"></div>
            @if ($errors->has('description_bn'))
                <div class="help-block">  {{ $errors->first('description_bn') }}</div>
            @endif
        </div>
    </slot>
@endif

{{--Bondho SIM Offer--}}
@if(strtolower($type) == 'prepaid')
    <slot class="{{ $offertype == 13 ? '' : 'd-none' }}" id="bondho_sim_offer">
        <div class="form-group col-md-6 {{ $errors->has('internet_offer_mb') ? ' error' : '' }}">
            <label for="internet_offer_mb" class="required">Internet Volume (MB)</label>
            <input type="number" name="offer_info[internet_offer_mb]"  class="form-control" placeholder="Enter internet offer in MB"
                   value="{{ (!empty($product->offer_info['internet_offer_mb'])) ? $product->offer_info['internet_offer_mb'] : old("offer_info.internet_offer_mb") ?? '' }}"
                   required data-validation-required-message="Enter view list button label bangla ">
            <div class="help-block"></div>
            @if ($errors->has('internet_offer_mb'))
                <div class="help-block">  {{ $errors->first('internet_offer_mb') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
            <label for="minute_offer" class="required">Minute Volume</label>
            <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
                   oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                   value="{{ (!empty($product->offer_info['minute_offer'])) ? $product->offer_info['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
                   required data-validation-required-message="Enter view list url">
            <div class="help-block"></div>
            @if ($errors->has('minute_offer'))
                <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
            @endif
        </div>
    </slot>
@endif




