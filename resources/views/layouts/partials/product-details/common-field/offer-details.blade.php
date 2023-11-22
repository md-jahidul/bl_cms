


<div class="form-group col-md-6 {{ $errors->has('offer_details_title_en') ? ' error' : '' }}">
    <label for="offer_details_title_en" >Offer Breakdown (English)</label>
    <input type="text" name="offer_details_title_en"
           value="{{ !empty($productDetail->product_details['offer_details_title_en']) ? $productDetail->product_details['offer_details_title_en'] : '' }}"
           class="form-control" placeholder="Enter details of first-time recharge in English">
    <div class="help-block"></div>
    @if ($errors->has('offer_details_title_en'))
        <div class="help-block">{{ $errors->first('offer_details_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_title_bn') ? ' error' : '' }}">
    <label for="offer_details_title_bn" >Offer Breakdown (Bangla)</label>
    <input type="text" name="offer_details_title_bn"  class="form-control" placeholder="Enter first-time recharge title in English"
           value="{{ !empty($productDetail->product_details['offer_details_title_bn']) ? $productDetail->product_details['offer_details_title_bn'] : '' }}" >
    <div class="help-block"></div>
    @if ($errors->has('offer_details_title_bn'))
        <div class="help-block">{{ $errors->first('offer_details_title_bn') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('offer_details_en') ? ' error' : '' }}">
    <label for="offer_details_en">{{ (isset($title_en)) ? $title_en : 'Offer Details (English)' }}</label>
    <textarea type="text" name="offer_details_en"  class="form-control summernote_editor" placeholder="Enter offer details in English">{{ $productDetail->product_details->offer_details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_en'))
        <div class="help-block">{{ $errors->first('offer_details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_details_bn') ? ' error' : '' }}">
    <label for="offer_details_bn">{{ (isset($title_bn)) ? $title_bn : 'Offer Details (Bangla)' }}</label>
    <textarea type="text" name="offer_details_bn"  class="form-control summernote_editor" placeholder="Enter offer details in English">{{ $productDetail->product_details->offer_details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('offer_details_bn'))
        <div class="help-block">{{ $errors->first('offer_details_bn') }}</div>
    @endif
</div>
