<div class="package_price_table">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                <input type="hidden" class="com_prict_table_position">

                <div class="row">

                    <div class="col-md-8 col-xs-12">


                        <div class="form-group row">

                            <div class="col-md-6">
                                <label class="display-block">Title (EN) <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control com_price_title_en">

                            </div>
                            <div class="col-md-6">
                                <label class="display-block">Title (BN) <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control com_price_title_bn">
                            </div>

                        </div>


                        <div class="form-group">
                            <label class="display-block">Table Head (EN) <span class="text-danger">*</span></label>

                            <input type="text" required class="form-control com_price_head_en col-md-4 pull-left">
                            <input type="text" required class="form-control com_price_head_en col-md-4 pull-left">
                            <input type="text" required class="form-control com_price_head_en col-md-4 pull-left">
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <label class="display-block">Table Head (BN) <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control com_price_head_bn col-md-4 pull-left">
                            <input type="text" required class="form-control com_price_head_bn col-md-4 pull-left">
                            <input type="text" required class="form-control com_price_head_bn col-md-4 pull-left">
                            <div class="clearfix"></div>

                        </div>


                    </div>

                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>Sample </label>
                            <img src="{{asset('app-assets/images/business/price_table_demo.png')}}" width="100%">
                        </div>


                    </div>

                </div>


                <div class="row">

                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="display-block">Table Data <span class="text-danger">*</span>
                                <a href="javascript:;" class="add_price_table_clmn btn btn-sm btn-info">
                                    + Add Row
                                </a>
                            </label>
                        </div>
                    </div>

                    <div class="price_table_data_wrap col-md-12 col-xs-12">

                        <input type="hidden" value="1" class="total_row">

                        <div class="col-md-6 pull-left price_table_wrap_en">
                            <label class="display-block">(EN) <span class="text-danger">*</span></label>


                            <div class="row column_body_wrap_0">
                                <input type="text" required class="form-control com_price_column_one_en col-md-4 pull-left">
                                <input type="text" required class="form-control com_price_column_two_en col-md-4 pull-left">
                                <input type="text" required class="form-control com_price_column_three_en col-md-3 pull-left">
                            </div>


                            <div class="clearfix"></div>
                            <br>


                        </div>

                        <div class="col-md-6 pull-left price_table_wrap_bn">
                            <label class="display-block">(BN) <span class="text-danger">*</span></label>


                            <div class="row column_body_wrap_0">
                                <input type="text" required class="form-control com_price_column_one_bn col-md-4 pull-left">
                                <input type="text" required class="form-control com_price_column_two_bn col-md-4 pull-left">
                                <input type="text" required class="form-control com_price_column_three_bn col-md-3 pull-left">
                            </div>


                            <div class="clearfix"></div>
                            <br>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<div class="display-hidden package_price_table_single">

    <div class="prict_table_new_columns_en">
        <div class="row column_body_wrap">
            <input type="text" required class="form-control com_price_column_one_en col-md-4 pull-left">
            <input type="text" required class="form-control com_price_column_two_en col-md-4 pull-left">
            <input type="text" required class="form-control com_price_column_three_en col-md-3 pull-left">
        </div>

        <div class="clearfix"></div>
        <br>
    </div>

    <div class="prict_table_new_columns_bn">
        <div class="row column_body_wrap">
            <input type="text" required class="form-control com_price_column_one_bn col-md-4 pull-left">
            <input type="text" required class="form-control com_price_column_two_bn col-md-4 pull-left">
            <input type="text" required class="form-control com_price_column_three_bn col-md-3 pull-left">

            <a href="javascript:;" class="remove_price_table_clmn text-center text-danger">
                <i class="la la-minus-square"></i>
            </a>
        </div>

        <div class="clearfix"></div>
        <br>
    </div>


</div>
