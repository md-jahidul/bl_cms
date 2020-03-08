<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4 class="pb-1"><strong>Categories/Manus</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="22%">Name (EN)</th>
                                <th width="22%">Name (BN)</th>
                                <th width="40%">Banner</th>
                                <th width="20%">Home</th>
                            </tr>
                        </thead>
                        <tbody class="category_sortable">
                            @foreach($categories as $cat)
                            <tr data-index="{{ $cat->id }}" data-position="{{ $cat->home_sort }}">

                                <td class="category_name">
                                    <i class="icon-cursor-move icons"></i>
                                    {{ $cat->name }} 
                                    <a class="text-info edit_category_name" type="en" href="{{$cat->id}}" type="" name='{{ $cat->name }}'>
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>
                                <td class="category_name">
                                    {{ $cat->name_bn }} 
                                    <a class="text-info edit_category_name" type="bn" href="{{$cat->id}}" name='{{ $cat->name_bn }}'>
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <input type="file" class="dropify_category" name="banner_photo" data-height="60"
                                                   data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                            <button class="btn btn-sm btn-info"><i class="la la-save"></i></button>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            
                                        </div>
                                    </div>

                                </td>
                                <td class="text-center">

                                    @if($cat->home_show == 1)
                                    <a href="{{$cat->id}}" class="btn btn-sm btn-success category_home_show">Showing</a>
                                    @else
                                    <a href="{{$cat->id}}" class="btn btn-sm btn-warning category_home_show">Hidden</a>
                                    @endif

                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <h4 class="pb-1"><strong>Sliding Speed</strong></h4>
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
                                    <input type="text" class="form-control enterprise_speed" value="{{ $slidingSpeed->enterprise_speed }}" disabled="disabled">

                                </td>
                                <td class="category_name">
                                    <input type="text" class="form-control news_speed" value="{{ $slidingSpeed->news_speed }}" disabled="disabled">
                                </td>
                                <td class="text-center">

                                    <a href="javascript:;" class="btn btn-sm btn-success update_slider_speed">Update</a>

                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>

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


                            <label for="message">Banner Photo ({{$sort}})</label>

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
            </div>

        </div>
    </div>
</div>


@push('page-js')

<script>
    $(function () {

        /*######################################### Category Javascript ##################################################*/



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

        $('.dropify_category').dropify({
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

                        if (result.sort == 1) {
                            $(".photo_Left").attr('src', photoUrl);
                            $(".old_photo_Left").val(result.photo);
                        } else {
                            $(".photo_Right").attr('src', photoUrl);
                            $(".old_photo_Right").val(result.photo);
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