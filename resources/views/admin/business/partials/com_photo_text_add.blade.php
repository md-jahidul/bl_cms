<div class="photo_text">

    <div class="card" data-index="0" data-position="0">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                <div class="row">

                    <div class="col-md-4 col-xs-12">

                        <div class="form-group">
                            <label for="Banner Photo">Photo <span class="text-danger">*</span></label>
                            <input type="file" class="dropify_package com_pt_photo" required name="" data-height="70"
                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            <label for="Banner Photo">Alt Text <span class="text-danger">*</span></label>
                            <input type="text" class="form-control com_pt_alt_text" required name="">

                        </div>

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label for="Package Name"> Text (EN) <span class="text-danger">*</span></label>
                            <textarea type="text" name="" class="form-control com_pt_text_en"></textarea>

                            <label for="Package Name"> Text (BN) <span class="text-danger">*</span></label>
                            <textarea type="text" name="" class="form-control com_pt_text_bn"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group">
                            <label>Sample </label>
                            <img src="{{asset('app-assets/images/business/photo_text_demo.png')}}" width="100%">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>