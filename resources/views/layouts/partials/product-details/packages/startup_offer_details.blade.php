@php
    if (isset($productDetail->product_details->other_attributes['recharge_benefits_code'])){
        $offer = $productDetail->product_details->other_attributes['recharge_benefits_code'];
    }else{
        $offer = '';
    }

    if (isset($productDetail->product_details->other_attributes['special_product_id'])){
        $specialOffer = $productDetail->product_details->other_attributes['special_product_id'];
    }else{
        $specialOffer = '';
    }
@endphp


<slot id="structure_1" class="{!! $productDetail->product_details->other_attributes['design_structure'] == 'structure_1' ? "" : "d-none" !!}"
      data-offer-type="structure_1">
    @include('layouts.partials.product-details.packages.start_up_offer_structure_1')
    <div class="form-group select-role col-md-6 {{ $errors->has('role_id') ? ' error' : '' }}">
        <label for="role_id">Special Offer</label>
        <div class="role-select">
            <select class="select2 form-control" multiple="multiple" name="other_attributes[special_product_id][]" id="special_product_field">
                @foreach($products as $product)
                    @if($product->special_product == 1)
                        <option value="{{ $product->id }}"
                            {{ specialProductMatch($product->id, $specialOffer) ? 'selected' : '' }}
                        >{{$product->name_en}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="help-block"></div>
        @if ($errors->has('role_id'))
            <div class="help-block">  {{ $errors->first('role_id') }}</div>
        @endif
    </div>
</slot>

<slot id="structure_2" class="{!! $productDetail->product_details->other_attributes['design_structure'] == 'structure_2' ? "" : "d-none" !!}" data-offer-type="structure_2">
    <div class="form-group col-md-6 {{ $errors->has('package_title_en') ? ' error' : '' }}">
        <label for="package_title_en" >Detail Package Title (English)</label>
        <input type="text" name="other_attributes[package_title_en]"
               value="{{ !empty($otherAttributes['package_title_en']) ? $otherAttributes['package_title_en'] : '' }}"
               class="form-control" placeholder="Enter details of first-time recharge in English" id="details">
        <div class="help-block"></div>
        @if ($errors->has('package_title_en'))
            <div class="help-block">{{ $errors->first('package_title_en') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('package_title_bn') ? ' error' : '' }}">
        <label for="package_title_bn" >Detail Package Title (Bangla)</label>
        <input type="text" name="other_attributes[package_title_bn]"  class="form-control" placeholder="Enter first-time recharge title in English"
               value="{{ !empty($otherAttributes['package_title_bn']) ? $otherAttributes['package_title_bn'] : '' }}" >
        <div class="help-block"></div>
        @if ($errors->has('package_title_bn'))
            <div class="help-block">{{ $errors->first('package_title_bn') }}</div>
        @endif
    </div>


    @include('layouts.partials.product-details.packages.start_up_offer_structure_2')
    <div class="form-group col-md-6">
        <label for="ussd">Recharge Benefits Offer</label>
        <select class="form-control" name="other_attributes[recharge_benefits_code]"> {{-- class select2--}}
            <option>---Please Recharge Benefits Offer---</option>
            @foreach($products as $product)
                @if($product->purchase_option == "recharge")
                    <option value="{{$product->product_core['recharge_product_code']}}" {{ ($product->product_core['recharge_product_code'] == $offer) ? 'selected' : "" }}>{{ $product->product_core['recharge_product_code']}}</option>
                @endif
            @endforeach
        </select>
    </div>
</slot>

<div class="form-group select-role col-md-6 {{ $errors->has('role_id') ? ' error' : '' }}">
    <label for="role_id">Related Product</label>
    <div class="role-select">
        <select class="select2 form-control" multiple="multiple" name="related_product_id[]">
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ match($product->id,$productDetail->related_product) ? 'selected' : '' }}>{{$product->name_en}} </option>
            @endforeach
        </select>
    </div>
    <div class="help-block"></div>
    @if ($errors->has('role_id'))
        <div class="help-block">  {{ $errors->first('role_id') }}</div>
    @endif
</div>
