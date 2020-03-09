<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <input type="hidden" name="type" value="product-price-table">

            <div class="row">

                <input type="hidden" name="com_id" value="{{$component->id}}">

                <div class="col-md-8 col-xs-12">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="display-block">Title (EN) <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{$component->title}}" name="title_en">

                        </div>
                        <div class="col-md-6">
                            <label class="display-block">Title (BN) <span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" value="{{$component->title_bn}}" name="title_bn">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="display-block">Table Head (EN) <span class="text-danger">*</span></label>
                        @php
                        $headsEn = json_decode($component->table_head);
                        $headsBn = json_decode($component->table_head_bn);
                        @endphp
                        <input type="text" required value="{{!empty($headsEn[0]) ? $headsEn[0] : ''}}" class="form-control col-md-4 pull-left" name="head_one_en">
                        <input type="text" required value="{{!empty($headsEn[1]) ? $headsEn[1] : ''}}" class="form-control col-md-4 pull-left" name="head_two_en">
                        <input type="text" required value="{{!empty($headsEn[2]) ? $headsEn[2] : ''}}" class="form-control col-md-4 pull-left" name="head_three_en">
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="display-block">Table Head (BN) <span class="text-danger">*</span></label>
                        <input type="text" required value="{{!empty($headsBn[0]) ? $headsBn[0] : ''}}"  class="form-control col-md-4 pull-left" name="head_one_bn">
                        <input type="text" required value="{{!empty($headsBn[1]) ? $headsBn[1] : ''}}" class="form-control col-md-4 pull-left" name="head_two_bn">
                        <input type="text" required value="{{!empty($headsBn[2]) ? $headsBn[2] : ''}}" class="form-control col-md-4 pull-left" name="head_three_bn">
                        <div class="clearfix"></div>

                    </div>

                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/price_table_demo.png')}}" width="95%">
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


                    <?php
                    $bodyEnArray = json_decode($component->table_body);
                    $bodyEn = [];

                    if (!empty($bodyEnArray)) {
                        $rowsEn = count($bodyEnArray[0]);
                        for ($i = 0; $i < $rowsEn; $i++) {
                            $count = 0;
                            foreach ($bodyEnArray as $k => $val) {
                                $bodyEn[$i][$count] = $val[$i];
                                $count++;
                            }
                        }
                    }

                    $bodyBnArray = json_decode($component->table_body_bn);
                    $bodyBn = [];

                    if (!empty($bodyBnArray)) {
                        $rowsBn = count($bodyBnArray[0]);
                        for ($i = 0; $i < $rowsBn; $i++) {
                            $count = 0;
                            foreach ($bodyBnArray as $k => $val) {
                                $bodyBn[$i][$count] = $val[$i];
                                $count++;
                            }
                        }
                    }
                    $totalRow = count($bodyEn);
                    ?>

                    <input type="hidden" value="{{$totalRow}}" class="total_row">

                    <div class="col-md-6 pull-left price_table_wrap_en">
                        <label class="display-block">(EN) <span class="text-danger">*</span></label>
                        @foreach($bodyEn as $k => $val)

                        <div class="row column_body_wrap_{{$k}}">
                            <input type="text" required value="{{$val[0]}}" class="form-control col-md-4 pull-left" name="column_one_en[]">
                            <input type="text" required value="{{$val[1]}}" class="form-control col-md-4 pull-left" name="column_two_en[]">
                            <input type="text" required value="{{$val[2]}}" class="form-control col-md-3 pull-left" name="column_three_en[]">
                        </div>


                        <div class="clearfix"></div>
                        <br>

                        @endforeach

                    </div>
                    <div class="col-md-6 pull-left price_table_wrap_bn">
                        <label class="display-block">(BN) <span class="text-danger">*</span></label>
                        @foreach($bodyBn as $k => $val)
                        <div class="row column_body_wrap_{{$k}}">
                            <input type="text" required value="{{$val[0]}}" class="form-control col-md-4 pull-left" name="column_one_bn[]">
                            <input type="text" required value="{{$val[1]}}" class="form-control col-md-4 pull-left" name="column_two_bn[]">
                            <input type="text" required value="{{$val[2]}}" class="form-control col-md-3 pull-left" name="column_three_bn[]">
                            @if($k > 0)
                            <a href="javascript:;" column="{{$k}}" class="remove_price_table_clmn text-center text-danger">
                                <i class="la la-minus-square"></i>
                            </a>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                        <br>

                        @endforeach

                    </div>

                </div>




            </div>
        </div>
    </div>
</div>


@push('page-js')


<script>
    $(function () {


        //add price table body column
        $('.card').on('click', '.add_price_table_clmn', function () {

            var totalRow = $('.total_row').val();

            var htmlEn = $(".package_price_table_single .prict_table_new_columns_en").clone();
            $(htmlEn).find('.column_body_wrap').addClass('column_body_wrap_' + totalRow);
            $('.price_table_wrap_en').append(htmlEn);

            var htmlBn = $(".package_price_table_single .prict_table_new_columns_bn").clone();
            $(htmlBn).find('.column_body_wrap').addClass('column_body_wrap_' + totalRow);
            $(htmlBn).find('.remove_price_table_clmn').attr('column', totalRow);
            $('.price_table_wrap_bn').append(htmlBn);

            var newTotalRow = parseInt(totalRow) + 1;
            $('.total_row').val(newTotalRow);



        });

        //remove package comparison table two element
        $('.card').on('click', '.remove_price_table_clmn', function () {
            var sl = $(this).attr('column');
            var selector = ".column_body_wrap_" + sl;
            $(this).parents('.price_table_data_wrap').find(selector).parent('.prict_table_new_columns_en').remove();
            $(this).parents('.price_table_data_wrap').find(selector).parent('.prict_table_new_columns_bn').remove();
            $(this).parents('.price_table_data_wrap').find(selector).remove();
            $(this).closest('br').remove();
        });
    });


</script>
@endpush
