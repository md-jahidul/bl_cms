
<div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
    <label for="details_en" class="required">Details (English)</label>
    <textarea type="text" name="details_en"  class="form-control" placeholder="Enter short details in english" id="details"
              required data-validation-required-message="Enter short details in english">{{ $productDetail->product_details->details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_en'))
        <div class="help-block">{{ $errors->first('details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
    <label for="details_bn" class="required">Details (Bangla)</label>
    <textarea type="text" name="details_bn"  class="form-control" placeholder="Enter short details in bangla" id="details"
              required data-validation-required-message="Enter short details in bangla">{{ $productDetail->product_details->details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_bn'))
        <div class="help-block">{{ $errors->first('details_bn') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Details of First-time Recharge (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Details of First-time Recharge (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Offer Details (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Offer Details (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Details of 1GB Every Month (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Details of 1GB Every Month (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Extra validity offers (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Extra validity offers Month (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en" class="required">Offers Details (English)</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn" class="required">Offers Details (Bangla)</label>
    <textarea type="text" name="offer_details_bn"  class="form-control" placeholder="Enter offer details in english"
              required data-validation-required-message="Enter offer details in english" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>



