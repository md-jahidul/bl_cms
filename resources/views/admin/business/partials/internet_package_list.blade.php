<div class="row mt-2">

    <div class="col-md-12 col-xs-12">

        <div class="col-md-8 col-xs-12 pull-right">
            <a href="javascript:;" class="btn btn-danger all_package_delete float-right">Delete All</a>
        </div>

    </div>



    <div class="col-md-12">
        <table class="table table-striped table-bordered dataTable"
               id="internet_package_list" role="grid">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Type</th>
                    <th>Data Volume</th>
                    <th>Validity</th>
                    <th>Activation USSD</th>
                    <th>Balance Check USSD</th>
                    <th>MRP</th>
                    <th>Home Show</th>
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





        $("#internet_package_list").dataTable({
            scrollX: true,
            processing: true,
            searching: false,
            serverSide: true,
            ordering: false,
            autoWidth: false,
            pageLength: 20,
//            lengthChange: false,
            "lengthMenu": [20, 25, 50, 100, 200],
            ajax: {
                url: '{{ route("business.internet.list.ajax") }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
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
                    name: 'type',
                    render: function (data, type, row) {
                        return row.type;
                    }
                },
                {
                    name: 'data_volume',
                    render: function (data, type, row) {
                        return row.data_volume;
                    }
                },
                {
                    name: 'validity',
                    render: function (data, type, row) {
                        return row.validity;
                    }
                },
                {
                    name: 'activation_ussd_code',
                    render: function (data, type, row) {
                        return row.activation_ussd_code;
                    }
                },
                {
                    name: 'balance_check_ussd_code',
                    render: function (data, type, row) {
                        return row.balance_check_ussd_code;
                    }
                },
                {
                    name: 'mrp',
                    render: function (data, type, row) {
                        return row.mrp;
                    }
                },
                {
                    name: 'home_show',
                    render: function (data, type, row) {
                        return row.home_show;
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
                        let edit_url = "{{ URL('business-internet-edit') }}" + "/" + row.id;
                        let delete_url = "{{ URL('delete-business-internet-package') }}" + "/" + row.id;
                        return `<div class="btn-group" role="group" aria-label="Delete">
                        <a href=" ` + edit_url + ` "class="btn btn-sm btn-icon btn-outline-info edit_package"><i class="la la-edit"></i></a>
                        <a href=" ` + delete_url + ` "class="btn btn-sm btn-icon btn-outline-danger delete_package"><i class="la la-trash"></i></a>
                      </div>`
                    }
                }
            ],
            "fnCreatedRow": function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }

        });



        //change home show status of internet
        $("#internet_package_list").on('click', '.package_home_show', function (e) {
            var packageId = $(this).attr('href');

            $.ajax({
                url: '{{ url("business-internet-home-show")}}/' + packageId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Changed!',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#internet_package_list').DataTable().ajax.reload();

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
                        title: 'Process failed!',
                        type: 'error',
                    });
                }
            });
            e.preventDefault();
        });

        //change activation status of internet
        $("#internet_package_list").on('click', '.package_change_status', function (e) {
            var packageId = $(this).attr('href');

            $.ajax({
                url: '{{ url("business-internet-status-change")}}/' + packageId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Internet Package status is changed!',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#internet_package_list').DataTable().ajax.reload();

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
        $("#internet_package_list").on('click', '.delete_package', function (e) {
            var deleteUrl = $(this).attr('href');
            var cnfrm = confirm("Do you want to delete this package?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Internet package is deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#internet_package_list').DataTable().ajax.reload();

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
        $('.all_package_delete').on('click', function (e) {
            var deleteUrl = "{{ URL('delete-business-internet-package') }}";
            var cnfrm = confirm("Do you want to delete all package?");
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

                            $('#internet_package_list').DataTable().ajax.reload();

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



