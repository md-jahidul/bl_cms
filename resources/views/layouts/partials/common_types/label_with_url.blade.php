@php
    $count = $count ?? 0;
@endphp

<div class="form-group col-md-6 {{ $errors->has('link_label_en_'.$count) ? ' error' : '' }}">
    <label for="link_label_en_".$count>Label (English)</label>
    <input type="text" name="other_attributes[link_label_en_{{$count}}]" rows="5" id="details"
                class="form-control" placeholder="Enter link label" value="{{ (!empty($other_attributes['link_label_en_'.$count])) ? $other_attributes['link_label_en_'.$count] : old("other_attributes.link_label_en_".$count) ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('label_en_'.$count))
    <div class="help-block">  {{ $errors->first('label_en_'.$count) }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('link_label_bn_'.$count) ? ' error' : '' }}">
    <label for="link_label_bn_".$count>Label (bangla)</label>
    <input type="text" name="other_attributes[link_label_bn_{{$count}}]" rows="5" id="details"
                class="form-control" placeholder="Enter link label (bangla)" value="{{ (!empty($other_attributes['link_label_bn_'.$count])) ? $other_attributes['link_label_bn_'.$count] : old("other_attributes.label_bn_".$count) ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('link_label_bn_'.$count))
    <div class="help-block">  {{ $errors->first('link_label_bn_'.$count) }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('link_url_en_'.$count) ? ' error' : '' }}">
    <label for="link_url_en_".$count>Label url(English)</label>
    <input type="text" name="other_attributes[link_url_en_{{$count}}]" rows="5" id="details"
                class="form-control" placeholder="Enter link url " value="{{ (!empty($other_attributes['link_url_en_'.$count])) ? $other_attributes['link_url_en_'.$count] : old("other_attributes.link_url_en_".$count) ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('link_url_en_'.$count))
    <div class="help-block">  {{ $errors->first('link_url_en_'.$count) }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('link_url_bn_'.$count) ? ' error' : '' }}">
    <label for="link_url_bn_".$count>Label url (bangla)</label>
    <input type="text" name="other_attributes[link_url_bn_{{$count}}]" rows="5" id="details"
                class="form-control" placeholder="Enter link url (bangla) " value="{{ (!empty($other_attributes['link_url_bn_'.$count])) ? $other_attributes['link_url_bn_'.$count] : old("other_attributes.link_url_bn_".$count) ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('link_url_bn_'.$count))
    <div class="help-block">  {{ $errors->first('link_url_bn_'.$count) }}</div>
    @endif
</div>
