<slot data-repeater-list="group-a" data-repeater-item>
    <div class="form-group col-md-4 {{ $errors->has('recharge_amount') ? ' error' : '' }}">
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

    <div class="form-group col-md-4 {{ $errors->has('cash_back_amount') ? ' error' : '' }}">
        <label for="cash_back_amount">Cash Back Amount</label>
        <input type="number" name="cash_back_amount" class="form-control"
               placeholder="Please select cash back amount"
               value="{{ isset($product) ? $product->cash_back_amount : old('cash_back_amount') }}" autocomplete="off">
        <div class="help-block"></div>
        @if ($errors->has('cash_back_amount'))
            <div class="help-block">{{ $errors->first('cash_back_amount') }}</div>
        @endif
    </div>
    <div class="form-group col-md-3 mb-2" id="cta_action">
        <label for="redirect_url">Cashback Status</label>
        <select id="navigate_action" name="status"
                class="browser-default custom-select">
            <option class="text-danger" value="0" {{ isset($product) && $product->status == 0 ? 'selected' : '' }}>Disable</option>
            <option class="text-success" value="1" {{ isset($product) && $product->status == 1 ? 'selected' : '' }}>Enable</option>
        </select>
        <div class="help-block"></div>
    </div>
    <div class="form-group col-md-4 {{ $errors->has('start_date') ? ' error' : '' }}">
        <label for="start_date">Start Date</label>
        <div class='input-group'>
            <input type='text' class="form-control date_time" name="start_date" id="product_start_date"
                   value="{{ isset($product->start_date) ? $product->start_date : "" }}"
                   placeholder="Please select start date" />
        </div>
        <div class="help-block"></div>
        @if ($errors->has('start_date'))
            <div class="help-block">{{ $errors->first('start_date') }}</div>
        @endif
    </div>

    <div class="form-group col-md-4 {{ $errors->has('end_date') ? ' error' : '' }}">
        <label for="end_date">End Date</label>
        <input type="text" name="end_date" id="product_end_date" class="form-control date_time"
               placeholder="Please select end date"
               value="{{ isset($product->end_date) ? $product->end_date : "" }}" autocomplete="0">
        <div class="help-block"></div>
        @if ($errors->has('end_date'))
            <div class="help-block">{{ $errors->first('end_date') }}</div>
        @endif
    </div>
    <div class="col-md-3 icheck_minimal skin mt-2">
        <fieldset>
            <input type="checkbox" id="override_other_campaign" value="1" name="override_other_campaign" @if(isset($product->override_other_campaign) && $product->override_other_campaign) checked @endif>
            <label for="override_other_campaign">Override Other Campaign</label>
        </fieldset>
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
