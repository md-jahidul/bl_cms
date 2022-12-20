

<div class="form-group col-md-6 {{ $errors->has('year_en') ? ' error' : '' }}">
    <label for="year_en">Year</label>
    <input type="text" name="other_attributes[year_en]" rows="5"
              class="form-control" placeholder="Enter year" value="{{ (!empty($other_attributes['year_en'])) ? $other_attributes['year_en'] : old("other_attributes.year_en") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('year_en'))
        <div class="help-block">  {{ $errors->first('year_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('year_bn') ? ' error' : '' }}">
    <label for="year_bn">Year (bangla)</label>
    <input type="text" name="other_attributes[year_bn]" rows="5"
              class="form-control" placeholder="Enter year (bangla)" value="{{ (!empty($other_attributes['year_bn'])) ? $other_attributes['year_bn'] : old("other_attributes.year_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('year_bn'))
        <div class="help-block">  {{ $errors->first('year_bn') }}</div>
    @endif
</div>
