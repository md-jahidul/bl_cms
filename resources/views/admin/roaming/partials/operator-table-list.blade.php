<div class="row mt-2">

    <div class="col-md-12 col-xs-12">

        <div class="col-md-8 col-xs-12 pull-right">
            <a href="javascript:;" class="btn btn-danger all_operator_delete float-right">Delete All</a>
        </div>

    </div>



    <div class="col-md-12">
        <table class="table table-striped table-bordered dataTable"
               id="roaming_operator_list" role="grid">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Country</th>
                    <th>Operator</th>
                    <th>Tap Code</th>
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
        $("#roaming_operator_list").dataTable({
            scrollX: true,
            processing: true,
            searching: true,
            serverSide: true,
            ordering: false,
            autoWidth: false,
            pageLength: 20,
//            lengthChange: false,
            "lengthMenu": [10, 20, 25, 50, 100, 200],
            ajax: {
                url: '{{ route("roaming.operator.list.ajax") }}',
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
                    name: 'country_en',
                    render: function (data, type, row) {
                        return row.country_en;
                    }
                },
                {
                    name: 'operator_en',
                    render: function (data, type, row) {
                        console.log(row);
                        return row.operator_en;
                    }
                },
                {
                    name: 'tap_code',
                    render: function (data, type, row) {
                        return row.tap_code;
                    }
                },
                {
                    name: 'actions',
                    className: 'filter_data',
                    render: function (data, type, row) {
                        let edit_url = "{{ URL('roaming/operator/edit') }}" + "/" + row.id;
                        let delete_url = "{{ URL('roaming-operator/destroy') }}" + "/" + row.id;
                        return `<div class="btn-group" role="group" aria-label="Delete">
                    <a href=" ` + edit_url + ` "class="btn btn-sm btn-icon btn-outline-info edit_package"><i class="la la-edit"></i></a>
                    <a href=" ` + delete_url + ` "class="btn btn-sm btn-icon btn-outline-danger delete_package"><i class="la la-trash"></i></a>
                  </div>`
                    }
                }
            ],
            "fnCreatedRow": function (row, data, index) {

                console.log(row)
                $('td', row).eq(0).html(index + 1);
            }

        });


        //change show/hide status of device offer
        $("#roaming_operator_list").on('click', '.operator_change_status', function (e) {
            var packageId = $(this).attr('href');

            $.ajax({
                url: '{{ url("roaming-operator-status-change")}}/' + packageId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Roaming operator status is changed!',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('#roaming_operator_list').DataTable().ajax.reload();

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

//            {{--//change activation status of internet--}}
//            {{--$("#internet_package_list").on('click', '.operator_change_status', function (e) {--}}
//            {{--    var packageId = $(this).attr('href');--}}
//
//            {{--    $.ajax({--}}
//            {{--        url: '{{ url("business-internet-status-change")}}/' + packageId,--}}
//            {{--        cache: false,--}}
//            {{--        type: "GET",--}}
//            {{--        success: function (result) {--}}
//            {{--            if (result.success == 1) {--}}
//            {{--                swal.fire({--}}
//            {{--                    title: 'Internet Package status is changed!',--}}
//            {{--                    type: 'success',--}}
//            {{--                    timer: 2000,--}}
//            {{--                    showConfirmButton: false--}}
//            {{--                });--}}
//
//            {{--                $('#internet_package_list').DataTable().ajax.reload();--}}
//
//            {{--            } else {--}}
//            {{--                swal.close();--}}
//            {{--                swal.fire({--}}
//            {{--                    title: result.message,--}}
//            {{--                    timer: 3000,--}}
//            {{--                    type: 'error',--}}
//            {{--                });--}}
//            {{--            }--}}
//
//            {{--        },--}}
//            {{--        error: function (data) {--}}
//            {{--            swal.fire({--}}
//            {{--                title: 'Status change process failed!',--}}
//            {{--                type: 'error',--}}
//            {{--            });--}}
//            {{--        }--}}
//            {{--    });--}}
//            {{--    e.preventDefault();--}}
//            {{--});--}}

        //delete device offer
        $("#roaming_operator_list").on('click', '.delete_package', function (e) {
            var deleteUrl = $(this).attr('href');
            var cnfrm = confirm("Do you want to delete this operator?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Roaming operator is deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#roaming_operator_list').DataTable().ajax.reload();

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
        $('.all_operator_delete').on('click', function (e) {
            var deleteUrl = "{{ URL('roaming-operator/destroy') }}";
            var cnfrm = confirm("Do you want to delete all Operator?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'All roaming operator are deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#roaming_operator_list').DataTable().ajax.reload();

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



