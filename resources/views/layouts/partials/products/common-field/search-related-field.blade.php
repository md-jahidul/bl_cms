<div class="form-group col-md-12 {{ $errors->has('banner_image_url') ? ' error' : '' }}">
    <label> URL (url slug) <span class="text-danger">*</span></label>
    <input type="text" class="form-control" value="{{ isset($product->url_slug) ? $product->url_slug : null }}" required name="url_slug" placeholder="URL">
    <small class="text-info">
        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
    </small>
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header">{{ isset($product->page_header) ? $product->page_header : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header Bangla (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($product->page_header_bn) ? $product->page_header_bn : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Schema Markup</label>
    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($product->schema_markup) ? $product->schema_markup : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> JSON-LD (Recommended by Google)
    </small>
</div>


