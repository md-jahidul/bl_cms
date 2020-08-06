<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <input type="hidden" name="type" value="video-component">

            <div class="row">
                
                 <input type="hidden" name="com_id" value="{{$component->id}}">

                <div class="col-md-4 col-xs-12">

                    <div class="form-group">
                        <label>Name (EN) <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" value="{{$component->name}}" name="name_en">
                    </div>
                    <div class="form-group">
                        <label>Name (BN) <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" value="{{$component->name_bn}}" name="name_bn">
                    </div>

                    <div class="form-group">
                        <label for=""> Embed HTML <span class="text-danger">*</span></label>
                        <textarea type="text" class="form-control" name="embed_code">{{$component->embed_code}}</textarea>
                    </div>

                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Title (EN) <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" value="{{$component->title}}" name="title_en">
                    </div>
                    <div class="form-group">
                        <label>Title (BN) <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control" value="{{$component->title_bn}}" name="title_bn">
                    </div>

                    <div class="form-group">
                        <label>Description (EN) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description_en">{{$component->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Description (BN) <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description_bn">{{$component->description_bn}}</textarea>
                    </div>
                </div>

                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Sample </label>
                        <img src="{{asset('app-assets/images/business/video_tutorial_demo.png')}}" width="100%">
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>