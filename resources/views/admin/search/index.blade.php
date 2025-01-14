@extends('layouts.admin')
@section('title', 'Search Setup')
@section('card_name', 'Popular Search')

@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <h4 class="pb-1"><strong>Settings</strong></h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th width="32%">Limit</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $s)
                                <tr>

                                    <td>
                                        {{ $s->type }} 

                                    </td>
                                    <td class="limit_clmn">
                                        {{ $s->limit }} 
                                        <a class="text-info edit_limit" limit="{{$s->limit}}" href="{{$s->id}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                    <div class="col-md-8 col-xs-12">
                        <h4 class="pb-1"><strong>Popular Search</strong>
                         <a href="{{ url('popular-search-create') }}" class="btn btn-sm btn-info pull-right">
                                Add Keyword
                            </a>
                        </h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Keyword</th>
                                    <th>url</th>
                                    <th width="22%">Status</th>
                                    <th width="22%">Action</th>

                                </tr>
                            </thead>
                            <tbody class="popular_sortable">
                                @foreach($popular as $p)
                                <tr  data-index="{{ $p->id }}" data-position="{{ $p->sort }}">
                                    <td>
                                        <i class="icon-cursor-move icons"></i> 
                                        {{ $p->keyword }} 
                                    </td>
                                    <td>
                                        {{ $p->url }} 
                                    </td>

                                    <td class="text-center">
                                        @if($p->status == 1)
                                        <a href="{{$p->id}}" class="btn btn-sm btn-success popular_status">Active</a>
                                        @else
                                        <a href="{{$p->id}}" class="btn btn-sm btn-warning popular_status">Inactive</a>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <a class="text-info edit_package" href="{{url('search-popular-edit/'.$p->id)}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <a class="text-danger delete_keyword" href="{{url('popular-search-delete/'.$p->id)}}">
                                            <i class="la la-trash"></i>
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


    /*######################################### limit Javascript ##################################################*/



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
    
    
    //status change of home showing of category
        $(".table").on('click', '.popular_status', function (e) {
            e.preventDefault();

            var kwId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("popular-status-change")}}/'+kwId,
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

                        if (result.show_status === 1) {
                            btn = '<a href="' + kwId + '" class="btn btn-sm btn-success popular_status">Active</a>';

                        } else {
                            btn = '<a href="' + kwId + '" class="btn btn-sm btn-warning popular_status">Inactive</a>';
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
        
        
         function saveNewPositions(save_url)
        {
            var positions = [];
            $('.popular_sortable tr').each(function () {
                positions.push([
                    $(this).attr('data-index'),
                    $(this).attr('data-position')
                ]);
            });
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

        $(".popular_sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1));
                    }
                });
                var save_url = "{{ url('popular-search-sort-change') }}";
                saveNewPositions(save_url);
            }
        });
        
        
        $('.delete_keyword').on('click', function(){
            var conf = confirm("Do you want to delete this keyword?");
            if(conf){
                return true;
            }
            return false;
        });




});


</script>
@endpush




