<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Title (English)</label>
    <input type="text" name="attribute[button_name][en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['button_name']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="attribute[button_name][bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['button_name']['bn'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button URL</label>
    <input type="text" name="attribute[button_link][en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['button_link']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>
