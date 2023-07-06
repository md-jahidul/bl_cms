<div class="col-md-12">
    <span><h4><strong>Price</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="price">MRP</label>
    <input type="text" name="mrp_price" id="mrp_price"  class="form-control" placeholder="Enter MRP price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->mrp_price)) ? $product->product_core->mrp_price : old("mrp_price") ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="price">Price</label>
    <input type="text" name="price" id="price"  class="form-control" placeholder="Enter offer price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->price)) ? $product->product_core->price : old("price") ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="price">Vat</label>
    <input type="text" name="vat" id="vat" class="form-control" placeholder="Enter offer price in taka" step="0.001"
           oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
           value="{{ (!empty($product->product_core->vat)) ? $product->product_core->vat : old("vat") ?? '' }}">
    <div class="help-block"></div>
</div>
