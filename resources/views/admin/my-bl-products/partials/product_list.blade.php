<div class="col-md-12 mt-5" >
    <div class="row">
        <div class="col-md-4">
            <select name="sim_type" class="form-control filter" id="sim_type">
                <option value=""> Please Select Connection Type</option>
                <option value="1">PREPAID</option>
                <option value="2">POSTPAID</option>
            </select>
        </div>
        <div class="col-md-4">
            <input class="form-control filter" name="product_code" placeholder="Enter Product Code to Filter" id="product_code"/>
        </div>
        <div class="col-md-4">
            <select name="content_type" class="form-control filter" id="content_type">
                <option value=""> Please Select Connection Type</option>
                <option value="data">DATA</option>
                <option value="mix">MIX</option>
                <option value="data loan">DATA LOAN</option>
                <option value="gift">GIFT</option>
                <option value="volume request">VOLUME REQUEST</option>
                <option value="volume transfer">VOLUME TRANSFER</option>
            </select>
        </div>
    </div>
</div>
<div class="col-md-12 mt-3">
    <table class="table table-striped table-bordered dataTable"
           id="product_list" role="grid">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Product Code</th>
            <th>Name</th>
            <th>Short Description</th>
            <th>Content Type</th>
            <th>Family Name</th>
            <th>Offer Section</th>
            <th>Status</th>
            <th class="filter_data">Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@push('page-js')
    {{--    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript">
        </script>--}}

    <script>
        $(function () {
            $("#product_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('mybl.products.list') }}',
                    data: {
                        product_code: function () {
                            return $("#product_code").val();
                        },
                        sim_type: function () {
                            return $("#sim_type").val();
                        },
                        content_type: function () {
                            return $("#content_type").val();
                        }
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '30px',
                        render: function () {
                            return null;
                        }
                    },

                    {
                        name: 'product_code',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.product_code;
                        }
                    },

                    {
                        name: 'name',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.name;
                        }
                    },

                    {
                        name: 'description',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.description;
                        }
                    },

                    {
                        name: 'content_type',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.content_type;
                        }
                    },
                    {
                        name: 'family_name',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.family_name;
                        }
                    },
                    {
                        name: 'offer_section',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.offer_section;
                        }
                    },
                    {
                        name: 'status',
                        width: '150px',
                        render: function (data, type, row) {
                            if (row.status === 1) {
                                return 'Active';
                            }

                            return 'InActive';
                        }
                    },

                    {
                        name: 'actions',
                        className: 'filter_data',
                        width: '150px',
                        render: function (data, type, row) {
                            let detail_question_url = "{{ URL('mybl/products/details/') }}" + "/" + row.product_code;
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <a href=" ` + detail_question_url + ` "class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#product_list').DataTable().ajax.reload();
            });
        });
    </script>

@endpush



