<div class="form-group col-md-6 {{ $errors->has('client_name_en') ? ' error' : '' }}">
    <label for="client_name_en" class="required">Client Name</label>
    <input type="text" name="other_attributes[client_name_en]"  class="form-control" placeholder="Enter user name"
           value="{{ (!empty($other_attributes['client_name_en'])) ? $other_attributes['client_name_en'] : old("other_attributes.client_name_en") ?? '' }}"
           required data-validation-required-message="Enter user name">
    <div class="help-block"></div>
    @if ($errors->has('client_name_en'))
        <div class="help-block">  {{ $errors->first('client_name_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('client_name_bn') ? ' error' : '' }}">
    <label for="client_name_bn" class="required">Client Name Bangla</label>
    <input type="text" name="other_attributes[client_name_bn]"  class="form-control" placeholder="Enter user name"
           value="{{ (!empty($other_attributes['client_name_bn'])) ? $other_attributes['client_name_bn'] : old("other_attributes.client_name_bn") ?? '' }}"
           required data-validation-required-message="Enter user name">
    <div class="help-block"></div>
    @if ($errors->has('client_name_bn'))
        <div class="help-block">  {{ $errors->first('client_name_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('company_name_en') ? ' error' : '' }}">
    <label for="company_name_en" class="required">Company Name</label>
    <input type="text" name="other_attributes[company_name_en]"  class="form-control" placeholder="Enter company name"
           value="{{ (!empty($other_attributes['company_name_en'])) ? $other_attributes['company_name_en'] : old("other_attributes.company_name_en") ?? '' }}"
           required data-validation-required-message="Enter company name">
    <div class="help-block"></div>
    @if ($errors->has('company_name_en'))
        <div class="help-block">  {{ $errors->first('company_name_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('company_name_bn') ? ' error' : '' }}">
    <label for="company_name_bn" class="required">Company Name Bangla</label>
    <input type="text" name="other_attributes[company_name_bn]"  class="form-control" placeholder="Enter company name"
           value="{{ (!empty($other_attributes['company_name_bn'])) ? $other_attributes['company_name_bn'] : old("other_attributes.company_name_bn") ?? '' }}"
           required data-validation-required-message="Enter company name">
    <div class="help-block"></div>
    @if ($errors->has('company_name_bn'))
        <div class="help-block">  {{ $errors->first('company_name_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('feedback_en') ? ' error' : '' }}">
    <label for="feedback_en" class="required">Feedback (English)</label>
    <textarea type="text" name="other_attributes[feedback_en]" rows="5"  class="form-control" placeholder="Enter user feedback in English"
              required data-validation-required-message="Enter user feedback">{{ (!empty($other_attributes['feedback_en'])) ? $other_attributes['feedback_en'] : old("other_attributes.feedback_en") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('feedback_en'))
        <div class="help-block">  {{ $errors->first('feedback_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('feedback_bn') ? ' error' : '' }}">
    <label for="feedback_bn" class="required">Feedback (Bangla)</label>
    <textarea type="text" name="other_attributes[feedback_bn]" rows="5"  class="form-control" placeholder="Enter user feedback in Bangla"
              required data-validation-required-message="Enter user feedback">{{ (!empty($other_attributes['feedback_bn'])) ? $other_attributes['feedback_bn'] : old("other_attributes.feedback_bn") ?? '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('feedback_bn'))
        <div class="help-block">  {{ $errors->first('feedback_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('rating') ? ' error' : '' }}">
    <label for="rating" class="required">Rating</label>
    <input type="text" name="other_attributes[rating]"  class="form-control" placeholder="Enter rating out of 5" min="1" max="5"
           oninput="this.value =Number(this.value.replace(/[^1-5.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($other_attributes['rating'])) ? $other_attributes['rating'] : old("other_attributes.rating") ?? '' }}"
           required data-validation-required-message="Enter rating out of 5">
    <spen class="text-primary">(Please given rating out of 5)</spen>
    <div class="help-block"></div>
    @if ($errors->has('rating'))
        <div class="help-block">  {{ $errors->first('rating') }}</div>
    @endif
</div>





