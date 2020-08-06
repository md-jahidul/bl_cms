<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <input type="hidden" name="type" value="package-comparison-two">

            <div class="row">
                <div class="col-md-9 col-xs-12">

                    <div class="row package_two_wrap">

                        @foreach($component as $k => $val)

                        <div class="col-md-6 col-xs-12">
                            <div class="container-fluid  bg-light p-2 mr-1 mt-1">

                                <input type="hidden" name="position" value="{{$val->position}}">
                                <input type="hidden" name="com_id[]" value="{{$val->id}}">

                                <div class="form-group row">

                                    <div class="col-md-6 col-xs-12">
                                        <label>Title (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->title}}" name="title_en[]">
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <label class="display-block">Title (BN) <span class="text-danger">*</span>

                                            @if($k > 0)
                                            <a href="javascript:;" com_id="{{$val->id}}" class="remove_package_two pull-right text-danger">
                                                <i class="la la-minus-square"></i>
                                            </a>
                                            @endif

                                            <a href="javascript:;" class="add_package_two pull-right">
                                                <i class="la la-plus-square"></i>
                                            </a>
                                        </label>
                                        <input type="text" class="form-control" required value="{{$val->title_bn}}" name="title_bn[]">
                                    </div>

                                </div>


                                <div class="form-group row">

                                    <div class="col-md-6 col-xs-12">
                                        <label>Name (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->package_name}}" name="package_name_en[]">
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Name (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->package_name_bn}}" name="package_name_bn[]">
                                    </div>


                                </div>


                                <div class="form-group row">

                                    <div class="col-md-6 col-xs-12">
                                        <label>Data Limit (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->data_limit}}" name="data_limit_en[]">
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Data Limit (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->data_limit_bn}}" name="data_limit_bn[]">
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-12">
                                        <label>Package Days (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->package_days}}" name="package_days_en[]">
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Package Days (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required value="{{$val->package_days_bn}}" name="package_days_bn[]">
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12 col-xs-12">
                                        <label>Package Price (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control price_input" required value="{{$val->price}}" name="price_en[]">
                                    </div>


                                </div>
                            </div>

                        </div>

                        @endforeach


                    </div>

                </div>

                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/package_two_demo.png')}}" width="100%">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>






@push('page-js')

<script type="text/javascript">

    $(function () {


        //add package comparison table two element
        $('.card').on('click', '.add_package_two', function () {

            var html = $(".package_comparison_two_single .pk2_new_package").clone();

            $(this).parents('.package_two_wrap').append(html);
        });

        //remove package comparison table two element
        $('.card').on('click', '.remove_package_two', function () {

            var comId = $(this).attr('com_id');
            var deletedInput = "<input type='hidden' name='deleted[]' value='" + comId + "'>";

            $(this).parents('.col-md-6').fadeOut(300, function () {
                $(this).remove();
            });

            if (comId != undefined) {
                $(this).parents('form').append(deletedInput);
            }
        });

    });

</script>
@endpush