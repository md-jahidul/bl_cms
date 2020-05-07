<div class="form-group col-md-6 ">
    <label for="price_tk">Price</label>
    <input type="text" name="price_tk" id="price_tk"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ isset($appServiceProduct->price_tk) ? $appServiceProduct->price_tk : "" }}">
    <div class="help-block"></div>
</div>
