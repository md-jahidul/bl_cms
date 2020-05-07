<div class="form-group col-md-6 {{ $errors->has('validity_unit') ? ' error' : '' }}">
    <label for="validity_unit" class="required">Validity Unit</label>
    <select class="form-control required" name="validity_unit"
            required data-validation-required-message="Please select type">
        <option value="">---Validity Type---</option>
        <option value="daily" {{ isset($appServiceProduct->validity_unit) && $appServiceProduct->validity_unit == "daily" ? 'selected' : '' }}>Daily</option>
        <option value="weekly" {{ isset($appServiceProduct->validity_unit) && $appServiceProduct->validity_unit == "weekly" ? 'selected' : '' }}>Weekly</option>
        <option value="monthly" {{ isset($appServiceProduct->validity_unit) && $appServiceProduct->validity_unit == "monthly" ? 'selected' : '' }}>Monthly</option>
    </select>
    <div class="help-block"></div>
    @if ($errors->has('validity_unit'))
        <div class="help-block">{{ $errors->first('validity_unit') }}</div>
    @endif
</div>
