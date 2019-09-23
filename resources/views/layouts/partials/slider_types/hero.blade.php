<h4 class="pl-1">Other Options</h4>
<div class="form-actions col-md-12 mt-0"></div>

<div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="">Title Bangla</label>
    <input type="text" name="title_bn"  class="form-control" placeholder="Enter price info"
            value="{{ (!empty($other_attributes['title_bn'])) ? $other_attributes['title_bn'] : "" }}" >
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>
<div class="form-group col-md-4 {{ $errors->has('button_label_bn') ? ' error' : '' }}">
    <label for="title" class="">Button Label Bangla</label>
    <input type="text" name="button_label_bn"  class="form-control" placeholder="Button Label Bangla"
            value="{{ (!empty($other_attributes['button_label_bn'])) ? $other_attributes['button_label_bn'] : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('button_label_bn'))
        <div class="help-block">  {{ $errors->first('button_label_bn') }}</div>
    @endif
</div>