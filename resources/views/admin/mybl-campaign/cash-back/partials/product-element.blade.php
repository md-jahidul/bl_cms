<slot data-repeater-list="group-a" data-repeater-item>
    <div class="form-group col-md-4 mb-2" id="cta_action">
        <label for="product_code" class="required">Product Code</label>
        <select id="product_code" name="product_code"
                class="browser-default custom-select product-list">
            <option value="">Select Product</option>
            @foreach ($products as $key => $value)
                <option value="{{ $value->product_code }}"
                    {{ isset($product) && $product->product_code == $value->product_code ? 'selected' : '' }}>{{ $value->commercial_name_en . " / " . $value->product_code }}</option>
            @endforeach
        </select>
        <div class="help-block"></div>
    </div>

    <div class="form-group col-md-2 {{ $errors->has('recharge_amount') ? ' error' : '' }}">
        <label for="recharge_amount">Recharge Amount</label>
        <div class='input-group'>
            <input type='number' class="form-control" name="recharge_amount"
                   placeholder="Please select recharge amount"
                   value="{{ isset($product) ? $product->recharge_amount : old('recharge_amount') }}"
                   autocomplete="off"/>
        </div>
        <div class="help-block"></div>
        @if ($errors->has('recharge_amount'))
            <div class="help-block">{{ $errors->first('recharge_amount') }}</div>
        @endif
    </div>

    <div class="form-group col-md-3 {{ $errors->has('cash_back_amount') ? ' error' : '' }}">
        <label for="cash_back_amount">Cash Back Amount</label>
        <input type="number" name="cash_back_amount" class="form-control"
               placeholder="Please select cash back amount"
               value="{{ isset($product) ? $product->cash_back_amount : old('cash_back_amount') }}" autocomplete="off">
        <div class="help-block"></div>
        @if ($errors->has('cash_back_amount'))
            <div class="help-block">{{ $errors->first('cash_back_amount') }}</div>
        @endif
    </div>
    <div class="form-group col-md-2 mb-2" id="cta_action">
        <label for="redirect_url">Product Status</label>
        <select id="navigate_action" name="status"
                class="browser-default custom-select">
            <option value="">Select Status</option>
            <option class="text-success" value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Enable</option>
            <option class="text-danger" value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Disable</option>
        </select>
        <div class="help-block"></div>
    </div>

    <!-- Product Row Delete -->
    <div class="form-group col-md-1 pt-2">
        <label for="redirect_url"></label>
        <button data-repeater-delete type="button"
                class="btn-sm btn-danger cursor-pointer float-right">
            <i class="la la-trash"></i>
        </button>
    </div>
</slot>
