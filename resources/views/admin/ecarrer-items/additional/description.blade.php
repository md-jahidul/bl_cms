<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (English)</label>
        <textarea name="description_en" class="form-control" rows="5"
                  placeholder="Enter description">{{ isset($ecarrer_item->description_en) ? $ecarrer_item->description_en : '' }}</textarea>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="exampleInputPassword1">Description (Bangla)</label>
        <textarea name="description_bn" class="form-control" rows="5"
                  placeholder="Enter description">{{ isset($ecarrer_item->description_bn) ? $ecarrer_item->description_bn : '' }}</textarea>
    </div>
</div>