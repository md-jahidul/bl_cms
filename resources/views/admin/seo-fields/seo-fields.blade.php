<div class="form-group col-md-6 {{ $errors->has('url_slug_en') ? ' error' : '' }}">
    <label> URL (English) <span class="text-danger">*</span></label>
    <input type="text" name="url_slug_en" class="form-control slug-convert"
           value="{{ isset($data->url_slug_en) ? $data->url_slug_en : null }}"
           required placeholder="Enter URL in English">
    <small class="text-info">
        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
    </small>

    <div class="help-block"></div>
    @if ($errors->has('url_slug_en'))
        <div class="help-block">  {{ $errors->first('url_slug_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('url_slug_bn') ? ' error' : '' }}">
    <label> URL (Bangla) <span class="text-danger">*</span></label>
    <input type="text" name="url_slug_bn" class="form-control slug-convert"
           value="{{ isset($data->url_slug_bn) ? $data->url_slug_bn : null }}"
           required placeholder="Enter URL in Bangla">
    <small class="text-info">
        <strong>i.e:</strong> 1000Min-15GB-1000SMS (no spaces)<br>
    </small>
    <div class="help-block"></div>
    @if ($errors->has('url_slug_bn'))
        <div class="help-block">  {{ $errors->first('url_slug_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header">{{ isset($data->page_header) ? $data->page_header : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Page Header Bangla (HTML)</label>
    <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($data->page_header_bn) ? $data->page_header_bn : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> Title, meta, canonical and other tags
    </small>
</div>

<div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
    <label>Schema Markup</label>
    <textarea class="form-control" rows="7" name="schema_markup">{{ isset($data->schema_markup) ? $data->schema_markup : null }}</textarea>
    <small class="text-info">
        <strong>Note: </strong> JSON-LD (Recommended by Google)
    </small>
</div>

