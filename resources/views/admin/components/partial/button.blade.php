
<div class="form-group col-md-4 {{ $errors->has('learn_more_btn_label_en') ? ' error' : '' }}">
    <label for="learn_more_btn_label_en" class="required1">
        Learn more Btn Label (English)
    </label>
    <input type="text" name="multi_item[learn_more_btn_label_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter btn label"
        value="{{ $single_attribute['learn_more_btn_label_en'] ?? null}}">
    <div class="help-block"></div>
    @if ($errors->has('learn_more_btn_label_en'))
        <div class="help-block">  {{ $errors->first('learn_more_btn_label_en') }}</div>
    @endif
</div>


<div class="form-group col-md-4 {{ $errors->has('learn_more_btn_label_bn') ? ' error' : '' }}">
    <label for="learn_more_btn_label_bn" class="required1">
        Learn more Btn Label (Bangla)
    </label>
    <input type="text" name="multi_item[learn_more_btn_label_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter title"
            value="{{ $single_attribute['learn_more_btn_label_bn'] ?? null}}">
    <div class="help-block"></div>
    @if ($errors->has('learn_more_btn_label_bn'))
        <div class="help-block">  {{ $errors->first('learn_more_btn_label_bn') }}</div>
    @endif
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="exampleInputPassword1">Learn more Btn button Link</label>
        <input type="text" name="multi_item[learn_more_btn_link-{{ $key +1 }}]" class="form-control " rows="5"
                placeholder="Enter Btn Link" value="{{ $single_attribute['learn_more_btn_link'] ?? null}}">
    </div>
</div>
<div class="form-group col-md-4 {{ $errors->has('others_btn_label_en') ? ' error' : '' }}">
    <label for="others_btn_label_en" class="required1">
        Others Btn Label (English)
    </label>
    <input type="text" name="multi_item[others_btn_label_en-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter btn label"
        value="{{ $single_attribute['others_btn_label_en'] ?? null}}">
    <div class="help-block"></div>
    @if ($errors->has('others_btn_label_en'))
        <div class="help-block">  {{ $errors->first('others_btn_label_en') }}</div>
    @endif
</div>


<div class="form-group col-md-4 {{ $errors->has('others_btn_label_bn') ? ' error' : '' }}">
    <label for="others_btn_label_bn" class="required1">
            Others Btn Label (Bangla)
    </label>
    <input type="text" name="multi_item[others_btn_label_bn-{{ $key +1 }}]"  class="form-control section_name" placeholder="Enter title"
            value="{{ $single_attribute['others_btn_label_bn'] ?? null}}">
    <div class="help-block"></div>
    @if ($errors->has('others_btn_label_bn'))
        <div class="help-block">  {{ $errors->first('others_btn_label_bn') }}</div>
    @endif
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="exampleInputPassword1"> Others Btn button Link</label>
        <input type="text" name="multi_item[others_btn_link-{{ $key +1 }}]" class="form-control " rows="5"
                placeholder="Enter Btn Link" value="{{ $single_attribute['others_btn_link'] ?? null}}">
    </div>
</div>