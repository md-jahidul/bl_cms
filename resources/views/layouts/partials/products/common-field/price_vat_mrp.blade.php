<div class="form-group col-md-6 ">
    <label for="price">Offer Price</label>
    <input type="text" name="price" id="price"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ old("price") ? old("price") : '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="price">Vat</label>
    <input type="text" name="vat" id="vat" class="form-control" placeholder="Enter offer price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ old("price") ? old("price") : '' }}">
    <div class="help-block"></div>
</div>
