<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <h4 class="pb-1"><strong>Categories/Manus</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="35%">Name</th>
                            <th width="">Banner</th>
                            <th width="35%">Home</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="category_sortable">
                            @php
                               // dd($categories);
                            @endphp
                        @foreach($categories as $cat)
                            <tr data-index="{{ $cat->id }}" data-position="{{ $cat->home_sort }}">

                                <td class="category_name">
                                    <i class="icon-cursor-move icons"></i>
                                    {{ $cat->name }}

                                </td>

                                <td class="banner_photo">
                                    <img src="{{ config('filesystems.file_base_url') . $cat->banner_photo }}" height="40px">

                                </td>

                                <td>

                                    @if($cat->home_show == 1)
                                        <a href="{{$cat->id}}" class="btn btn-sm btn-success category_home_show">Showing</a>
                                    @else
                                        <a href="{{$cat->id}}" class="btn btn-sm btn-warning category_home_show">Hidden</a>
                                    @endif

                                </td>
                                <td>
                                    <a class="text-info edit_category" href="{{$cat->id}}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-7 col-xs-12 cat_update_form" style="display: none;">
                    <h4 class="pb-1"><strong>Update Category</strong></h4>
                    <hr>
                    <form method="POST" action="{{ url('business/update-category') }}" class="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"  class="cat_id" name="cat_id">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12 mb-1">
                                <label>Name (EN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_en" required name="name_en" placeholder="Name EN">
                            </div>
                            <div class="col-md-6 col-xs-12 mb-1">
                                <label>Name (BN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_bn" required name="name_bn" placeholder="Name BN">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>URL Slug EN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control page_url" required name="url_slug" placeholder="URL EN">
                                <small class="text-info">
                                    <strong>i.e:</strong> packages (no spaces and slash)<br>
                                </small>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>URL Slug BN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control page_url_bn" required name="url_slug_bn" placeholder="URL BN">
                                <small class="text-info">
                                    <strong>i.e:</strong> প্যাকেজ (no spaces and slash)<br>
                                </small>
                            </div>


                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label>Banner (Web)</label>
                                <input type="file" class="dropify_category" name="banner_web" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]' id="banner_web">

                                <input type="hidden" class="old_web_img" name="old_web_img">

                                <p class="banner_web"></p>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Banner (Mobile)</label>
                                <input type="file" class="dropify_category" name="banner_mobile" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <input type="hidden" class="old_mob_img" name="old_mob_img">


                                <p class="banner_mobile"></p>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_title_en') ? ' error' : '' }}">
                                <label for="banner_title_en">Banner Title EN</label>
                                <input type="text" name="banner_title_en"  class="form-control banner_title_en" placeholder="Enter banner title in English"
                                       value="">
                                <div class="help-block"></div>
                                @if ($errors->has('banner_title_en'))
                                    <div class="help-block">  {{ $errors->first('banner_title_en') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_title_bn') ? ' error' : '' }}">
                                <label for="banner_title_bn_bn">Banner Title BN</label>
                                <input type="text" name="banner_title_bn"  class="form-control banner_title_bn" placeholder="Enter banner title in Bangla"
                                       value="">
                                <div class="help-block"></div>
                                @if ($errors->has('banner_title_bn_bn'))
                                    <div class="help-block">  {{ $errors->first('banner_title_bn') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_desc_en') ? ' error' : '' }}">
                                <label>Banner Description EN</label>
                                <textarea class="form-control banner_desc_en" rows="3" name="banner_desc_en"
                                          placeholder="Enter Banner short description in English"></textarea>
                                <small class="text-info">
                                    {{--                                    <strong>Note: </strong> JSON-LD (Recommended by Google)--}}
                                </small>
                            </div>

                            <div class="form-group col-md-6 {{ $errors->has('banner_desc_bn') ? ' error' : '' }}">
                                <label>Banner Description BN</label>
                                <textarea class="form-control banner_desc_bn" rows="3" name="banner_desc_bn"
                                          placeholder="Enter Banner short description in Bangla"></textarea>
                                <small class="text-info">
                                    {{--                                    <strong>Note: </strong> JSON-LD (Recommended by Google)--}}
                                </small>
                            </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Banner Photo Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control banner_name" required name="banner_name" placeholder="Photo Name">

                            {{--                                    <input type="hidden" class="old_banner_name" name="old_banner_name">--}}

                            {{--                                    <small class="text-info">--}}
                            {{--                                        <strong>i.e:</strong> package-banner (no spaces)<br>--}}
                            {{--                                    </small>--}}
                            {{--                                </div>--}}
                        </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Alt Text</label>
                                    <input type="text" class="form-control alt_text" name="alt_text" placeholder="Alt Text">
                                </div>



                            <div class="form-group row">

                                <div class="col-md-12 col-xs-12">
                                    <label>Schema Markup</label>
                                    <textarea class="form-control schema_markup" rows="7" name="schema_markup"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> JSON-LD (Recommended by Google)
                                    </small>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Page Header (HTML)</label>
                                    <textarea class="form-control html_header" rows="7" name="page_header"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <label>Page Header Bangla (HTML)</label>
                                    <textarea class="form-control html_header_bn" rows="7" name="page_header_bn"></textarea>
                                    <small class="text-info">
                                        <strong>Note: </strong> Title, meta, canonical and other tags
                                    </small>
                                </div>

                            <div class="col-md-4 col-xs-12">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control html_header_bn" rows="7" name="page_header_bn"></textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                        </div>

                        <input type="hidden" class="old_web" name="old_web">
                        <input type="hidden" class="old_mobile" name="old_mobile">

                        <button type="submit" class="btn btn-sm btn-info pull-right">Update</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">

            <div class="row">



                <div class="col-md-6 col-xs-12">
                    <h4><strong>Home Banner</strong></h4>
                    <small><strong class="text-danger">Note: </strong>Every new photo will replace previous one.</small>
                    <hr>
                    <div class="row">

                        @foreach($banners as $b)
                            <div class="col-md-6 col-xs-12">

                                @php
                                    if($b->home_sort == 1){
                                    $sort = "Left";
                                    }else{
                                    $sort = "Right";
                                    }
                                @endphp


                                <label for="message">Banner Photo Desktop ({{$sort}})</label>

                                @if($b->image_name == "")
                                    <img class="photo_{{$sort}}" src="" width="100%" />
                                @else
                                    <img class="photo_{{$sort}}" src="{{ config('filesystems.file_base_url') . $b->image_name }}" alt="Home Banner Image" width="100%" />
                                @endif

                                <form method="POST" class="form uploadBusinessBanner" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        @if($b->image_name == '')
                                            <input type="file" class="dropify" name="banner_photo" data-height="80"
                                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]' required>
                                        @else
                                            <input type="file" class="dropify" name="banner_photo" data-height="80"
                                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                        @endif
                                        <input type="hidden" name="home_sort" value="{{$b->home_sort}}">
                                        <input type="hidden" class="old_photo_{{$sort}}" name="old_photo" value="{{$b->image_name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Banner Photo Mobile ({{$sort}})</label>

                                        @if($b->image_name_mobile == "")
                                            <img class="photo_mobile_{{$sort}}" src="" width="100%" />
                                        @else
                                            <img class="photo_mobile_{{$sort}}" src="{{ config('filesystems.file_base_url') . $b->image_name_mobile }}" alt="Home Banner Image" width="100%" />
                                        @endif
                                        @if($b->image_name_mobile == '')
                                            <input type="file" class="dropify" name="banner_photo_mobile" data-height="80"
                                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]' required>
                                        @else
                                            <input type="file" class="dropify" name="banner_photo_mobile" data-height="80"
                                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                        @endif
                                        <input type="hidden" class="old_photo_mobile_{{$sort}}" name="old_photo_mobile" value="{{$b->image_name_mobile}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text</label>
                                        <input type="text" class="form-control" value="{{ $b->alt_text }}" name="alt_text">
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-sm btn-info" type="submit">Upload</button>
                                    </div>

                                </form>


                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-md-6 col-xs-12">
                    <h4><strong>Sliding Speed</strong></h4>
                    <small><strong class="text-danger">Note: </strong>Speed in Seconds.</small>
                    <hr>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="55%">Enterprise Solution</th>
                            <th width="55%">Home News</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                                <td>
                                    <input type="text" class="form-control enterprise_speed" value="{{ $slidingSpeed->enterprise_speed ?? '' }}" disabled="disabled">

                                </td>
                                <td class="category_name">
                                    <input type="text" class="form-control news_speed" value="{{ $slidingSpeed->news_speed ?? '' }}" disabled="disabled">
                                </td>
                                <td class="text-center">

                                <a href="javascript:;" class="btn btn-sm btn-success update_slider_speed">Update</a>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>


@push('page-js')

    <script>
        $(function () {

        function dropify(){
                $('.dropify_category').dropify({
                    messages: {
                        'default': 'Browse for an Image File to upload',
                        'replace': 'Click to replace',
                        'remove': 'Remove',
                        'error': 'Choose correct file format'
                    }
                });
            }
            dropify();

        /*######################################### Category Javascript ##################################################*/


            $('.edit_category').on('click', function (e) {
                e.preventDefault();

                let catId = $(this).attr('href');
                $('.cat_id').val(catId);
                $(".cat_update_form").show(200);
                $.ajax({
                    url: '{{ url("business-category-get")}}/' + catId,
                    type: 'GET',
                    cache: false,
                    success: function (result) {
                        console.log(result);
                        $('.name_en').val(result.name);
                        $('.name_bn').val(result.name_bn);
                        $('.alt_text').val(result.alt_text);

                        $('.banner_title_en').val(result.banner_title_en);
                        $('.banner_title_bn').val(result.banner_title_bn);
                        $('.banner_desc_en').val(result.banner_desc_en);
                        $('.banner_desc_bn').val(result.banner_desc_bn);

                        $('.old_web_img').val(result.banner_photo);
                        $('.old_mob_img').val(result.banner_image_mobile);
                        $('.page_url').val(result.url_slug);
                        $('.page_url_bn').val(result.url_slug_bn);
                        $('.banner_name').val(result.banner_name);
                        $('.old_banner_name').val(result.banner_name);
                        $('.html_header').val(result.page_header);
                        $('.html_header_bn').val(result.page_header_bn);
                        $('.schema_markup').val(result.schema_markup);

                        $('.banner_web').html("");
                        if (result.banner_photo != null) {

                            var bannerWeb = "<img src='" + "{{ config('filesystems.file_base_url') }}" + result.banner_photo + "' width='100%'>";
                            $('.banner_web').html(bannerWeb);

                        }

                        $('.banner_mobile').html("");
                        if (result.banner_image_mobile != null) {
                            var bannerMob = "<img src='" + "{{ config('filesystems.file_base_url') }}" + result.banner_image_mobile + "' width='100%'>";
                            $('.banner_mobile').html(bannerMob);
                        }

                        if (result.status == '1') {
                            $(".status_active").attr('checked', 'checked');
                        } else {
                            $(".status_inactive").attr('checked', 'checked');
                        }

                        dropify();

                        /* Need to check
                        let drop = $('.dropify_category').dropify({
                            messages: {
                                'default': 'Browse',
                                'replace': 'Click to replace',
                                'remove': 'Remove',
                                'error': 'Choose correct file format'
                            }
                        });*/

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed',
                            type: 'error',
                        });
                    }

                });
            /*});*/

        });



            /* Category name input view */
            $(".category_name").on('click', 'a.edit_category_name', function (e) {
                e.preventDefault();

                let name = $(this).attr('name');
                let catId = $(this).attr('href');
                let type = $(this).attr("type");
                let input = "<input style='width:80%' class='form-control pull-left' type='text' value='" + name + "'>\n\
                    <a class='pull-left text-success save_cat_name' type='" + type + "' href='" + catId + "'><i class='mt-1 la la-save'></i></a>";
                $(this).parent('.category_name').html(input);

            });

            //update business category name
            $(".category_name").on('click', '.save_cat_name', function (e) {
                e.preventDefault();

                let newName = $(this).parent('td').find('input').val();
                let catId = $(this).attr('href');
                let type = $(this).attr("type");
                let thisObj = $(this);

                $.ajax({
                    url: '{{ route("business.category.name.save")}}',
                    type: 'GET',
                    cache: false,
                    data: {
                        catId: catId,
                        type: type,
                        name: newName
                    },
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: "Changed",
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            if (type == 'en') {
                                let htmlView = '<i class="icon-cursor-move icons"></i> ' + result.name + ' <a class="text-info edit_category_name" type="en" href="' + catId + '" name="' + result.name + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                                $(thisObj).parent('.category_name').html(htmlView);
                            } else {
                                let htmlView = result.name_bn + ' <a class="text-info edit_category_name" type="bn" href="' + catId + '" name="' + result.name_bn + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                                $(thisObj).parent('.category_name').html(htmlView);
                            }


                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }
                        $(".dropify-clear").trigger("click");

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to upload payment card excel',
                            type: 'error',
                        });
                    }
                });

            });


            /* cagegory banner upload */
            $('.uploadCategoryBanner').submit(function (e) {
                e.preventDefault();

                swal.fire({
                    title: 'File Uploading.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                let formData = new FormData($(this)[0]);
                let thisObj = $(this);

                $.ajax({
                    url: '{{ route("business.category.banner.save")}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: result.message,
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            //change photo in the view
                            let photoUrl = '<img src="{{ config('filesystems.file_base_url')}}' + result.banner_photo + '" height="40px">';

                            thisObj.parents('tr').find('.banner_photo').html(photoUrl);


                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }
                        $(".dropify-clear").trigger("click");

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to upload payment card excel',
                            type: 'error',
                        });
                    }
                });

            });



            //status change of home showing of category
            $(".table").on('click', '.category_home_show', function (e) {
                e.preventDefault();

                var catId = $(this).attr('href');
                var thisObj = $(this);

                $.ajax({
                    url: '{{ route("business.category.home.status.change")}}',
                    cache: false,
                    type: "GET",
                    data: {
                        catId: catId
                    },
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Changed',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            var btn;

                            if (result.show_status === 1) {
                                btn = '<a href="' + catId + '" class="btn btn-sm btn-success category_home_show">Showing</a>';

                            } else {
                                btn = '<a href="' + catId + '" class="btn btn-sm btn-warning category_home_show">Hidden</a>';
                            }
                            $(thisObj).parent('td').html(btn);

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 2000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Status change process failed!',
                            type: 'error',
                        });
                    }
                });

            });


            //change sliding speed
            $(".update_slider_speed").on('click', function () {
                var btn = '<a href="javascript:;" class="btn btn-sm btn-success save_sliding_speed">Save</a>';
                $(this).parent("td").html(btn);
                $(this).remove();
                $(".enterprise_speed").removeAttr('disabled');
                $(".news_speed").removeAttr('disabled');

            });

            //save sliding speed

            $(".table").on('click', '.save_sliding_speed', function () {
                var enSpeed = $(".enterprise_speed").val();
                var newsSpeed = $(".news_speed").val();

                $.ajax({
                    url: '{{ route("business.sliding.speed.save")}}',
                    cache: false,
                    type: "GET",
                    data: {
                        enSpeed: enSpeed,
                        newsSpeed: newsSpeed,
                    },
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Saved',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $(".enterprise_speed").attr('disabled', 'disabled');
                            $(".news_speed").attr('disabled', 'disabled');

                            $(".update_slider_speed").text('Update').removeClass('save_sliding_speed');

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 2000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Process failed!',
                            type: 'error',
                        });
                    }
                });


            });



            function saveNewPositions(save_url)
            {
                var positions = [];
                $('.update').each(function () {
                    positions.push([
                        $(this).attr('data-index'),
                        $(this).attr('data-position')
                    ]);
                })
                $.ajax({
                    type: "GET",
                    url: save_url,
                    data: {
                        update: 1,
                        position: positions
                    },
                    success: function (data) {
                    },
                    error: function () {
                        swal.fire({
                            title: 'Failed to sort data',
                            type: 'error',
                        });
                    }
                });
            }

            $(".category_sortable").sortable({

                update: function (event, ui) {
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('update')
                        }
                    });
                    var save_url = "{{ url('business-category-sort-change') }}";
                    saveNewPositions(save_url);
                }
            });

            let drop = $('.dropify_category').dropify({
                messages: {
                    'default': 'Browse',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });


            /*######################################### Home Banner Javascript ##################################################*/

            //show dropify for home banners
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for an photo to upload/Replace',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });

            /* home top banner photo upload  */
            $('.uploadBusinessBanner').submit(function (e) {
                e.preventDefault();

                swal.fire({
                    title: 'File Uploading.Please Wait ...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                let formData = new FormData($(this)[0]);

                $.ajax({
                    url: '{{ route("business.banner.photo.save")}}',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: result.message,
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            //change photo in the view
                            let photoUrl = "{{ config('filesystems.file_base_url')}}" + result.photo;
                            let photoMob = "{{ config('filesystems.file_base_url')}}" + result.photo_mob;

                            if (result.sort == 1) {
                                $(".photo_Left").attr('src', photoUrl);
                                $(".old_photo_Left").val(result.photo);

                                $(".photo_mobile_Left").attr('src', photoMob);
                                $(".old_photo_mobile_left").val(result.photo_mob);


                            } else {
                                $(".photo_Right").attr('src', photoUrl);
                                $(".old_photo_Right").val(result.photo);

                                $(".photo_mobile_Right").attr('src', photoMob);
                                $(".old_photo_mobile_Right").val(result.photo_mob);
                            }


                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                type: 'error',
                            });
                        }
                        $(".dropify-clear").trigger("click");

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed to upload payment card excel',
                            type: 'error',
                        });
                    }
                });

            });

        });

    </script>
@endpush
