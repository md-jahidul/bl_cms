<div class="row mt-2">

    <div class="col-md-12 col-xs-12">
        <div class="col-md-3 col-xs-12 pull-left">
            <select name="brand" class="form-control filter" id="brand">
                <option value=""> Select Brand</option>
                @foreach($brands as $b)
                <option value="{{$b['brand']}}">{{$b['brand']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-8 col-xs-12 pull-right">
            <a href="javascript:;" class="btn btn-danger all_offer_delete float-right">Delete All</a>
        </div>

    </div>



    <div class="col-md-12">
        <table class="table table-striped table-bordered dataTable"
               id="device_offer_list" role="grid">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>brand</th>
                    <th>model</th>
                    <th>Free Data</th>
                    <th>Bonus Data</th>
                    <th>Available Shop</th>
                    <th>Status</th>
                    <th class="filter_data">Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@push('page-js')


<script>
    $(function () {





        $("#device_offer_list").dataTable({
            scrollX: true,
            processing: true,
            searching: false,
            serverSide: true,
            ordering: false,
            autoWidth: false,
            pageLength: 20,
            lengthChange: false,
            ajax: {
                url: '{{ route("deviceoffer.list.ajax") }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    brand: function () {
                        return $("#brand").val();
                    }
                }
            },
            columns: [

                {
                    name: 'sl',
                    render: function () {
                        return null;
                    }
                },
                {
                    name: 'brand',
                    render: function (data, type, row) {
                        return row.brand;
                    }
                },
                {
                    name: 'model',
                    render: function (data, type, row) {
                        return row.model;
                    }
                },
                {
                    name: 'free_data',
                    render: function (data, type, row) {
                        return row.free_data;
                    }
                },
                {
                    name: 'bonus_data',
                    render: function (data, type, row) {
                        return row.bonus_data;
                    }
                },
                {
                    name: 'available_shop',
                    render: function (data, type, row) {
                        return row.available_shop;
                    }
                },
                {
                    name: 'status',
                    render: function (data, type, row) {
                        return row.status;
                    }
                },
                {
                    name: 'actions',
                    className: 'filter_data',
                    render: function (data, type, row) {
                        let detail_question_url = "{{ URL('delete-device-offer') }}" + "/" + row.id;
                        return `<div class="btn-group" role="group" aria-label="Delete">
                        <a href=" ` + detail_question_url + ` "class="btn btn-sm btn-icon btn-outline-danger delete_offer"><i class="la la-trash"></i></a>
                      </div>`
                    }
                }
            ],
            "fnCreatedRow": function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }

        });

        $(document).on('change', '.filter', function (e) {
            $('#device_offer_list').DataTable().ajax.reload();
        });



        //change show/hide status of device offer
        $("#device_offer_list").on('click', '.offer_change_status', function (e) {
            var offerId = $(this).attr('href');

            $.ajax({
                url: '{{ route("offer.status.change")}}',
                cache: false,
                type: "GET",
                data: {
                    offerId: offerId
                },
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Device offer status is changed!',
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        $('#device_offer_list').DataTable().ajax.reload();

                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            timer: 3000,
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
            e.preventDefault();
        });

        //delete device offer
        $("#device_offer_list").on('click', '.delete_offer', function (e) {
            var deleteUrl = $(this).attr('href');
            var cnfrm = confirm("Do you want to delete this offer?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Device offer is deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#device_offer_list').DataTable().ajax.reload();

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 3000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Delete process failed!',
                            type: 'error',
                        });
                    }
                });
            }
            e.preventDefault();
        });
        //delete all device offer
        $('.all_offer_delete').on('click', function (e) {
            var deleteUrl = "{{ URL('delete-device-offer') }}";
            var cnfrm = confirm("Do you want to delete all offer?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'All device offers are deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#device_offer_list').DataTable().ajax.reload();

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 3000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Delete process failed!',
                            type: 'error',
                        });
                    }
                });
            }
            e.preventDefault();
        });

    });
</script>

@endpush



