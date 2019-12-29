
@include('layouts.partials.product-details.common-field.details')

@include('layouts.partials.product-details.common-field.offer-details')




{{--<div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">--}}
{{--    <label for="role_id" class="required">Show More Product</label>--}}
{{--    <div class="role-select">--}}
{{--        <select class="select2 form-control" multiple="multiple" name="other_related_product_id[]" required--}}
{{--                data-validation-required-message="Please select related product">--}}
{{--            @foreach($products as $product)--}}
{{--                <option value="{{ $product->id }}" {{ match($product->id,$productDetail->other_related_product) ? 'selected' : '' }}>{{$product->name_en}} </option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('role_id'))--}}
{{--        <div class="help-block">  {{ $errors->first('role_id') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}
