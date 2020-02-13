<div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
    <label for="details_en" >Details (English)</label>
    <textarea type="text" name="details_en"  class="form-control" placeholder="Enter short details in english" id="details"
              required data-validation-required-message="Enter short details in english">{{ $productDetail->product_details->details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_en'))
        <div class="help-block">{{ $errors->first('details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
    <label for="details_bn">Details (Bangla)</label>
    <textarea type="text" name="details_bn"  class="form-control" placeholder="Enter short details in bangla" id="details"
              required data-validation-required-message="Enter short details in bangla">{{ $productDetail->product_details->details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_bn'))
        <div class="help-block">{{ $errors->first('details_bn') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('ft_recharge_detail_en') ? ' error' : '' }}">
    <label for="ft_recharge_detail_en" >Details of First-time Recharge (English)</label>
    <textarea type="text" name="other_attributes[ft_recharge_detail_en]"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($otherAttributes['ft_recharge_detail_en']) ? $otherAttributes['ft_recharge_detail_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_detail_en'))
        <div class="help-block">{{ $errors->first('ft_recharge_detail_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('ft_recharge_detail_bn') ? ' error' : '' }}">
    <label for="ft_recharge_detail_bn" >Details of First-time Recharge (Bangla)</label>
    <textarea type="text" name="other_attributes[ft_recharge_detail_bn]"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($otherAttributes['ft_recharge_detail_bn']) ? $otherAttributes['ft_recharge_detail_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('ft_recharge_detail_bn'))
        <div class="help-block">{{ $errors->first('ft_recharge_detail_bn') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('one_gb_detail_en') ? ' error' : '' }}">
    <label for="offer_details_en" >Details of 1GB Every Month (English)</label>
    <textarea type="text" name="other_attributes[one_gb_detail_en]"  class="form-control"
              placeholder="Enter offer details in english"
              id="details">{{ !empty($otherAttributes['one_gb_detail_en']) ? $otherAttributes['one_gb_detail_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('one_gb_detail_en'))
        <div class="help-block">{{ $errors->first('one_gb_detail_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('one_gb_detail_bn') ? ' error' : '' }}">
    <label for="one_gb_detail_bn" >Details of 1GB Every Month (Bangla)</label>
    <textarea type="text" name="other_attributes[one_gb_detail_bn]"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($otherAttributes['one_gb_detail_bn']) ? $otherAttributes['one_gb_detail_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('one_gb_detail_bn'))
        <div class="help-block">{{ $errors->first('one_gb_detail_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('extra_validity_details_en') ? ' error' : '' }}">
    <label for="extra_validity_details_en" >Extra validity offers Details (English)</label>
    <textarea type="text" name="other_attributes[extra_validity_details_en]"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($otherAttributes['extra_validity_details_en']) ? $otherAttributes['extra_validity_details_en'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('extra_validity_details_en'))
        <div class="help-block">{{ $errors->first('extra_validity_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" >Extra validity offers Details (Bangla)</label>
    <textarea type="text" name="other_attributes[extra_validity_details_bn]"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($otherAttributes['extra_validity_details_bn']) ? $otherAttributes['extra_validity_details_bn'] : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" >Offers Details (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($productDetail->product_details->offer_details_en) ? $productDetail->product_details->offer_details_en : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" >Offers Details (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ !empty($productDetail->product_details->offer_details_bn) ? $productDetail->product_details->offer_details_bn : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>



