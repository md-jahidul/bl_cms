<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <input type="hidden" name="type" value="product-features">

            <div class="row">

                <input type="hidden" name="com_id" value="{{$component->id}}">

                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <label for=""> Features (EN) <span class="text-danger">*</span></label>
                        <textarea type="text" name="feature_text_en" class="form-control textarea_details">{{$component->feature_text}}</textarea>
                    </div>
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <label for=""> Features (BN) <span class="text-danger">*</span></label>
                        <textarea type="text" name="feature_text_bn" class="form-control textarea_details">{{$component->feature_text_bn}}</textarea>
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/product_features_demo.png')}}" width="100%">
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

@push('page-js')

<script type="text/javascript">
    $(function () {


        //    //text editor for package details
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
    });

</script>
@endpush
