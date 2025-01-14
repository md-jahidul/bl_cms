<div class="col-md-12 col-xs-6">
    <h3><strong>Item 1</strong></h3>
    <hr class="item-line">
</div>

<input id="multi_item_count" type="hidden" name="multi_item_count" value="1">

<div class="col-md-6 col-xs-6">
    <div class="form-group">
        <label for="message">Image</label>
        <input type="file" class="dropify" name="multi_item[image_url-1]" data-height="80"/>
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>

<div class="form-group col-md-5">
    <label for="alt_text">Alt Text</label>
    <input type="text" name="multi_item[alt_text-1]" class="form-control">
</div>

<div class="form-group col-md-1">
    <label for="alt_text"></label>
    <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
</div>
