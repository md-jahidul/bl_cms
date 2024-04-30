<div class="form-group col-md-4">
    <label for="button_en">Button One Title (English)</label>
    <input type="text" name="attribute[button_one_name][en]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $component->attribute['button_one_name']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_bn" >Button One Title (Bangla)</label>
    <input type="text" name="attribute[button_one_name][bn]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $component->attribute['button_one_name']['bn'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_link" >Button One URL</label>
    <input type="text" name="attribute[button_one_link][en]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $component->attribute['button_one_link']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_en">Button Two Title (English)</label>
    <input type="text" name="attribute[button_two_name][en]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $component->attribute['button_two_name']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_bn" >Button Two Title (Bangla)</label>
    <input type="text" name="attribute[button_two_name][bn]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $component->attribute['button_two_name']['bn'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-4">
    <label for="button_link" >Button Two URL</label>
    <input type="text" name="attribute[button_two_link][en]"  class="form-control" placeholder="Enter button url bangla"
           value="{{ $component->attribute['button_two_link']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>
