<div class="form-group col-md-6 {{ $errors->has('designation_en') ? ' error' : '' }}">
    <label for="designation_en">Designation</label>
    <input type="text" name="other_attributes[designation_en]" rows="5" id="details"
                class="form-control" placeholder="Enter Designation" value="{{ (!empty($other_attributes['designation_en'])) ? $other_attributes['designation_en'] : old("other_attributes.designation_en") ?? '' }}"/>
    <div class="help-block"></div>
    @if ($errors->has('designation_en'))
    <div class="help-block">  {{ $errors->first('designation_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('designation_bn') ? ' error' : '' }}">
    <label for="designation_bn">Designation (bangla)</label>
<input type="text" name="other_attributes[designation_bn]" rows="5" id="details"
                class="form-control" placeholder="Enter Designation" value="{{ (!empty($other_attributes['designation_bn'])) ? $other_attributes['designation_bn'] : old("other_attributes.designation_bn") ?? '' }}"/>
    <div class="help-block"></div>
    @if ($errors->has('designation_bn'))
    <div class="help-block">  {{ $errors->first('designation_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('organization_en') ? ' error' : '' }}">
    <label for="organization_en">Organization</label>
<input type="text" name="other_attributes[organization_en]" rows="5" id="details"
                class="form-control" placeholder="Enter  organization" value="{{ (!empty($other_attributes['organization_en'])) ? $other_attributes['organization_en'] : old("other_attributes.organization_en") ?? '' }}"/>
    <div class="help-block"></div>
    @if ($errors->has('organization_en'))
    <div class="help-block">  {{ $errors->first('organization_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('organization_bn') ? ' error' : '' }}">
    <label for="organization_bn">Organization (bangla)</label>
<input type="text" name="other_attributes[organization_bn]" rows="5" id="details"
                class="form-control" placeholder="Enter  organization" value="{{ (!empty($other_attributes['organization_bn'])) ? $other_attributes['designation_en'] : old("other_attributes.designation_en") ?? '' }}"/>
    <div class="help-block"></div>
    @if ($errors->has('organization_bn'))
    <div class="help-block">  {{ $errors->first('organization_bn') }}</div>
    @endif
</div>
