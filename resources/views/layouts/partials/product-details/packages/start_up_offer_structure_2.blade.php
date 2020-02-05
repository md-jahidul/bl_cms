
@include('layouts.partials.product-details.common-field.details')

<div class="form-group col-md-6 {{ $errors->has('additional_details_en') ? ' error' : '' }}">
    <label for="additional_details_en">Additional Details (English)</label>
    <textarea name="other_attributes[additional_details_en]"  class="form-control" placeholder="Enter offer details in english"
     id="details">{{ !empty($productDetail->product_details->other_attributes['additional_details_en']) ? $productDetail->product_details->other_attributes['additional_details_en'] : ''  }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_en'))
        <div class="help-block">{{ $errors->first('additional_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_bn') ? ' error' : '' }}">
    <label for="additional_details_bn">Additional Details (Bangla)</label>
    <textarea name="other_attributes[additional_details_bn]"  class="form-control" placeholder="Enter offer details in english"
              id="details">{{ !empty($productDetail->product_details->other_attributes['additional_details_bn']) ? $productDetail->product_details->other_attributes['additional_details_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_bn'))
        <div class="help-block">{{ $errors->first('additional_details_bn') }}</div>
    @endif
</div>

@include('layouts.partials.product-details.common-field.offer-details',
            [
                'title_en' => "Conditions (English)",
                'title_bn' => 'Conditions (Bangla)'
            ])

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_en') ? ' error' : '' }}">
    <label for="bundle_expire_en">After Bundle Expires (English)</label>
    <input type="text" name="other_attributes[bundle_expire_en]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ !empty($productDetail->product_details->other_attributes['bundle_expire_en']) ? $productDetail->product_details->other_attributes['bundle_expire_en'] : '' }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_en'))
        <div class="help-block">{{ $errors->first('bundle_expire_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_bn') ? ' error' : '' }}">
    <label for="bundle_expire_bn">After Bundle Expires (Bangla)</label>
    <input type="text" name="other_attributes[bundle_expire_bn]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ !empty($productDetail->product_details->other_attributes['bundle_expire_bn']) ? $productDetail->product_details->other_attributes['bundle_expire_bn'] : '' }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_bn'))
        <div class="help-block">{{ $errors->first('bundle_expire_bn') }}</div>
    @endif
</div>

{{--<div class="form-group col-md-6">--}}
{{--    <label for="ussd">Recharge Benefits Offer</label>--}}
{{--    <select class="select2 form-control">--}}
{{--        @foreach($products as $product)--}}
{{--            @if($product->purchase_option == "recharge")--}}
{{--                <option value="{{$product->product_code}}">{{ $product->product_code }}</option>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--</div>--}}

