<div class="photo_component">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

                <div class="row">

                    <div class="col-md-3 col-xs-12">
                        <div class="form-group">
                            <label for="Banner Photo">Photo One <span class="text-danger">*</span></label>
                            <input type="file" required class="dropify_package com_photo_one" name="" data-height="70"
                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            <label>Alt Text One</label>
                            <input type="text" class="form-control com_photo_one_alt">

                        </div>
                        <div class="form-group">
                            <label for="Banner Photo">Photo Three</label>
                            <input type="file" class="dropify_package com_photo_three" name="" data-height="70"
                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            <label>Alt Text Two</label>
                            <input type="text" class="form-control com_photo_two_alt">

                        </div>

                    </div>
                    <div class="col-md-3 col-xs-12">

                        <div class="form-group">
                            <label for="Banner Photo">Photo Two</label>
                            <input type="file" class="dropify_package com_photo_two" name="" data-height="70"
                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            <label>Alt Text Three</label>
                            <input type="text" class="form-control com_photo_three_alt">
                        </div>

                        <div class="form-group">
                            <label for="Banner Photo">Photo Four</label>
                            <input type="file" class="dropify_package com_photo_four" name="" data-height="70"
                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                            <label>Alt Text Four</label>
                            <input type="text" class="form-control com_photo_four_alt">
                        </div>

                    </div>

                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>Sample </label>
                            <img src="{{asset('app-assets/images/business/photo_com_demo.png')}}" width="100%">
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>