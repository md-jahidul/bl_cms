<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">

            <div class="row">
                <div class="col-md-10 col-xs-12">
                    <div class="row package_one_wrap">

                        <div class="col-md-4 col-xs-12">

                            <div class="form-group">
                                <label class="display-block">Package Name <span class="text-danger">*</span> 

                                    <a href="javascript:;" class="add_package_one pull-right">
                                        <i class="la la-plus-square"></i>
                                    </a>
                                </label>
                                <input type="text" class="form-control" name="table_head[]">
                            </div>

                            <div class="form-group">
                                <label>Feature Text <span class="text-danger">*</span></label>
                                <textarea type="text" name="feature_text[]" class="form-control textarea_details"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="price[]">
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-2 col-xs-12 pull-right">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/package_one_demo.png')}}" width="100%">
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


<div class="display-hidden package_comparison_one_single">
    <div class="col-md-4 col-xs-12 pc1_new_package">

        <div class="form-group">
            <label class="display-block">Package Name <span class="text-danger">*</span> 

                <a href="javascript:;" class="remove_package_one pull-right text-danger">
                    <i class="la la-minus-square"></i>
                </a>
                <a href="javascript:;" class="add_package_one pull-right">
                    <i class="la la-plus-square"></i>
                </a>

            </label>
            <input type="text" class="form-control" name="table_head[]">
        </div>

        <div class="form-group">
            <label>Feature Text <span class="text-danger">*</span></label>
            <textarea type="text" name="feature_text[]" class="form-control textarea_details"></textarea>
        </div>
        <div class="form-group">
            <label>Price <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="price[]">
        </div>

    </div>
</div>


@push('page-js')

<script type="text/javascript">

    $(function () {


        //text editor for package details
        $("textarea.textarea_details").summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                // ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview']]
            ],
            height: 170
        });



        //add package comparison table one element
        $('.card').on('click', '.add_package_one', function () {
            var html = $(".package_comparison_one_single .pc1_new_package").clone();

            var position = $(this).parents('.package_one_wrap').find('.com_pc1_position').val();

            var pc1TableHead = "com_pc1_table_head[" + position + "][]";
            $(html).find('.com_pc1_table_head').attr('name', pc1TableHead);

            var pc1FeatureText = "com_pc1_feature_text[" + position + "][]";
            $(html).find('.com_pc1_feature_text').attr('name', pc1FeatureText);

            var pc1Price = "com_pc1_price[" + position + "][]";
            $(html).find('.com_pc1_price').attr('name', pc1Price);

            //text editor for package details
            $(html).find("textarea.new_textarea_details").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    // ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview']]
                ],
                height: 170
            });

            $(this).parents('.package_one_wrap').append(html);
        });

    });

</script>
@endpush