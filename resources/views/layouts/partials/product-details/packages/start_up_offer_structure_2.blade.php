
<div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
    <label for="details_en" class="required">Details (English)</label>
    <textarea name="details_en"  class="form-control" placeholder="Enter short details in english" id="details"
              required data-validation-required-message="Enter short details in english">{{ $productDetail->product_details->details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_en'))
        <div class="help-block">{{ $errors->first('details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
    <label for="details_bn" class="required">Details (Bangla)</label>
    <textarea name="details_bn"  class="form-control" placeholder="Enter short details in bangla" id="details"
              required data-validation-required-message="Enter short details in bangla">{{ $productDetail->product_details->details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_bn'))
        <div class="help-block">{{ $errors->first('details_bn') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('additional_details_en') ? ' error' : '' }}">
    <label for="additional_details_en" class="required">Additional Details (English)</label>
    <textarea name="other_attributes[additional_details_en]"  class="form-control" placeholder="Enter offer details in english" id="details"
              required data-validation-required-message="Enter offer details in english">{{ $productDetail->product_details->other_attributes['additional_details_en'] }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_en'))
        <div class="help-block">{{ $errors->first('additional_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('additional_details_bn') ? ' error' : '' }}">
    <label for="additional_details_bn" class="required">Additional Details (Bangla)</label>
    <textarea name="other_attributes[additional_details_bn]"  class="form-control" placeholder="Enter offer details in english" id="details"
              required data-validation-required-message="Enter offer details in english">{{ $productDetail->product_details->other_attributes['additional_details_bn'] }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('additional_details_bn'))
        <div class="help-block">{{ $errors->first('additional_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Conditioins (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Conditioins (Bangla)</label>
    <textarea name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_en') ? ' error' : '' }}">
    <label for="bundle_expire_en" class="required">After Bundle Expires (English)</label>
    <input type="text" name="other_attributes[bundle_expire_en]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['bundle_expire_en'] }}"
           required data-validation-required-message="Enter offer details in english" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_en'))
        <div class="help-block">{{ $errors->first('bundle_expire_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('bundle_expire_bn') ? ' error' : '' }}">
    <label for="bundle_expire_bn" class="required">After Bundle Expires (Bangla)</label>
    <input type="text" name="other_attributes[bundle_expire_bn]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['bundle_expire_bn'] }}"
           required data-validation-required-message="Enter offer details in english" id="details">
    <div class="help-block"></div>
    @if ($errors->has('bundle_expire_bn'))
        <div class="help-block">{{ $errors->first('bundle_expire_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('recharge_benefits_en') ? ' error' : '' }}">
    <label for="recharge_benefits_en" class="required">Recharge Benefits Info (English)</label>
    <input name="other_attributes[recharge_benefits_en]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['recharge_benefits_en'] }}"
           required data-validation-required-message="Enter offer details in english" id="details">
    <div class="help-block"></div>
    @if ($errors->has('recharge_benefits_en'))
        <div class="help-block">{{ $errors->first('recharge_benefits_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('recharge_benefits_bn') ? ' error' : '' }}">
    <label for="recharge_benefits_bn" class="required">Recharge Benefits Info (Bangla)</label>
    <input name="other_attributes[recharge_benefits_bn]"  class="form-control" placeholder="Enter offer details in english"
           value="{{ $productDetail->product_details->other_attributes['recharge_benefits_bn'] }}"
           required data-validation-required-message="Enter offer details in english" id="details">
    <div class="help-block"></div>
    @if ($errors->has('recharge_benefits_bn'))
        <div class="help-block">{{ $errors->first('recharge_benefits_bn') }}</div>
    @endif
</div>

<div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
    <label for="role_id" class="required">Related Product</label>
    <div class="role-select">
        <select class="select2 form-control" multiple="multiple" name="related_product_id[]" required
                data-validation-required-message="Please select related product">
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
