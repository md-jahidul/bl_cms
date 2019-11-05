<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Other Offer Types</label>
    <select class="form-control required" name="offer_info[other_offer_id]" id="other_offer_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($others_offer_child as $offer)
            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>

{{-- Balance transfer || Amar Offer || Device Offers || MNP Offer || 4G Offers--}}
<slot class="d-none" id="amar_offer">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>

<slot class="d-none" id="balance_transfer">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>


<slot class="d-none" id="emergency_balance">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>

<slot class="d-none" id="device_offers">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>

<slot class="d-none" id="mnp_offers">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>

<slot class="d-none" id="4g_offers">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Title</label>
        <input type="text" name="offer_info[title]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['title'])) ? $offerInfo['title'] : old("offer_info.title") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('description') ? ' error' : '' }}">
        <label for="description" class="required">Description</label>
        <textarea type="text" name="offer_info[description]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['description'])) ? $offerInfo['description'] : old("offer_info.description") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('description'))
            <div class="help-block">  {{ $errors->first('description') }}</div>
        @endif
    </div>
</slot>




{{--Bondho SIM Offer--}}
@if(strtolower($type) == 'prepaid')
    <slot class="d-none" id="bondho_sim_offer">
        <div class="form-group col-md-6 {{ $errors->has('internet_offer_mb') ? ' error' : '' }}">
            <label for="internet_offer_mb" class="required">Internet Volume (MB)</label>
            <input type="number" name="offer_info[internet_offer_mb]"  class="form-control" placeholder="Enter internet offer in MB"
                   value="{{ (!empty($offerInfo['internet_offer_mb'])) ? $offerInfo['internet_offer_mb'] : old("offer_info.internet_offer_mb") ?? '' }}"
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
                   value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
                   required data-validation-required-message="Enter view list url">
            <div class="help-block"></div>
            @if ($errors->has('minute_offer'))
                <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
            @endif
        </div>
    </slot>
@endif

