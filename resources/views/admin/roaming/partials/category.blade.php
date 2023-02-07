<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <h4 class="pb-1"><strong>Categories/Manus</strong></h4>
            <div class="row">

                <div class="col-md-12 col-xs-12">

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="22%">Name (EN)</th>
                            <th width="22%">Name (BN)</th>
                            <th width="">Banners Web</th>
                            <th width="">Banners Mobile</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="category_sortable">
                        @foreach($categories as $cat)
                            <tr data-index="{{ $cat->id }}" data-position="{{ $cat->sort }}">

                                <td class="category_name cursor-move">
                                    <i class="icon-cursor-move icons"></i>

                                    @if($cat->status == 1)
                                        <strong class="text-info">{{ $cat->name_en }} </strong>
                                    @else
                                        <i class="text-muted">{{ $cat->name_en }} </i>
                                    @endif


                                </td>
                                <td class="category_name">
                                    {{ $cat->name_bn }}
                                </td>
                                <td class="banner_photo_web">
                                    <img src="{{ config('filesystems.file_base_url') . $cat->banner_web }}" height="40px">

                                </td>
                                <td class="banner_photo_mobile">
                                    <img src="{{ config('filesystems.file_base_url') . $cat->banner_mobile }}" height="40px">

                                </td>
                                <td class="text-center">

                                    <a href="{{$cat->id}}" class=" category_edit">
                                        <i class="la la-edit"></i>
                                    </a>

                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-12 col-xs-12 cat_update_form" style="display: none;">
                    <br>
                    <h4 class="pb-1"><strong>Update Category</strong></h4>
                    <hr>
                    <form method="POST" action="{{ url('roaming/update-category') }}" class="form uploadCategoryBanner" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"  class="cat_id" name="cat_id">
                        <div class="form-group row">
                            <div class="col-md-3 col-xs-12">
                                <label>Name (EN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_en" required name="name_en" placeholder="Name EN">
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <label>Name (BN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_bn" required name="name_bn" placeholder="Name BN">
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <label>URL EN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control page_url slug-convert" required name="page_url" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> Offer (no spaces and slash)<br>
                                </small>
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <label>URL BN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control page_url_bn slug-convert" required name="page_url_bn" placeholder="URL">
                                <small class="text-info">
                                    <strong>i.e:</strong> অফার (no spaces and slash)<br>
                                </small>
                            </div>

                            {{--                            <div class="col-md-3 col-xs-12">--}}
                            {{--                                <label>Banner Name Web EN<span class="text-danger">*</span></label>--}}
                            {{--                                <input type="text" class="form-control banner_name slug-convert" required name="banner_name" placeholder="Enter Web English Name">--}}
                            {{--                                <small class="text-info">--}}
                            {{--                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>--}}
                            {{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
                            {{--                                </small>--}}
                            {{--                                @if($errors->has('banner_name'))--}}
                            {{--                                    <div class="help-block text-danger">{{ $errors->first('banner_name') }}</div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}

                            {{--                            <div class="col-md-3 col-xs-12">--}}
                            {{--                                <label>Banner Name Web BN<span class="text-danger">*</span></label>--}}
                            {{--                                <input type="text" class="form-control banner_name_web_bn slug-convert" required name="banner_name_web_bn" placeholder="Enter Web Bengali Name">--}}
                            {{--                                <small class="text-info">--}}
                            {{--                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>--}}
                            {{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
                            {{--                                </small>--}}
                            {{--                                @if($errors->has('banner_name_web_bn'))--}}
                            {{--                                    <div class="help-block text-danger">{{ $errors->first('banner_name_web_bn') }}</div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}

                            {{--                            <div class="col-md-3 col-xs-12">--}}
                            {{--                                <label>Banner Name Mobile EN<span class="text-danger">*</span></label>--}}
                            {{--                                <input type="text" class="form-control banner_name_mobile_en slug-convert" required name="banner_name_mobile_en" placeholder="Enter Mobile English Name">--}}
                            {{--                                <small class="text-info">--}}
                            {{--                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>--}}
                            {{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
                            {{--                                </small>--}}
                            {{--                                @if($errors->has('banner_name_mobile_en'))--}}
                            {{--                                    <div class="help-block text-danger">{{ $errors->first('banner_name_mobile_en') }}</div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}

                            {{--                            <div class="col-md-3 col-xs-12">--}}
                            {{--                                <label>Banner Name Mobile BN<span class="text-danger">*</span></label>--}}
                            {{--                                <input type="text" class="form-control banner_name_mobile_bn slug-convert" required name="banner_name_mobile_bn" placeholder="Enter Mobile Bengali Name">--}}
                            {{--                                <small class="text-info">--}}
                            {{--                                    <strong>i.e:</strong> about-roaming-banner (no spaces)<br>--}}
                            {{--                                    <strong>Note: </strong> Don't need MIME type like jpg,png--}}
                            {{--                                </small>--}}
                            {{--                                @if($errors->has('banner_name_mobile_bn'))--}}
                            {{--                                    <div class="help-block text-danger">{{ $errors->first('banner_name_mobile_bn') }}</div>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}

                        </div>


                        <div class="form-group row">

                            <div class="col-md-3 col-xs-12">
                                <label>Banner (Web)</label>
                                <input type="file" class="dropify" name="banner_web" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <p class="banner_web"></p>
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <label>Banner (Mobile)</label>
                                <input type="file" class="dropify" name="banner_mobile" data-height="70"
                                       data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                <p class="banner_mobile"></p>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <label>Alt Text</label>
                                <input type="text" class="form-control alt_text" name="alt_text" placeholder="Alt Text">
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <label>Alt Text BN</label>
                                <input type="text" class="form-control alt_text_bn" name="alt_text_bn" placeholder="Alt Text BN">
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


                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-xs-12">
                                <label>Page Header (HTML)</label>
                                <textarea class="form-control html_header" rows="7" name="html_header"></textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <label>Page Header Bangla (HTML)</label>
                                <textarea class="form-control page_header_bn" rows="7" name="page_header_bn"></textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="col-md-4 col-xs-12">
                                <label>Schema Markup</label>
                                <textarea class="form-control schema_markup" rows="7" name="schema_markup"></textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <label class="display-block">&nbsp;</label>

                                <label class="mr-1">
                                    <input type="radio" name="status" value="1" class="status_active"> Active
                                </label>

                                <label><input type="radio" name="status" value="0" class="status_inactive"> Inactive</label>
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

@push('page-js')
    <script src="{{ asset('app-assets/js/scripts/slug-convert/convert-url-slug.js') }}" type="text/javascript"></script>

    <script>
        $(function () {

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
                    var save_url = "{{ url('roaming/category-sort') }}";
                    saveNewPositions(save_url);
                }
            });

            $('.category_edit').on('click', function (e) {
                e.preventDefault();

                let catId = $(this).attr('href');
                $('.cat_id').val(catId);
                $(".cat_update_form").show(200);
                $.ajax({
                    url: '{{ url("roaming/get-single-category")}}/' + catId,
                    type: 'GET',
                    cache: false,
                    success: function (result) {

                        $('.banner_title_en').val(result.banner_title_en);
                        $('.banner_title_bn').val(result.banner_title_bn);
                        $('.banner_desc_en').val(result.banner_desc_en);
                        $('.banner_desc_bn').val(result.banner_desc_bn);
                        $('.name_en').val(result.name_en);
                        $('.name_bn').val(result.name_bn);
                        $('.alt_text').val(result.alt_text);
                        $('.alt_text_bn').val(result.alt_text_bn);
                        $('.old_web').val(result.banner_web);
                        $('.old_mobile').val(result.banner_mobile);
                        $('.page_url').val(result.url_slug);
                        $('.page_url_bn').val(result.url_slug_bn);
                        $('.banner_name').val(result.banner_name);
                        $('.banner_name_web_bn').val(result.banner_name_web_bn);
                        $('.banner_name_mobile_en').val(result.banner_name_mobile_en);
                        $('.banner_name_mobile_bn').val(result.banner_name_mobile_bn);
                        $('.html_header').val(result.page_header);
                        $('.page_header_bn').val(result.page_header_bn);
                        $('.schema_markup').val(result.schema_markup);

                        $('.banner_web').html("");
                        if (result.banner_web != null) {
                            var bannerWeb = "<img src='" + "{{ config('filesystems.file_base_url') }}" + result.banner_web + "' width='100%'>";
                            $('.banner_web').html(bannerWeb);
                        }

                        $('.banner_mobile').html("");
                        if (result.banner_mobile != null) {
                            var bannerMob = "<img src='" + "{{ config('filesystems.file_base_url') }}" + result.banner_mobile + "' width='100%'>";
                            $('.banner_mobile').html(bannerMob);
                        }

                        if (result.status == '1') {
                            $(".status_active").attr('checked', 'checked');
                        } else {
                            $(".status_inactive").attr('checked', 'checked');
                        }


                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Failed',
                            type: 'error',
                        });
                    }
                });
            });

            //show dropify for  photo
            $('.dropify').dropify({
                messages: {
                    'default': 'Browse for photo',
                    'replace': 'Click to replace',
                    'remove': 'Remove',
                    'error': 'Choose correct file format'
                }
            });


        });


    </script>

@endpush
