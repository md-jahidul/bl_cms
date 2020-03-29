<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <h4 class="pb-1"><strong>Categories</strong> (Accordion Head)
            <a href="javascript:;" class="btn btn-sm btn-info pull-right create_category">Add Category</a>
            </h4>
             
            <div class="row">
               

                <div class="col-md-7 col-xs-12">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="40%">Name (EN)</th>
                                <th width="40%">Name (BN)</th>
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
                                <td class="text-center">

                                    <a href="{{$cat->id}}" class="category_edit btn btn-sm btn-outline-primary">
                                        <i class="la la-edit"></i>
                                    </a>

                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="col-md-5 col-xs-12 sample_photo">
                    <h4>Sample/Instruction</h4>
                    <img style="border: 1px solid #ddd;" src="{{asset('app-assets/images/roaming/info_tips_category.png')}}" width="100%">

                </div>

                <div class="col-md-5 col-xs-12 cat_update_form" style="display: none;">
                    <h4>Add/Update Category</h4>
                    <hr>
                    <form method="POST" action="{{ url('roaming/save-info-category') }}" class="form uploadCategoryBanner" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"  class="cat_id" name="cat_id">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label>Name (EN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_en" required name="name_en" placeholder="Name EN">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label>Name (BN) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control name_bn" required name="name_bn" placeholder="Name BN">
                            </div>

                        </div>


                        <div class="form-group row">

                            <div class="col-md-12 col-xs-12">
                                <label class="display-block">&nbsp;</label>

                                <label class="mr-1">
                                    <input type="radio" checked name="status" value="1" class="status_active"> Active
                                </label>


                                <label><input type="radio" name="status" value="0" class="status_inactive"> Inactive</label>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-sm btn-info pull-right">Save</button>
                    </form>

                </div>



            </div>

        </div>
    </div>
</div>

@push('page-js')

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
                var save_url = "{{ url('roaming/info-category-sort') }}";
                saveNewPositions(save_url);
            }
        });

        $('.create_category').on('click', function (e) {
            e.preventDefault();
            $(".sample_photo").hide();
            $(".cat_update_form").show(200);
           
        });
        
        $('.category_edit').on('click', function (e) {
            e.preventDefault();

            let catId = $(this).attr('href');
            $('.cat_id').val(catId);
            $(".sample_photo").hide();
            $(".cat_update_form").show(200);
            $.ajax({
                url: '{{ url("roaming/get-info-single-category")}}/' + catId,
                type: 'GET',
                cache: false,
                success: function (result) {

                    $('.name_en').val(result.name_en);
                    $('.name_bn').val(result.name_bn);

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