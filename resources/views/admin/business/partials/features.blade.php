<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4 class="pb-1"><strong>Business Features</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th width="50%">Title</th>
                                <th width="20%">Status</th>
                                <th width="50%">Sorting</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($features as $f)
                            <tr>
                                <td>
                                    @if($f->icon_url != "")
                                    <img src="{{ config('filesystems.file_base_url') . $f->icon_url }}" alt="Fearure Icon" height="60px" />
                                    @endif
                                </td>
                                <td>
                                    <h6>{{ $f->title }}</h6>
                                    <small class="text-bold-700 text-info">ID: #0{{$f->id}}</small>
                                </td>
                                <td>
                                    @if($f->status == 1)
                                    <a href="{{$f->id}}" class="btn btn-sm btn-success features_status">Showing</a>
                                    @else
                                    <a href="{{$f->id}}" class="btn btn-sm btn-warning features_status">Hidden</a>
                                    @endif
                                </td>

                                <td class="feature_sorting text-center">
                                    {{ $f->sort }} 
                                    <a class="text-info edit_feature_sorting" href="{{$f->id}}" sort="{{ $f->sort }}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="text-info edit_feature" href="{{$f->id}}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                    <a class="text-danger delete_feature" href="{{url('business-feature-delete/'.$f->id)}}">
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 col-xs-12">
                    <h4><strong>Add/Edit Features</strong></h4>
                    <small><strong class="text-danger">Note: </strong>These features will be assigned with Business Category Products.</small>
                    <hr>

                    <form method="POST" action="{{ route('business.feature.save')}}" class="form home_feature_form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-12 col-xs-12">

                                @csrf
                                <input type="hidden" class="feature_id" name="feature_id" value="">
                                <input type="hidden" class="old_photo" name="old_photo" value="">

                                <div class="form-group">
                                    <label for="Title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control title" required name="title" placeholder="Title">
                                </div>

                                <div class="form-group">
                                    <label for="Icon">Icon <span class="text-danger">*</span></label>
                                    <input type="file" class="dropify_feature" name="feature_icon" data-height="70"
                                           data-allowed-file-extensions='["jpg", "jpeg", "png"]'>

                                </div>



                                <div class="form-group text-right">
                                    <button class="btn btn-sm btn-info news_submit" type="submit">Save News</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@push('page-js')

<script>
    $(function () {

        /*######################################### Features Javascript ##################################################*/


        /* Change feature sorting */
        $(".feature_sorting").on('click', 'a.edit_feature_sorting', function (e) {
            e.preventDefault();

            let sort = $(this).attr('sort');
            let featureId = $(this).attr('href');
            let input = "<input style='width:75%' class='form-control pull-left' type='text' value='" + sort + "'>\n\
                    <a class='pull-right text-success save_sorting' href='" + featureId + "'><i class='la la-save'></i></a>";
            $(this).parent('.feature_sorting').html(input);

        });

        //save sorting
        $(".feature_sorting").on('click', '.save_sorting', function (e) {
            e.preventDefault();

            let newSort = $(this).parent('td').find('input').val();
            let featureId = $(this).attr('href');
            let thisObj = $(this);

            $.ajax({
                url: '{{ route("business.feature.sort.save")}}',
                type: 'GET',
                cache: false,
                data: {
                    featureId: featureId,
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

                        let htmlView = result.sort + ' <a class="text-info edit_feature_sorting" href="' + featureId + '" sort="' + result.sort + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                        $(thisObj).parent('.feature_sorting').html(htmlView);


                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            type: 'error',
                        });
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

        //number validation
        $(".feature_sorting").on('keypress', 'input', function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
        
        //change status (show/hide) of features
        $(".table").on('click', '.features_status', function (e) {
            e.preventDefault();

            var featureId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-feature-status-change")}}/' + featureId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Changed',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        var btn;

                        if (result.status === 1) {
                            btn = '<a href="' + featureId + '" class="btn btn-sm btn-success features_status">Showing</a>';

                        } else {
                            btn = '<a href="' + featureId + '" class="btn btn-sm btn-warning features_status">Hidden</a>';
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
                        title: 'Status changing process failed!',
                        type: 'error',
                    });
                }
            });

        });
        
        
          //show dropify for news photo
        $('.dropify_feature').dropify({
            messages: {
                'default': 'Browse for feature icon',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });
        
        
        //edit feature
         $('.edit_feature').on('click', function (e) {
            e.preventDefault();

            let featureId = $(this).attr('href');
            $('.home_feature_form .feature_id').val(featureId);
            $.ajax({
                url: '{{ url("get-single-feature")}}/' + featureId,
                type: 'GET',
                cache: false,
                success: function (result) {

                    $('.home_feature_form .title').val(result.title);
                    $('.home_feature_form .old_photo').val(result.icon_url);


                },
                error: function (data) {
                    swal.fire({
                        title: 'Failed',
                        type: 'error',
                    });
                }
            });
        });
        
          //delete feature confirmation
        $(".table").on('click', '.delete_feature', function (e) {
            var confrm = confirm("Do you want to delete this feature?");
            if (confrm) {
                return true;
            }
            e.preventDefault();
        });

    });

</script>
@endpush