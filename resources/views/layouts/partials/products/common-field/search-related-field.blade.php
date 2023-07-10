<div class="col-md-12">
    <span><h4><strong>SEO Part</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('url_slug') ? ' error' : '' }}">
    <label> URL EN (url slug)<span class="text-danger">*</span></label>
    <input type="text" class="form-control slug-convert" value="{{ isset($product->url_slug) ? $product->url_slug : null }}" required name="url_slug" placeholder="URL English">
    <small class="text-info">
        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces and slash)<br>
    </small>
</div>

<div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
    <label> URL BN (url slug)<span class="text-danger">*</span></label>
    <input type="text" class="form-control" value="{{ isset($product->url_slug_bn) ? $product->url_slug_bn : null }}" required name="url_slug_bn" placeholder="URL Bangla">
    <small class="text-info">
        <strong>i.e:</strong> ১০০০মিনিট-১৫জিবি-১০০০এসএমএস (no spaces and slash)<br>
    </small>
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header">{{ isset($product->page_header) ? $product->page_header : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header Bangla (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($product->page_header_bn) ? $product->page_header_bn : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Schema Markup</label>
    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($product->schema_markup) ? $product->schema_markup : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> JSON-LD (Recommended by Google)
    </small>
</div>


