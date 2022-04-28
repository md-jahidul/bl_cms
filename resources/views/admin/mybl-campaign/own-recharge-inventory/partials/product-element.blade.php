<slot data-repeater-list="group-a" data-repeater-item>
    <div class="form-group col-12 mb-2 file-repeater">
        <div class="row mb-1">
            <div class="form-group col-md-4 }}">
                <label for="recharge_amount">Recharge Amount</label>
                <div class='input-group'>
                    <input type='number' class="form-control" name="recharge_amount" required
                        value="{{ isset($product) ? $product->recharge_amount : old('recharge_amount') }}"
                        placeholder="Please select recharge amount"
                        autocomplete="off"/>
                </div>
                <div class="help-block"></div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label class="required">Cashback Type : </label>
                    <select name="cash_back_type" class="browser-default custom-select"
                            id="cash_back_type" required>
                        <option value="">Select Cashback Type</option>
                        <option value="fixed_amount" @if(isset($product) && $product->cash_back_type == 'fixed_amount') selected @endif>Fixed Amount</option>
                        <option value="percentage" @if(isset($product) && $product->cash_back_type == 'percentage') selected @endif>Percentage</option>
                    </select>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="cash_back_amount">Enter Fixed/Percentage amount of Cashback</label>    
                <input required type="number" name="cash_back_amount" id="cash_back_amount" class="form-control"
                    value="{{ isset($product) ? $product->cash_back_amount : old('cash_back_amount') }}"
                    placeholder="Enter The Fixed/Percentage of Cashback"
                    >
            </div>
            <div class="form-group col-md-4 cash_back_amount_for_product {{ $denoType == 'all' ? 'd-none': '' }}">
                <label for="max_amount">Max Cash Back Amount</label>
                <input type="number" name="max_amount" class="form-control"
                    value="{{ isset($product) ? $product->max_amount : old('max_amount') }}"
                    placeholder="Please Enter Max Amount"
                    >
            </div>

            <div class="form-group col-md-4 number_of_apply_times_for_product {{ $denoType == 'all' ? 'd-none' : '' }}">
                <label for="number_of_apply_times">No of apply times</label>    
                <input type="number" name="number_of_apply_times" class="form-control"
                    value="{{ isset($product) ? $product->number_of_apply_times : old('number_of_apply_times') }}"
                    placeholder="Please Enter Max Amount"
                    >
            </div>
            <div class="form-group col-md-3 mb-2" id="cta_action">
                <label for="redirect_url">Cashback Status</label>
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
        </div>
    </div>
</slot>
