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
                                    <img src="{{ config('filesystems.file_base_url') . $cat->banner_web }}" height="30px">

                                </td>
                                <td class="banner_photo_mobile">
                                    <img src="{{ config('filesystems.file_base_url') . $cat->banner_mobile }}" height="30px">

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

                $('.name_en').val(result.name_en);
                $('.name_bn').val(result.name_bn);
                $('.alt_text').val(result.alt_text);
                $('.old_web').val(result.banner_web);
                $('.old_mobile').val(result.banner_mobile);
                
                if(result.status == '1'){
                    $(".status_active").attr('checked', 'checked');
                }else{
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