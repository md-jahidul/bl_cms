{{--<div class="form-group col-md-6 {{ $errors->has('duration_category_id') ? ' error' : '' }}">--}}
{{--    <label for="duration_category_id" class="required">Validity Unit</label>--}}
{{--    <select class="form-control required duration_categories" name="validity_unit" required>--}}
{{--        <option value="">---Select Duration Type---</option>--}}
{{--        <option value="hour" {{ $product->product_core['validity_unit'] == "hour" ? 'selected' : '' }}>Hour</option>--}}
{{--        <option value="hours" {{ $product->product_core['validity_unit'] == "hours" ? 'selected' : '' }}>Hours</option>--}}
{{--        <option value="day" {{ $product->product_core['validity_unit'] == "day" ? 'selected' : '' }}>Day</option>--}}
{{--        <option value="days" {{ $product->product_core['validity_unit'] == "days" ? 'selected' : '' }}>Days</option>--}}
{{--        @foreach($durations as $value)--}}
{{--            <option data-days="{{ $value->days }}" data-alias="{{ $value->alias }}" value="{{ $value->id }}" {{ $value->id == $offertype ? 'selected' : '' }}>{{ $value->name_en }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('duration_category_id'))--}}
{{--        <div class="help-block">{{ $errors->first('duration_category_id') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

