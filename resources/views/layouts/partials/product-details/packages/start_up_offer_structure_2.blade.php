
@include('layouts.partials.product-details.common-field.details')

<div class="form-group col-md-6 {{ $errors->has('additional_details_en') ? ' error' : '' }}">
    <label for="additional_details_en">Additional Details (English)</label>
    <textarea name="other_attributes[additional_details_en]"  class="form-control" placeholder="Enter offer details in english" id="details">{{ $productDetail->product_details->other_attributes['additional_details_en'] }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_en'))
        <div class="help-block">{{ $errors->first('additional_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_bn') ? ' error' : '' }}">
    <label for="additional_details_bn">Additional Details (Bangla)</label>
    <textarea name="other_attributes[additional_details_bn]"  class="form-control" placeholder="Enter offer details in english" id="details">{{ $productDetail->product_details->other_attributes['additional_details_bn'] }}</textarea>
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
           value="{{ $productDetail->product_details->other_attributes['bundle_expire_en'] }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_en'))
        <div class="help-block">{{ $errors->first('bundle_expire_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_bn') ? ' error' : '' }}">
    <label for="bundle_expire_bn">After Bundle Expires (Bangla)</label>
    <input type="text" name="other_attributes[bundle_expire_bn]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['bundle_expire_bn'] }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_bn'))
        <div class="help-block">{{ $errors->first('bundle_expire_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('recharge_benefits_en') ? ' error' : '' }}">
    <label for="recharge_benefits_en">Recharge Benefits Info (English)</label>
    <input name="other_attributes[recharge_benefits_en]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['recharge_benefits_en'] }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('recharge_benefits_en'))
        <div class="help-block">{{ $errors->first('recharge_benefits_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('recharge_benefits_bn') ? ' error' : '' }}">
    <label for="recharge_benefits_bn">Recharge Benefits Info (Bangla)</label>
    <input name="other_attributes[recharge_benefits_bn]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['recharge_benefits_bn'] }}" id="details">
    <div class="help-block"></div>
    @if ($errors->has('recharge_benefits_bn'))
        <div class="help-block">{{ $errors->first('recharge_benefits_bn') }}</div>
    @endif
</div>

<div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
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
