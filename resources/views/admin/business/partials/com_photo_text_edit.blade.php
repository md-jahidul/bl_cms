<div class="card" data-index="0" data-position="0">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <a href="javascript:;" class="pull-right text-danger remove_component"><i class="la la-close"></i></a>

            <div class="row">

                <input type="hidden" name="photo_text_id" value="{{$component->id}}">

                <div class="col-md-4 col-xs-12">

                    <div class="form-group">
                        <label>Photo <span class="text-danger">*</span></label>
                        <p class="text-center">
                            @if($component->photo_url != "")
                            <img src="{{ config('filesystems.file_base_url') . $component->photo_url }}" alt="Banner Photo" height="50px" />
                            @endif
                        </p>
                        
                        <input type="file" class="dropify com_pt_photo" required name="" data-height="70"
                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                        

                        <label> Alt Text</label>
                        <input type="text" name="alt_text" class="form-control" value="{{$component->text}}">

                    </div>

                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">

                        <label for="Package Name"> Text (EN)<span class="text-danger">*</span></label>
                        <textarea type="text" name="" class="form-control com_pt_text">{{ $component->text }}</textarea>

                        <br>

                        <label for="Package Name"> Text (BN)<span class="text-danger">*</span></label>
                        <textarea type="text" name="" class="form-control com_pt_text">{{ $component->text_bn }}</textarea>

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