<div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
    <label for="description_en" class="required">Description (English)</label>
    <textarea type="text" name="offer_info[description_en]"  class="form-control"
              placeholder="Enter description in english">{{ (!empty($product->offer_info['description_en'])) ? $product->offer_info['description_en'] : old("offer_info.description_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_en'))
        <div class="help-block">  {{ $errors->first('description_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn" class="required">Description (Bangla)</label>
    <textarea type="text" name="offer_info[description_bn]"  class="form-control"
              placeholder="Enter description in Bangla">{{ (!empty($product->offer_info['description_bn'])) ? $product->offer_info['description_bn'] : old("offer_info.description_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>


