@extends('layouts.admin')
@section('title', 'Search Setup')
@section('card_name', 'Popular Search')
@section('action')
<a href="{{ url('popular-search') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">

                <form method="POST" action="{{ route('popular.search.update')}}" class="form" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6 col-xs-12">

                            @csrf
                            <input type="hidden"  value="{{$popularSearch->id}}" name="keyword_id">

                            <div class="form-group">

                                <label>Keyword<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{$popularSearch->keyword}}" required name="keyword">

                            </div>

                            <div class="form-group text-right">
                                <button class="btn btn-sm btn-info news_submit" type="submit">Save Package</button>
                            </div>

                        </div>


                    </div>
                </form>



            </div>
        </div>
    </div>


</section>

@stop

@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')
<script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


<script>
$(function () {

    //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
        swal.fire({
            title: "{{ Session::get('sussess') }}",
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    <?php
}
if (Session::has('error')) {
    ?>

        swal.fire({
            title: "{{ Session::get('error') }}",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

<?php } ?>



    $(".keyword_type").on('change', function (e) {
        let type = $(this).val();
        if (type != "") {
            $.ajax({
                url: '{{ route("search.get.product.list")}}',
                type: 'GET',
                cache: false,
                data: {
                    type: type,
                },
                success: function (result) {

                    $(".product_list").html(result);
                },
                error: function (data) {
                    swal.fire({
                        title: 'Failed',
                        type: 'error',
                    });
                }
            });
        } else {
            $(".product_list").html("");
        }
    });


    /* change limit */
    $(".limit_clmn").on('click', 'a.edit_limit', function (e) {
        e.preventDefault();

        let limit = $(this).attr('limit');
        let settingId = $(this).attr('href');
        let input = "<input style='width:80%' class='form-control pull-left' type='text' value='" + limit + "'>\n\
                    <a class='pull-left text-success save_limit_name' href='" + settingId + "'><i class='mt-1 la la-save'></i></a>";
        $(this).parent('.limit_clmn').html(input);

    });

    //update limit
    $(".limit_clmn").on('click', '.save_limit_name', function (e) {
        e.preventDefault();

        let limit = $(this).parent('td').find('input').val();
        let settingId = $(this).attr('href');
        let thisObj = $(this);

        $.ajax({
            url: '{{ route("save.search.limit")}}',
            type: 'GET',
            cache: false,
            data: {
                limit: limit,
                settingId: settingId
            },
            success: function (result) {
                if (result.success == 1) {
                    swal.fire({
                        title: "Changed",
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    let htmlView = limit + ' <a class="text-info edit_limit" href="' + settingId + '" limit="' + limit + '">\n\
                                    <i class="la la-pencil-square"></i></a>';
                    $(thisObj).parent('.limit_clmn').html(htmlView);



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




});


</script>
@endpush




