<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <h4 class="pb-1"><strong>Business News</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th width="20%">Title</th>
                                <th width="50%">News</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="news_sortable">
                            @foreach($news as $n)
                            <tr data-index="{{ $n->id }}" data-position="{{ $n->sort }}">
                                <td>
                                    <i class="icon-cursor-move icons"></i>
                                    @if($n->image_url != "")
                                    <img src="{{ config('filesystems.file_base_url') . $n->image_url }}" alt="News Photo" height="35px" />
                                    @endif
                                </td>
                                <td>
                                    <h6>{{ $n->title }}</h6>
                                    <small>{{ date("jS F, Y", strtotime($n->created_at)) }}</small>
                                </td>
                                <td>
                                    <small>{!! $n->body !!}</small>
                                </td>
                                <td>
                                    @if($n->status == 1)
                                    <a href="{{$n->id}}" class="btn btn-sm btn-success news_status">Showing</a>
                                    @else
                                    <a href="{{$n->id}}" class="btn btn-sm btn-warning news_status">Hidden</a>
                                    @endif
                                </td>
                                <td class="home_sorting text-center">
                                    <a class="text-info edit_news" href="{{$n->id}}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                    <a class="text-danger delete_news" href="{{url('business-news-delete/'.$n->id)}}">
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6 col-xs-12">
                    <h4><strong>Add/Edit Business News</strong></h4>
                    <small><strong class="text-danger">Note: </strong>These news will show only in the "Business Landing/Home Page".</small>
                    <hr>



                    <form method="POST" action="{{ route('business.news.save')}}" class="form home_news_form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-12 col-xs-12">

                                @csrf
                                <input type="hidden" class="news_id" name="news_id" value="">
                                <input type="hidden" class="old_photo" name="old_photo" value="">

                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-12">
                                        <label>Title (EN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control title" required name="title" placeholder="Title EN">
                                        @if($errors->has('title'))
                                            <div class="help-block text-danger">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Title (BN) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control title_bn" required name="title_bn" placeholder="Title BN">
                                        @if($errors->has('title_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>


                                </div>


                                <div class="form-group row">

                                    <div class="col-md-6 col-xs-12">
                                        <label for="news body">News Body (EN) <span class="text-danger">*</span></label>
                                        <textarea type="text" name="body" required class="form-control news_body"></textarea>
                                        @if($errors->has('body'))
                                            <div class="help-block text-danger">{{ $errors->first('body') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label for="news body">News Body (BN) <span class="text-danger">*</span></label>
                                        <textarea type="text" name="body_bn" required class="form-control news_body_bn"></textarea>
                                        @if($errors->has('body_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('body_bn') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-xs-12 mb-1">
                                        <label>News Photo <span class="text-danger">*</span></label>
                                        <input type="file" class="dropify_news" name="news_photo" data-height="70"
                                               data-allowed-file-extensions='["jpg", "jpeg", "png"]'>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="required">Image Name EN</label>
                                        <input type="text" class="form-control image_name_en" required name="image_name_en" placeholder="Image Name EN">
                                        @if($errors->has('image_name_en'))
                                            <div class="help-block text-danger">{{ $errors->first('image_name_en') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-xs-12 mb-1">
                                        <label>Image Name BN<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control image_name_bn" required name="image_name_bn" placeholder="Image Name BN">
                                        @if($errors->has('image_name_bn'))
                                            <div class="help-block text-danger">{{ $errors->first('image_name_bn') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Alt Text EN</label>
                                        <input type="text" class="form-control alt_text" required name="alt_text" placeholder="Alt Text EN">
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <label>Alt Text BN</label>
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



        /*######################################### News Javascript ##################################################*/



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

        $(".news_sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('update')
                    }
                });
                var save_url = "{{ url('business-news-sort') }}";
                saveNewPositions(save_url);
            }
        });


        //show dropify for news photo
        $('.dropify_news').dropify({
            messages: {
                'default': 'Browse for news photo',
                'replace': 'Click to replace',
                'remove': 'Remove',
                'error': 'Choose correct file format'
            }
        });



        $('.edit_news').on('click', function (e) {
            e.preventDefault();

            let newsId = $(this).attr('href');
            $('.home_news_form .news_id').val(newsId);
            $.ajax({
                url: '{{ url("get-single-news")}}/' + newsId,
                type: 'GET',
                cache: false,
                success: function (result) {

                    $('.home_news_form .title').val(result.title);
                    $('.home_news_form .title_bn').val(result.title_bn);
                    $('.home_news_form .old_photo').val(result.image_url);
                    $('.home_news_form .image_name_en').val(result.image_name_en);
                    $('.home_news_form .image_name_bn').val(result.image_name_bn);
                    $('.home_news_form .alt_text').val(result.alt_text);
                    $('.home_news_form .alt_text_bn').val(result.alt_text_bn);
                    $('.news_body').text(result.body);
                    $('.news_body_bn').text(result.body_bn);


                },
                error: function (data) {
                    swal.fire({
                        title: 'Failed',
                        type: 'error',
                    });
                }
            });
        });


        //change status (show/hide) of news
        $(".table").on('click', '.news_status', function (e) {
            e.preventDefault();

            var newsId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-news-status-change")}}/' + newsId,
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
                            btn = '<a href="' + newsId + '" class="btn btn-sm btn-success news_status">Showing</a>';

                        } else {
                            btn = '<a href="' + newsId + '" class="btn btn-sm btn-warning news_status">Hidden</a>';
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

        //delete news confirmation
        $(".table").on('click', '.delete_news', function (e) {
            var confrm = confirm("Do you want to delete this news?");
            if (confrm) {
                return true;
            }
            e.preventDefault();
        });


    });

</script>
@endpush