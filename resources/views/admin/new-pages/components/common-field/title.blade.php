<div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
    <label for="title_en">{{ (isset($title_en)) ? $title_en : 'Title Field (English)' }}</label>
    <input type="text" name="attribute[title_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['title_en'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" >{{ (isset($title_bn)) ? $title_bn : 'Title Field (Bangla)' }}</label>
    <input type="text" name="attribute[title_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['title_bn'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>
