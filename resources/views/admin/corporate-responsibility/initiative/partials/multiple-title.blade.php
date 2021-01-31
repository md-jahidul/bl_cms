<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
    <input type="text" name="multi_title_en[]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->title_en) ? $component->title_en : '' }}">
</div>

<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" >{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
    <input type="text" name="multi_title_bn[]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->title_bn) ? $component->title_bn : '' }}">
</div>
