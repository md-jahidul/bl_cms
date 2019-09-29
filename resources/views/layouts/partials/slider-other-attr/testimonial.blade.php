<div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
    <label for="sliding_speed" class="required">Sliding Speed</label>
    <input type="text" name="other_attributes[sliding_speed]" oninput="this.value =Number(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"  class="form-control" placeholder="Enter sliding speed (sec)"  min="1" max="300"
           value="{{ (!empty($other_attributes['sliding_speed'])) ? $other_attributes['sliding_speed'] : old("other_attributes.sliding_speed") ?? '' }}"
           required data-validation-required-message="Enter price info">
    <div class="help-block"></div>
    @if ($errors->has('sliding_speed'))
        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('') ? ' error' : '' }}">
    <label for="title_en" class="required">Slider header Title (English)</label>
    <input type="text" name="other_attributes[title_en]" class="form-control" placeholder="Enter slider header title english"
           value="{{ (!empty($other_attributes['title_en'])) ? $other_attributes['title_en'] : old("other_attributes.title_en") ?? '' }}"
           required data-validation-required-message="Enter slider header title english">
    <div class="help-block"></div>
    @if ($errors->has('title_en'))
        <div class="help-block">  {{ $errors->first('title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="required">Slider header Title (Bangla)</label>
    <input type="text" name="other_attributes[title_bn]" class="form-control" placeholder="Enter slider header title bangla"
           value="{{ (!empty($other_attributes['title_bn'])) ? $other_attributes['title_bn'] : old("other_attributes.title_bn") ?? '' }}"
           required data-validation-required-message="Enter slider header Title bangla">
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>
