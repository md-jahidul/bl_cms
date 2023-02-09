<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="menu-title"><strong>Banner Section</strong></h4>
                <hr>
                <div class="card-body card-dashboard">
                    <form role="form"
                            action="{{ isset($banner) ? route('al-banner.update', $banner->id) : route('al-banner.store') }}"
                            method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @if (isset($banner))

                            {{method_field('PUT')}}
                        @else

                            {{method_field('POST')}}
                        @endif
                        {{ Form::hidden('section_id', $action['section_id'] ) }}
                        {{ Form::hidden('section_type', $action['section_type'] ) }}
                        <div class="row">
                            <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                <label for="title_en">Title (English)</label>
                                <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter explore name in English"
                                    value="{{ old("title_en") ? old("title_en") : (isset($banner) ? $banner->title_en : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_en'))
                                <div class="help-block">{{ $errors->first('title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                <label for="title_bn">Title (Bangla)</label>
                                <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter explore name in Bangla"
                                    value="{{ old("title_bn") ? old("title_bn") : (isset($banner) ? $banner->title_bn : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title_bn'))
                                <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="desc_en">Description (English)</label>
                                <textarea type="text" name="desc_en" id="" class="form-control summernote_editor" placeholder="Enter description in English"
                                        >{{ (isset($banner) ? $banner->desc_en : null) }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="desc_bn">Description (Bangla)</label>
                                <textarea type="text" name="desc_bn" id="" class="form-control summernote_editor" placeholder="Enter description in Bangla"
                                        >{{ $banner->desc_bn ?? null }}</textarea>
                                <div class="help-block"></div>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
                                <label for="alt_text">Alt Text (English)</label>
                                <input type="text" name="alt_text_en" id="alt_text_en" class="form-control"
                                        placeholder="Enter alt text" value="{{ old("alt_text_en") ? old("alt_text_en") : (isset($banner) ? $banner->alt_text_en : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text_en'))
                                    <div class="help-block">{{ $errors->first('alt_text_en') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
                                <label for="alt_text_bn">Alt Text (Bangla)</label>
                                <input type="text" name="alt_text_bn" id="alt_text_bn" class="form-control"
                                        placeholder="Enter alt text" value="{{ old("alt_text_bn") ? old("alt_text_bn") : (isset($banner) ? $banner->alt_text_bn : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('alt_text_bn'))
                                    <div class="help-block">{{ $errors->first('alt_text_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('image_name_en') ? ' error' : '' }}">
                                <label for="image_name_en">Image Name(English)</label>
                                <input type="text" name="image_name_en" id="image_name_en" class="form-control" placeholder="Enter Image name in English"
                                    value="{{ old("image_name_en") ? old("image_name_en") : (isset($banner) ? $banner->image_name_en : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name_en'))
                                <div class="help-block">{{ $errors->first('image_name_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
                                <label for="image_name_bn">Image Name (Bangla)</label>
                                <input type="text" name="image_name_bn" id="image_name_bn" class="form-control" placeholder="Enter Image name in Bangla"
                                    value="{{ old("image_name_bn") ? old("image_name_bn") : (isset($banner) ? $banner->image_name_bn : '') }}">
                                <div class="help-block"></div>
                                @if ($errors->has('image_name_bn'))
                                <div class="help-block">{{ $errors->first('image_name_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('button_label_en') ? ' error' : '' }}">
                                <label for="button_label_en">Button Label (English)</label>
                                <input type="text" name="other_attributes[button_label_en]" id="button_label_en" class="form-control" placeholder="Enter Image name in Bangla"
                                    value="{{ (!empty($banner->other_attributes['button_label_en'])) ? $banner->other_attributes['button_label_en'] : old("other_attributes.button_label_en") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('button_label_en'))
                                <div class="help-block">{{ $errors->first('button_label_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('button_label_bn') ? ' error' : '' }}">
                                <label for="button_label_bn">Button Label (Bangla)</label>
                                <input type="text" name="other_attributes[button_label_bn]" id="button_label_bn" class="form-control" placeholder="Enter Image name in Bangla"
                                    value="{{ (!empty($banner->other_attributes['button_label_bn'])) ? $banner->other_attributes['button_label_bn'] : old("other_attributes.button_label_bn") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('button_label_bn'))
                                <div class="help-block">{{ $errors->first('button_label_bn') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('button_url') ? ' error' : '' }}">
                                <label for="button_url">Button Url</label>
                                <input type="text" name="other_attributes[button_url]" id="button_url" class="form-control" placeholder="Enter Image name in Bangla"
                                    value="{{ (!empty($banner->other_attributes['button_url'])) ? $banner->other_attributes['button_url'] : old("other_attributes.button_url") ?? '' }}">
                                <div class="help-block"></div>
                                @if ($errors->has('button_url'))
                                <div class="help-block">{{ $errors->first('button_url') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 {{ $errors->has('image') ? ' error' : '' }}">
                                <label for="mobileImg">Banner Image</label>
                                <div class="custom-file">
                                    <input type="hidden" name="image" value="{{ isset($banner) ? $banner->image : '' }}">
                                    <input type="file" name="image" class="dropify" data-height="90"
                                            data-default-file="{{ isset($banner) ? config('filesystems.file_base_url') . $banner->image : '' }}">
                                </div>
                                <span class="text-primary">Please given file type (.png, .jpg)</span>

                                <div class="help-block"></div>
                                @if ($errors->has('image'))
                                    <div class="help-block">  {{ $errors->first('image') }}</div>
                                @endif
                            </div>


                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        // Image Dropify
        $(function () {
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an Image File to upload',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                },
            });
        });
    </script>
@endpush
