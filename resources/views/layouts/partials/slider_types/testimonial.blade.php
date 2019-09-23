<h4 class="pl-1">Advance Option</h4>
<div class="form-actions col-md-12 mt-0"></div>

<div class="form-group col-md-4 {{ $errors->has('user_name') ? ' error' : '' }}">
    <label for="user_name" class="">User Name</label>
    <input type="text" name="other_attributes[user_name]"  class="form-control" placeholder="Enter user name"
           value="{{ (!empty($other_attributes['user_name'])) ? $other_attributes['user_name'] : "" }}" required data-validation-required-message="Enter user name">
    <div class="help-block"></div>
    @if ($errors->has('user_name'))
        <div class="help-block">  {{ $errors->first('user_name') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('company_name') ? ' error' : '' }}">
    <label for="company_name" class="">Company Name</label>
    <input type="text" name="other_attributes[company_name]"  class="form-control" placeholder="Enter company name"
           value="{{ (!empty($other_attributes['company_name'])) ? $other_attributes['company_name'] : "" }}" required data-validation-required-message="Enter company name">
    <div class="help-block"></div>
    @if ($errors->has('company_name'))
        <div class="help-block">  {{ $errors->first('company_name') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('rating') ? ' error' : '' }}">
    <label for="rating" class="">Rating</label>
    <input type="number" name="other_attributes[rating]"  class="form-control" placeholder="Enter rating out of 5" max="5"
           value="{{ (!empty($other_attributes['rating'])) ? $other_attributes['rating'] : "" }}" required data-validation-required-message="Enter rating out of 5">
    <spen class="text-primary">(Please given rating out of 5)</spen>
    <div class="help-block"></div>
    @if ($errors->has('rating'))
        <div class="help-block">  {{ $errors->first('rating') }}</div>
    @endif
</div>

<div class="form-group col-md-12 {{ $errors->has('feedback') ? ' error' : '' }}">
    <label for="feedback" class="required">Feedback</label>
    <textarea type="text" name="other_attributes[feedback]" rows="5"  class="form-control" placeholder="Enter user feedback"
              required data-validation-required-message="Enter user feedback">{{ (!empty($other_attributes['feedback'])) ? $other_attributes['feedback'] : "" }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('feedback'))
        <div class="help-block">  {{ $errors->first('feedback') }}</div>
    @endif
</div>





