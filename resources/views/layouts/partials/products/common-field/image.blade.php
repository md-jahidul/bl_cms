<div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }}">
    <label for="tag_category_id">Product Details Image</label>

    <div class="custom-file">

        <input type="hidden" name="old_web_img" value="">
        <input type="hidden" name="old_web_img" value="{{ (!empty($product->image)) ? $product->image : ''}}">

        <input type="file" name="image" class="custom-file-input" id="image">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>

    <span class="text-primary">Please given file type (.png, .jpg)</span>

    @if( !empty($product->image) )
        <img src="{{ config('filesystems.file_base_url') . $product->image}}" style="width:100%;margin-top:10px;">
    @endif
</div>
