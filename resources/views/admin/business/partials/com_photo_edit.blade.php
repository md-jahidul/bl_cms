<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <input type="hidden" name="type" value="photo-component">

            <div class="row">
                <input type="hidden" name="com_id" value="{{$component->id}}">

                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="Banner Photo">Photo One <span class="text-danger">*</span></label>
                        <input type="file" class="dropify" name="photo_one" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        <label>Alt Text One <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" name="alt_text_one" value="{{$component->alt_text_one}}">
                        

                    </div>
                    <div class="form-group">
                        <label for="Banner Photo">Photo Three <span class="text-danger">*</span></label>
                        <input type="file" class="dropify" name="photo_three" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        
                        <label>Alt Text Three <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" name="alt_text_three" value="{{$component->alt_text_three}}">

                    </div>

                </div>
                <div class="col-md-3 col-xs-12">

                    <div class="form-group">
                        <label for="Banner Photo">Photo Two <span class="text-danger">*</span></label>
                        <input type="file" class="dropify" name="photo_two" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        
                        <label>Alt Text Two <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" name="alt_text_two" value="{{$component->alt_text_two}}">
                    </div>

                    <div class="form-group">
                        <label for="Banner Photo">Photo Four <span class="text-danger">*</span></label>
                        <input type="file" class="dropify" name="photo_four" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        
                         <label>Alt Text Four <span class="text-danger">*</span></label>
                         <input type="text" required class="form-control" name="alt_text_four" value="{{$component->alt_text_four}}">
                        
                    </div>

                </div>

                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/photo_com_demo.png')}}" width="100%">
                    </div>
                    <div class="form-group">
                        <label class="display-block">Photos </label>
                        <input type="hidden" name="old_photo_one" value="{{$component->photo_one}}">
                        <input type="hidden" name="old_photo_two" value="{{$component->photo_two}}">
                        <input type="hidden" name="old_photo_three" value="{{$component->photo_three}}">
                        <input type="hidden" name="old_photo_four" value="{{$component->photo_four}}">
                        
                        <img src="{{ config('filesystems.file_base_url') . $component->photo_one }}" alt="Banner Photo" width="24%" />
                        <img src="{{ config('filesystems.file_base_url') . $component->photo_two }}" alt="Banner Photo" width="24%" />
                        <img src="{{ config('filesystems.file_base_url') . $component->photo_three }}" alt="Banner Photo" width="24%" />
                        <img src="{{ config('filesystems.file_base_url') . $component->photo_four }}" alt="Banner Photo" width="24%" />
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

