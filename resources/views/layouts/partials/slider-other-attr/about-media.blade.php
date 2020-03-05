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

<div class="form-group col-md-6 {{ $errors->has('press_release_title_en') ? ' error' : '' }}">
    <label for="press_release_title_en">Menu - 1 Title (English)</label>
    <input type="text" name="other_attributes[press_release_title_en]"  class="form-control" placeholder="Enter press release link"
           value="{{ (!empty($other_attributes['press_release_title_en'])) ? $other_attributes['press_release_title_en'] : old("other_attributes.press_release_title_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('press_release_title_en'))
        <div class="help-block">  {{ $errors->first('press_release_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('press_release_title_bn') ? ' error' : '' }}">
    <label for="press_release_title_bn">Menu - 1 (Bangla)</label>
    <input type="text" name="other_attributes[press_release_title_bn]"  class="form-control" placeholder="Enter press release link"
           value="{{ (!empty($other_attributes['press_release_title_bn'])) ? $other_attributes['press_release_title_bn'] : old("other_attributes.press_release_title_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('press_release_title_bn'))
        <div class="help-block">  {{ $errors->first('press_release_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('press_release_link') ? ' error' : '' }}">
    <label for="press_release_link">Menu - 1 link</label>
    <input type="text" name="other_attributes[press_release_link]"  class="form-control" placeholder="Enter press release link"
           value="{{ (!empty($other_attributes['press_release_link'])) ? $other_attributes['press_release_link'] : old("other_attributes.press_release_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('press_release_link'))
        <div class="help-block">  {{ $errors->first('press_release_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('news_events_title_en') ? ' error' : '' }}">
    <label for="news_events_title_en">Menu - 2 Title (English)</label>
    <input type="text" name="other_attributes[news_events_title_en]"  class="form-control" placeholder="Enter news & events link"
           value="{{ (!empty($other_attributes['news_events_title_en'])) ? $other_attributes['news_events_title_en'] : old("other_attributes.news_events_title_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('news_events_title_en'))
        <div class="help-block">  {{ $errors->first('news_events_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('news_events_title_bn') ? ' error' : '' }}">
    <label for="news_events_title_bn">Menu - 2 Title (Bangla)</label>
    <input type="text" name="other_attributes[news_events_title_bn]"  class="form-control" placeholder="Enter news & events link"
           value="{{ (!empty($other_attributes['news_events_title_bn'])) ? $other_attributes['news_events_title_bn'] : old("other_attributes.news_events_title_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('news_events_title_bn'))
        <div class="help-block">  {{ $errors->first('news_events_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('news_events_link') ? ' error' : '' }}">
    <label for="news_events_link">Menu - 2 link</label>
    <input type="text" name="other_attributes[news_events_link]"  class="form-control" placeholder="Enter news & events link"
           value="{{ (!empty($other_attributes['news_events_link'])) ? $other_attributes['news_events_link'] : old("other_attributes.news_events_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('news_events_link'))
        <div class="help-block">  {{ $errors->first('news_events_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('tvc_title_en') ? ' error' : '' }}">
    <label for="tvc_title_en">Menu - 3 Title (English)</label>
    <input type="text" name="other_attributes[tvc_title_en]"  class="form-control" placeholder="Enter app store link"
           value="{{ (!empty($other_attributes['tvc_title_en'])) ? $other_attributes['tvc_title_en'] : old("other_attributes.tvc_title_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('tvc_title_en'))
        <div class="help-block">  {{ $errors->first('tvc_title_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('tvc_title_bn') ? ' error' : '' }}">
    <label for="tvc_title_bn">Menu - 3 Title (Bangla)</label>
    <input type="text" name="other_attributes[tvc_title_bn]"  class="form-control" placeholder="Enter app store link"
           value="{{ (!empty($other_attributes['tvc_title_bn'])) ? $other_attributes['tvc_title_bn'] : old("other_attributes.tvc_title_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('tvc_title_bn'))
        <div class="help-block">  {{ $errors->first('tvc_title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('tvc_link') ? ' error' : '' }}">
    <label for="tvc_link">Menu - 3 link</label>
    <input type="text" name="other_attributes[tvc_link]"  class="form-control" placeholder="Enter app store link"
           value="{{ (!empty($other_attributes['tvc_link'])) ? $other_attributes['tvc_link'] : old("other_attributes.tvc_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('tvc_link'))
        <div class="help-block">  {{ $errors->first('tvc_link') }}</div>
    @endif
</div>


