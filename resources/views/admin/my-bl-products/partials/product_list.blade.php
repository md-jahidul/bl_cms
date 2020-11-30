<div class="col-md-12 mt-5" >
    <div class="row">
        <div class="col-md-3">
            <select name="sim_type" class="form-control filter" id="sim_type">
                <option value=""> Connection Type</option>
                <option value="1">PREPAID</option>
                <option value="2">POSTPAID</option>
            </select>
        </div>
        <div class="col-md-3">
            <input class="form-control filter" name="product_code" placeholder="Enter Product Code to Filter" id="product_code"/>
        </div>
        <div class="col-md-3">
            <select name="content_type" class="form-control filter" id="content_type">
                <option value=""> Content Type</option>
                <option value="data">DATA</option>
                <option value="mix">MIX BUNDLES</option>
                <option value="voice">VOICE BUNDLES</option>
                <option value="sms">SMS BUNDLES</option>
                <option value="scr">SPECIAL CALL RATE</option>
                <option value="recharge_offer">RECHARGE OFFER</option>
                <option value="ma loan">MA LOAN</option>
                <option value="data loan">DATA LOAN</option>
                <option value="gift">GIFT</option>
                <option value="volume request">VOLUME REQUEST</option>
                <option value="volume transfer">VOLUME TRANSFER</option>
                <option value="bonus">BONUS</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="show_in_home" class="form-control filter" id="show_in_home">
                <option value=""> Show in Home</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
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
            <th>Renew Product Code</th>
            <th>Recharge Product Code</th>
            <th>Description</th>
            <th>Show in Home</th>
            <th>Visibility</th>
            <th>Attached Image</th>
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
                        },
                        show_in_home: function () {
                            return $("#show_in_home").val();
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
                        render: function (data, type, row) {
                            return row.product_code;
                        }
                    },

                    {
                        name: 'renew_product_code',
                        render: function (data, type, row) {
                            return row.renew_product_code;
                        }
                    },

                    {
                        name: 'recharge_product_code',
                        render: function (data, type, row) {
                            return row.recharge_product_code;
                        }
                    },

/*                    {
                        name: 'name',
                        width: '150px',
                        render: function (data, type, row) {
                            return row.name;
                        }
                    },*/

                    {
                        name: 'description',
                        render: function (data, type, row) {
                            return row.description;
                        }
                    },

                    {
                        name: 'show_in_home',
                        render: function (data, type, row) {
                            return row.show_in_home;
                        }
                    },
                    {
                        name: 'is_visible',
                        render: function (data, type, row) {
                            return   row.is_visible == 'Shown' ? "<span class='badge badge-success'>Shown</span>" : "<span class='badge badge-warning'>Hidden</span>";
                        }
                    },
                    {
                        name: 'Attached Image',
                        render: function (data, type, row) {
                            return row.media;
                        }
                    },
                    {
                        name: 'actions',
                        className: 'filter_data',
                        render: function (data, type, row) {
                            let detail_question_url = "{{ URL('mybl/products/') }}" + "/" + row.product_code;
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



