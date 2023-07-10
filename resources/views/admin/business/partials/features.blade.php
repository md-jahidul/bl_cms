<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4 class="pb-1"><strong>Business Features</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Photo</th>
                                <th width="50%">Title</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="feature_sortable">
                            @foreach($features as $f)
                            <tr data-index="{{ $f->id }}" data-position="{{ $f->sort }}">
                                <td>
                                    <i class="icon-cursor-move icons"></i>
                                </td>
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

                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-12">
                                        <label for="Title">Title (EN)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control title" required name="title" placeholder="Title EN">
                                        @if($errors->has('title'))
                                            <div class="help-block text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label for="Title">Title (BN)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control title_bn" required name="title_bn" placeholder="Title BN">
                                        @if($errors->has('title_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-12 mb-1">
                                        <label for="Icon">Icon <span class="text-danger">*</span></label>
                                        <input type="file" class="dropify_feature" name="feature_icon" data-height="70"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <label>Icon Name EN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control icon_name_en" required name="icon_name_en" placeholder="Icon Name EN">
                                        @if($errors->has('icon_name_en'))
                                            <div class="help-block text-danger">{{ $errors->first('icon_name_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-xs-12 mb-1">
                                        <label>Icon Name BN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control icon_name_bn" required name="icon_name_bn" placeholder="Icon Name BN">
                                        @if($errors->has('icon_name_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('icon_name_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <label>Alt Text EN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control alt_text" required name="alt_text" placeholder="Alt Text EN">
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <label>Alt Text BN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control alt_text_bn" required name="alt_text_bn" placeholder="Alt Text BN">
                                    </div>
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

        $(".feature_sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('update')
                    }
                });
                var save_url = "{{ url('business-feature-sort') }}";
                saveNewPositions(save_url);
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
                    $('.home_feature_form .title_bn').val(result.title_bn);
                    $('.home_feature_form .old_photo').val(result.icon_url);
                    $('.home_feature_form .icon_name_en').val(result.icon_name_en);
                    $('.home_feature_form .icon_name_bn').val(result.icon_name_bn);
                    $('.home_feature_form .alt_text').val(result.alt_text);
                    $('.home_feature_form .alt_text_bn').val(result.alt_text_bn);


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
