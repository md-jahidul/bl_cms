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
                    <div class="card-body card-dashboard">
                        <form method="POST" action="{{ route('popular.search.update')}}"
                              class="form" enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
{{--                            @method('PUT')--}}
                            <div class="row">
                                <input type="hidden" name="search_keyword_id" value="{{ $popularSearch->id }}">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Keyword (English)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required
                                               name="keyword" placeholder="Popular Keyword in English"
                                        value="{{ $popularSearch->keyword }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Keyword (Bangla)<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" required name="keyword_bn"
                                               placeholder="Popular Keyword in Bangla"
                                               value="{{ $popularSearch->keyword_bn }}">
                                    </div>
                                </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label>Type<span class="text-danger">*</span></label>
                                    <select name="type" required class="form-control keyword_type">
                                        <option value="">--Select Type--</option>
                                        <option value="prepaid-internet" {{ $popularSearch->type == "prepaid-internet" ? 'selected' : ''}}>Prepaid Internet</option>
                                        <option value="prepaid-voice" {{ $popularSearch->type == "prepaid-voice" ? 'selected' : ''}}>Prepaid Voice</option>
                                        <option value="prepaid-bundle" {{ $popularSearch->type == "prepaid-bundle" ? 'selected' : ''}}>Prepaid Bundle</option>
                                        <option value="postpaid-internet" {{ $popularSearch->type == "postpaid-internet" ? 'selected' : ''}}>Postpaid Internet</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Product<span class="text-danger">*</span></label>
                                        <select required name="product" class="form-control product_list">
                                            <option>---Select Product---</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $popularSearch->product_id == $product->id ? "selected" : '' }}>{{ $product->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>
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
                }else{
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




