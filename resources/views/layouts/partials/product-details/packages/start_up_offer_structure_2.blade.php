
@include('layouts.partials.product-details.common-field.details')

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

<div class="form-group col-md-6 {{ $errors->has('additional_details_title_en') ? ' error' : '' }}">
    <label for="additional_details_title_en" >Additional Details Title (English)</label>
    <input type="text" name="other_attributes[additional_details_title_en]"
           value="{{ !empty($otherAttributes['additional_details_title_en']) ? $otherAttributes['additional_details_title_en'] : '' }}"
           class="form-control" placeholder="Enter details of first-time recharge in English" id="details">
    <div class="help-block"></div>
    @if ($errors->has('additional_details_title_en'))
        <div class="help-block">{{ $errors->first('additional_details_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_title_bn') ? ' error' : '' }}">
    <label for="additional_details_title_bn" >Additional Details Title (Bangla)</label>
    <input type="text" name="other_attributes[additional_details_title_bn]"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($otherAttributes['additional_details_title_bn']) ? $otherAttributes['additional_details_title_bn'] : '' }}" >
    <div class="help-block"></div>
    @if ($errors->has('additional_details_title_bn'))
        <div class="help-block">{{ $errors->first('additional_details_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_en') ? ' error' : '' }}">
    <label for="additional_details_en">Additional Details (English)</label>
    <textarea name="other_attributes[additional_details_en]"  class="form-control summernote_editor"
              placeholder="Enter additional details in English">{{ !empty($otherAttributes['additional_details_en']) ? $otherAttributes['additional_details_en'] : ''  }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_en'))
        <div class="help-block">{{ $errors->first('additional_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_bn') ? ' error' : '' }}">
    <label for="additional_details_bn">Additional Details (Bangla)</label>
    <textarea name="other_attributes[additional_details_bn]"  class="form-control summernote_editor" placeholder="Enter additional details in Bnglish"
    >{{ !empty($otherAttributes['additional_details_bn']) ? $otherAttributes['additional_details_bn'] : '' }}</textarea>
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
    <textarea type="text" name="other_attributes[bundle_expire_en]"  class="form-control summernote_editor" placeholder="Enter After bundle expires in English"
    >{{ !empty($otherAttributes['bundle_expire_en']) ? $otherAttributes['bundle_expire_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_en'))
        <div class="help-block">{{ $errors->first('bundle_expire_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_bn') ? ' error' : '' }}">
    <label for="bundle_expire_bn">After Bundle Expires (Bangla)</label>
    <textarea type="text" name="other_attributes[bundle_expire_bn]"  class="form-control summernote_editor" placeholder="Enter After bundle expires in Bangla"
    >{{ !empty($otherAttributes['bundle_expire_bn']) ? $otherAttributes['bundle_expire_bn'] : '' }}</textarea>
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

