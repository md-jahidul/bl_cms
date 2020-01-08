<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en">{{ (isset($title_en)) ? $title_en : 'Offer Details (English)' }}</label>
    <textarea type="text" name="offer_details_en"  class="form-control" placeholder="Enter offer details in English" id="details">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn">{{ (isset($title_bn)) ? $title_bn : 'Offer Details (Bangla)' }}</label>
    <textarea type="text" name="offer_details_bn"  class="form-control tinymce" placeholder="Enter offer details in English" id="details">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>
