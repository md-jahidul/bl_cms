<div class="form-group col-md-6">
    <label for="title_en">Title Field (English)</label>
    <input type="text" name="attribute[title][en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['title']['en'] ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="title_bn" >Title Field (Bangla)</label>
    <input type="text" name="attribute[title][bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $component->attribute['title']['bn'] ?? '' }}">
    <div class="help-block"></div>
</div>
