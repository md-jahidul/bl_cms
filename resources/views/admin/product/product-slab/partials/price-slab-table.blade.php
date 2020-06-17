<div class="row mt-2">

    <div class="col-md-12 col-xs-12">

        <div class="col-md-8 col-xs-12 pull-right">
            <a href="javascript:;" class="btn btn-danger all_bundle_delete float-right">Delete All</a>
        </div>

    </div>

    <div class="col-md-12">
        <table class="table table-striped table-bordered dataTable"
               id="product-price-slab-list" role="grid">
            <thead>
            <tr>
                <th>SL.</th>
                <th>Range</th>
                <th>Product Code</th>
                <th>Rang Start</th>
                <th>Rage End</th>
                <th width="3%" class="filter_data">Actions</th>
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
            $("#product-price-slab-list").dataTable({
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
                    url: '{{ route("priceSlab.list.ajax") }}',
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
                        name: 'range_name',
                        render: function (data, type, row) {
                            return row.range_name;
                        }
                    },
                    {
                        name: 'product_code',
                        render: function (data, type, row) {
                            return row.product_code;
                        }
                    },
                    {
                        name: 'range_start',
                        render: function (data, type, row) {
                            return row.range_start;
                        }
                    },
                    {
                        name: 'range_end',
                        render: function (data, type, row) {
                            console.log(row);
                            return row.range_end;
                        }
                    },
                    {
                        name: 'actions',
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let edit_url = "{{ URL('product-price/slab/details') }}" + "/" + row.id;
                            let delete_url = "{{ URL('product-price-slab/destroy') }}" + "/" + row.id;
                            return '<div class="btn-group" role="group" aria-label="Delete">\n\
                            <a href=" ' + edit_url + ' "class="btn btn-sm btn-icon btn-outline-info">\
                            <i class="la la-pencil" aria-hidden="true"></i>\n\
                            </a>\n\
                            <a href=" ' + delete_url + ' "class="btn btn-sm btn-icon btn-outline-danger delete_package">\n\
                            <i class="la la-trash"></i>\n\
                            </a>\n\
                            </div>';
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    console.log(row)
                    $('td', row).eq(0).html(index + 1);
                }

            });
            //change show/hide status of device offer
            $("#product-price-slab-list").on('click', '.bundle_change_status', function (e) {
                var packageId = $(this).attr('href');
                $.ajax({
                    url: '{{ url("roaming-bundle-status-change")}}/' + packageId,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Roaming bundle status is changed!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#product-price-slab-list').DataTable().ajax.reload();
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
            $("#product-price-slab-list").on('click', '.delete_package', function (e) {
                var deleteUrl = $(this).attr('href');
                var cnfrm = confirm("Do you want to delete this Price Slab?");
                if (cnfrm) {
                    $.ajax({
                        url: deleteUrl,
                        cache: false,
                        type: "GET",
                        success: function (result) {
                            if (result.success == 1) {
                                swal.fire({
                                    title: 'Price slab is deleted!',
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                                $('#product-price-slab-list').DataTable().ajax.reload();
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
            $('.all_bundle_delete').on('click', function (e) {
                var deleteUrl = "{{ URL('product-price-slab/destroy') }}";
                var cnfrm = confirm("Do you want to delete all Price Slabs?");
                if (cnfrm) {
                    $.ajax({
                        url: deleteUrl,
                        cache: false,
                        type: "GET",
                        success: function (result) {
                            if (result.success == 1) {
                                swal.fire({
                                    title: 'All price slabs are deleted!',
                                    type: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                                $('#product-price-slab-list').DataTable().ajax.reload();
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



