@extends('layouts.admin')
@section('title', 'Loyalty Partner Images')
@section('card_name', 'Loyalty Partner Images')
@section('breadcrumb')
    <li class="breadcrumb-item active">Loyalty Partner Images</li>
@endsection
@section('head')
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
@endsection
@section('action')
    <a href="{{route('loyalty-partner-image.create')}}" class="btn btn-primary round btn-glow px-2"><i
                class="la la-plus"></i>
        Upload Loyalty Partner Image
    </a>
@endsection

@section('content')
    <section>
        <div class="col-md-12 my-2">
            <div class="row">
                @csrf
                <div class="col-md-12 mb-2 d-flex justify-content-end">
                    <button id="rest" onclick="reset()" class="ml-1 btn btn-md btn-success"><i class="la la-refresh"></i> Reset</button>
                    <a href="#" id="export" class="ml-1 btn btn-md btn-info text-white"><i class="la la-download"></i> CSV</a>
                </div>
                <div class="col-md-2">
                    <input class="form-control filter h-100 filter" name="title" placeholder="Title" id="title"/>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control filter" id="status">
                        <option value=""> Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="image_type" class="form-control filter" id="image_type">
                        <option value=""> Image Type</option>
                        <option value="banner">Banner Image</option>
                        <option value="logo">Logo Image</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-control filter" id="category">
                        <option value=""> Category</option>
                        @foreach($loyaltyPartnerCategories as $item)
                            <option value="{{$item['id']}}">{{$item['name_en']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input required type='text' class="form-control h-100 filter" name="from_date" id="from_date"
                           placeholder="Please select from date"/>
                </div>
                <div class="col-md-2">
                    <input required type='text' class="form-control h-100 filter" name="to_date" id="to_date"
                           placeholder="Please select to date"/>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="row mb-2">
                <div class="col-12">
                    <div id="grid-table" class="row">
                        <div id="grid-pagination"></div>
                    </div>
                    <div class="d-none" id="grid_card">
                        <div id="grid" class="col-md-2 col-sm-3 col-xs-4" data-image-type="banner">
                            <div class="card">
                                <div>
                                    <img class="card-img-top img-fluid" src=""
                                         alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <p class="card-text" id="grid-card-title">

                                    </p>
                                    <a href=""
                                       role="button" title="Edit"
                                       class="text-left card-edit-btn btn btn-sm btn-outline-info"><i class="la la-pencil"
                                                                                                  aria-hidden="true"></i></a>
                                    <button
                                            class="text-left card-del-btn btn btn-sm btn-outline-danger cursor-pointer"
                                            data-id=""
                                            title="Delete">
                                        <i class="la la-trash"></i>
                                    </button>
                                    <a title="Copy Url" href="javascript:;" id="copyUrl"
                                       onclick="copy();return false;"
                                       class="text-left card-copy-btn btn btn-sm btn-outline-success"><i
                                                class="la icon-link"></i></a>
                                    <span class="float-right badge badge-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        table.dataTable tbody td {
            max-height: 40px;
        }

        .card-img-top {
            max-height: 10rem;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        function getFields(){
            let formData = {
                'title': $('input[name="title"]').val(),
                'status': $('select[name="status"]').val(),
                'category': $('select[name="category"]').val(),
                'from_date': $('input[name="from_date"]').val(),
                'to_date': $('input[name="to_date"]').val()
            };

            return formData;
        }
        function generateReportUrl(){
            let formData = getFields();
            let url = "{{ url('loyalty-partner-images/report')}}" + '?title=' + formData.title + '&status=' + formData.status + "&category=" + formData.category + "&from_date=" + formData.from_date + "&to_date=" + formData.to_date;

            $("#export").attr('href', url);
        }

        function copy(host, value) {
            url = host + '/' + value;

            //navigator.clipboard.writeText(url);

            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            document.execCommand("copy");
            $temp.remove();
            Swal.fire(
                'Copied',
                'Link :  ' + url,
                'success',
            );
        }

        function deletePartnerImage(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('.delete_btn').html(),
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('loyalty-partner-image') }}/" + id,
                        method: "delete",
                        data:{
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function (res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            );
                            setTimeout(function () {
                                window.location.href = "{{ url('loyalty-partner-image') }}";
                            }, 1000)
                        }
                    })
                }
            })
        }

        function reset() {
            $('select[name="image_type"]').prop('selectedIndex',0);
            $('input[name="title"]').val('');
            $('select[name="status"]').prop("selectedIndex", 0);
            $('select[name="category"]').prop("selectedIndex", 0);
            $('input[name="from_date"]').val('');
            $('input[name="to_date"]').val('');

            init("{{ url('loyalty-partner-images/filter')}}");
        }

        function init(url, data = null) {
            generateReportUrl();
            $('#grid-table').html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: "GET",
                success: function (result) {
                    if (result.data.length) {
                        var pagination_p1 = "<nav class='col-12 m-2'>" +
                            "<ul class='pagination' style='overflow-x: auto'>" +
                            "<li class='page-item " + (result.prev_page_url ?? 'disabled') + "'>" +
                            "<a id='page-prev-link' class='page-link' href='javascript:;' tabindex='-1'>Previous</a>" +
                            "</li>";
                        var pagination_index = "";
                        for(var i = 0;i < result.last_page; i++){
                            pagination_index += "<li class='page-item "+(result.current_page == (i+1) ? 'disabled' : '')+"' ><a id='page-index-link' class='page-link' href='javascript:;' data-id='"+(i+1)+"'>"+(i+1)+"</a></li>";
                        }
                        var pagination_p2 = "<li class='page-item " + (result.next_page_url ?? 'disabled') + "'>" +
                            " <a id='page-next-link' class='page-link' href='javascript:;'>Next</a>" +
                            "</li>" +
                            "</ul>" +
                            "</nav><span class='ml-3'>Showing "+result.to+" of " + result.total +"</span>";
                        var pagination = pagination_p1 + pagination_index + pagination_p2;

                        $('#grid-table').html('');
                        $.each(result.data, function (key, value) {
                            var imageType = $('select[name="image_type"]').val();
                            var imageHtml = $("#grid_card").html();

                            $('#grid-table').append(imageHtml);
                            $("#grid-table .card-text").eq(key).html(value.title);
                            $("#grid-table .card-edit-btn").eq(key).attr('href', "{{ url('loyalty-partner-image') }}/" + value.id + "/edit");
                            $("#grid-table .card-del-btn").eq(key).attr('onclick', "deletePartnerImage(" + value.id + ")");

                            if (imageType == 'logo') {
                                $("#grid-table .card-img-top").eq(key).attr('src', value.logo_img);
                                $("#grid-table .badge").eq(key).html('logo');
                                $("#grid-table .card-copy-btn").eq(key).attr('onclick', "copy('" + "{{$host}}" + "', '" + value.logo_img + "');return false;");
                            } else {
                                $("#grid-table .badge").eq(key).html('banner');
                                $("#grid-table .card-img-top").eq(key).attr('src', value.banner_img);
                                $("#grid-table .card-copy-btn").eq(key).attr('onclick', "copy('" + "{{$host}}" + "', '" + value.banner_img + "');return false;");
                            }
                        });
                        $('#grid-table').append(pagination);
                        $("#grid-table #page-prev-link").attr('onclick', "init('" + result.prev_page_url + "');return false;");
                        $("#grid-table #page-next-link").attr('onclick', "init('" + result.next_page_url + "');return false;");

                        $("#grid-table #page-index-link").click(function(){
                            id = $(this).attr('data-id');
                            init(result.path+"?page="+id);
                        });
                    } else {
                        $('#grid-table').html('<h4 class="mx-auto mt-3  text-center font-weight-bold">No Images Found</h4>');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function filter() {
            let formData = getFields();
            let url = "{{ url('loyalty-partner-images/filter')}}" + '?title=' + formData.title + '&status=' + formData.status + "&category=" + formData.category + "&from_date=" + formData.from_date + "&to_date=" + formData.to_date;

            init(url, formData);
        }

        $(document).ready(function () {
            var date = new Date();
            date.setDate(date.getDate());
            $('#from_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true
            }).on('blur', function(ev){
                filter();
            });
            $('#to_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
            }).on('blur', function(ev){
                filter();
            });

            init("{{ url('loyalty-partner-images/filter')}}");

            $('.filter').keyup(filter);
            $('.filter').change(filter);
        });
    </script>
@endpush
