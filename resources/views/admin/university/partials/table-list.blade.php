<div class="row mt-2">

{{--    <div class="col-md-12 col-xs-12">--}}

{{--        <div class="col-md-8 col-xs-12 pull-right">--}}
{{--            <a href="javascript:;" class="btn btn-danger all_operator_delete float-right">Delete All</a>--}}
{{--        </div>--}}

{{--    </div>--}}



    <div class="col-md-12">
        <table class="table table-striped table-bordered dataTable"
               id="university_list" role="grid">
                <thead>
                    <tr>
                        <td width="3%">#</td>
                        <th width="50%">University Name</th>
{{--                        <th width="5%" class="">Action</th>--}}
                    </tr>
                </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@push('page-js')
<script>
    $(function () {
        $("#university_list").dataTable({
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
                url: '{{ route("university.list.ajax") }}',
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
                    name: 'university_name',
                    render: function (data, type, row) {
                        return row.university_name;
                    }
                },
                {{--{--}}
                {{--    name: 'actions',--}}
                {{--    className: 'filter_data',--}}
                {{--    render: function (data, type, row) {--}}
                {{--        let edit_url = "{{ URL('university/edit') }}" + "/" + row.id;--}}
                {{--        let delete_url = "{{ URL('university/destroy') }}" + "/" + row.id;--}}
                {{--        return `<div class="btn-group" role="group" aria-label="Delete">--}}
                {{--    <a href=" ` + edit_url + ` "class="btn btn-sm btn-icon btn-outline-info edit_package"><i class="la la-edit"></i></a>--}}
                {{--    <a href=" ` + delete_url + ` "class="btn btn-sm btn-icon btn-outline-danger delete_package"><i class="la la-trash"></i></a>--}}
                {{--  </div>`--}}
                {{--    }--}}
                {{--}--}}
            ],
            "fnCreatedRow": function (row, data, index) {
                console.log(row)
                $('td', row).eq(0).html(index + 1);
            }

        });


        //change show/hide status of device offer
        $("#university_list").on('click', '.operator_change_status', function (e) {
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

                        $('#university_list').DataTable().ajax.reload();

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
        $("#university_list").on('click', '.delete_package', function (e) {
            var deleteUrl = $(this).attr('href');
            var cnfrm = confirm("Do you want to delete this university?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'University is deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#university_list').DataTable().ajax.reload();

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
        $('.all_universities_delete').on('click', function (e) {
            var deleteUrl = "{{ url('university/destroy') }}";
            var cnfrm = confirm("Do you want to delete all universities ?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'All universities are deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#university_list').DataTable().ajax.reload();

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



