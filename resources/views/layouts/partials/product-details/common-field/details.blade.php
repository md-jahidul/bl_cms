<div class="form-group col-md-6 {{ $errors->has('details_en') ? ' error' : '' }}">
    <label for="details_en">Details (English)</label>
    <textarea type="text" name="details_en"  class="form-control summernote_editor" placeholder="Enter short details in English" rows="5"
    >{{ $productDetail->product_details->details_en }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_en'))
        <div class="help-block">{{ $errors->first('details_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('details_bn') ? ' error' : '' }}">
    <label for="details_bn">Details (Bangla)</label>
    <textarea type="text" name="details_bn"  class="form-control summernote_editor" placeholder="Enter short details in English" rows="5">{{ $productDetail->product_details->details_bn }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('details_bn'))
        <div class="help-block">{{ $errors->first('details_bn') }}</div>
    @endif
</div>
