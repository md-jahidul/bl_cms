<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

            <div class="row">

                <div class="col-md-8 col-xs-12">
                    <div class="form-group">
                        <label class="display-block">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control com_price_title" name="">
                    </div>
                    <div class="form-group">
                        <label class="display-block">Table Head <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Head One" class="form-control col-md-4 pull-left com_price_head" name="">
                        <input type="text" placeholder="Head Two" class="form-control col-md-4 pull-left com_price_head" name="">
                        <input type="text" placeholder="Head Three" class="form-control col-md-4 pull-left com_price_head" name="">
                        <br>
                        <br>
                        <hr>
                    </div>



                    <div class="form-group">
                        <label class="display-block">Table Data <span class="text-danger">*</span>
                            <a href="javascript:;" class="add_price_table_clmn btn btn-sm btn-info">
                                + Add Row
                            </a>
                        </label>

                        <div class="price_table_data_wrap">

                            <input type="hidden" class="com_prict_table_position">

                            <div class="col-md-11 pull-left">
                                <input type="text" placeholder="Column One" class="form-control col-md-4 pull-left com_price_column_one" name="">
                                <input type="text" placeholder="Column Two" class="form-control col-md-4 pull-left com_price_column_two" name="">
                                <input type="text" placeholder="Column Three" class="form-control col-md-4 pull-left com_price_column_three" name="">
                            </div>
                            <div class="col-md-1 pull-left">
                            </div>

                        </div>



                    </div>



                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/price_table_demo.png')}}" width="100%">
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<div class="display-hidden package_price_table_single">
    <div class="prict_table_new_columns">
        <div class="col-md-11 pull-left">
            <input type="text" placeholder="Column One" class="form-control col-md-4 pull-left com_price_column_one" name="">
            <input type="text" placeholder="Column Two" class="form-control col-md-4 pull-left com_price_column_two" name="">
            <input type="text" placeholder="Column Three" class="form-control col-md-4 pull-left com_price_column_three" name="">
        </div>
        <div class="col-md-1 pull-left prict_table_new_remove">
            <a href="javascript:;" class="remove_price_table_clmn pull-right text-danger">
                <i class="la la-minus-square"></i>
            </a>
        </div>
    </div>


</div>