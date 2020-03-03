<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">

            <input type="hidden" name="type" value="package-comparison-one">


            <div class="row">
                <div class="col-md-10 col-xs-12">
                    <div class="row package_one_wrap">
                        @foreach($component as $k => $val)

                        <div class="col-md-4 col-xs-12">
                            <input type="hidden" name="position" value="{{$val->position}}">
                            <input type="hidden" name="com_id[]" value="{{$val->id}}">
                            <div class="form-group">

                                <label class="display-block">Package Name (EN) <span class="text-danger">*</span> 

                                    @if($k > 0)
                                    <a href="javascript:;" com_id="{{$val->id}}" class="remove_package_one pull-right text-danger">
                                        <i class="la la-minus-square"></i>
                                    </a>
                                    @endif

                                    <a href="javascript:;" class="add_package_one pull-right">
                                        <i class="la la-plus-square"></i>
                                    </a>
                                </label>
                                <input type="text" class="form-control" required value="{{$val->table_head}}" name="table_head_en[]">

                                <label class="display-block">Package Name (BN) <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" required value="{{$val->table_head_bn}}" name="table_head_bn[]">

                            </div>

                            <div class="form-group">

                                <label>Feature Text (EN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="feature_text_en[]" required class="form-control textarea_details">{!! $val->feature_text !!}</textarea>

                                <label>Feature Text (BN)<span class="text-danger">*</span></label>
                                <textarea type="text" name="feature_text_bn[]" required class="form-control textarea_details">{!! $val->feature_text_bn !!}</textarea>

                            </div>

                            <div class="form-group">

                                <label>Price (EN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required value="{{$val->price}}" name="price_en[]">

                                <label>Price (BN)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required value="{{$val->price_bn}}" name="price_bn[]">

                            </div>
                            <hr>

                        </div>

                        @endforeach

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
         
            //text editor for package details
            $(html).find("textarea.textarea_details_new").summernote({
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

        //remove package comparison table one element
        $('.card').on('click', '.remove_package_one', function () {
            var comId = $(this).attr('com_id');
            var deletedInput = "<input type='hidden' name='deleted[]' value='"+comId+"'>";
            $(this).parents('.col-md-4').fadeOut(300, function () {
                $(this).remove();
            });
            
            if(comId != undefined){
                $(this).parents('form').append(deletedInput);
            }
        });

    });

</script>
@endpush