<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4 class="pb-1"><strong>Categories/Manus</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="55%">Name</th>
                                <th width="20%">Home</th>
                                <th width="20%">Sorting</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                            <tr>
                                <td class="category_name">{{ $cat->name }} 
                                    <a class="text-info edit_category_name" href="{{$cat->id}}" name='{{ $cat->name }}'>
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">

                                    @if($cat->home_show == 1)
                                    <a href="{{$cat->id}}" class="btn btn-sm btn-success category_home_show">Showing</a>
                                    @else
                                    <a href="{{$cat->id}}" class="btn btn-sm btn-warning category_home_show">Hidden</a>
                                    @endif

                                </td>
                                <td class="home_sorting text-center">
                                    {{ $cat->home_sort }} 
                                    <a class="text-info edit_category_sorting" href="{{$cat->id}}" sort="{{ $cat->home_sort }}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
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
                                    <input type="file" class="dropify" name="banner_photo" data-height="80"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]' required/>
                                    <input type="hidden" name="home_sort" value="{{$b->home_sort}}">
                                    <input type="hidden" class="old_photo_{{$sort}}" name="old_photo" value="{{$b->image_name}}">
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
            let input = "<input style='width:80%' class='form-control pull-left' type='text' value='" + name + "'>\n\
                    <a class='pull-left text-success save_cat_name' href='" + catId + "'><i class='mt-1 la la-save'></i></a>";
            $(this).parent('.category_name').html(input);

        });

        //update business category name
        $(".category_name").on('click', '.save_cat_name', function (e) {
            e.preventDefault();

            let newName = $(this).parent('td').find('input').val();
            let catId = $(this).attr('href');
            let thisObj = $(this);

            $.ajax({
                url: '{{ route("business.category.name.save")}}',
                type: 'GET',
                cache: false,
                data: {
                    catId: catId,
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

                        let htmlView = result.name + ' <a class="text-info edit_category_name" href="' + catId + '" name="' + result.name + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                        $(thisObj).parent('.category_name').html(htmlView);


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


        /* Home and landing page category sorting input view */
        $(".home_sorting").on('click', 'a.edit_category_sorting', function (e) {
            e.preventDefault();

            let sort = $(this).attr('sort');
            let catId = $(this).attr('href');
            let input = "<input style='width:75%' class='form-control pull-left' type='text' value='" + sort + "'>\n\
                    <a class='pull-right text-success save_sorting' href='" + catId + "'><i class='la la-save'></i></a>";
            $(this).parent('.home_sorting').html(input);

        });


        $(".home_sorting").on('keypress', 'input', function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });



        //save category sorting
        $(".home_sorting").on('click', '.save_sorting', function (e) {
            e.preventDefault();

            let newSort = $(this).parent('td').find('input').val();
            let catId = $(this).attr('href');
            let thisObj = $(this)

            $.ajax({
                url: '{{ route("business.category.sort.save")}}',
                type: 'GET',
                cache: false,
                data: {
                    catId: catId,
                    sort: newSort
                },
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: "Changed",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        let htmlView = result.sort + ' <a class="text-info edit_category_sorting" href="' + catId + '" sort="' + result.sort + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                        $(thisObj).parent('.home_sorting').html(htmlView);


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
                        title: 'Failed',
                        type: 'error',
                    });
                }
            });

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