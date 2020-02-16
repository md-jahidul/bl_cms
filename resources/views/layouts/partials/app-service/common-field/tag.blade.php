@php
    if (isset($appServiceProduct->tag_category_id)){
        $productTag = $appServiceProduct->tag_category_id;
    }else{
        $productTag = '';
    }
@endphp

<div class="form-group col-md-6">
    <label for="tag_category_id">Tag</label>
    <select class="form-control" name="tag_category_id">
        <option value="">---Select Tag---</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ $productTag == $tag->id ? 'selected' : '' }}>{{ $tag->name_en }}</option>
        @endforeach
    </select>
</div>
