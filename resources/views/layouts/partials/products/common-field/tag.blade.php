<div class="form-group col-md-6">
    <label for="tag_category_id">Tag</label>
    <select class="form-control" name="tag_category_id">
        <option value="">---Select Tag---</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ isset($product->tag_category_id) ?? $product->tag_category_id == $tag->id ? 'selected' : '' }}>{{ $tag->name_en }}</option>
        @endforeach
    </select>
</div>
