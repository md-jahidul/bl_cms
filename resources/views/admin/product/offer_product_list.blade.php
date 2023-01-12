<div class="col-md-12 mt-5" >
    <div class="row">
        <div class="col-md-2">
            <select name="sim_type" class="form-control filter" id="sim_type">
                <option value=""> Connection Type</option>
                @foreach($simCategories as $simCategory)
                    <option value="{{ $simCategory['id'] }}">{{ $simCategory['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input class="form-control filter" name="product_code" placeholder="Enter Product Code to Filter" id="product_code"/>
        </div>
        <div class="col-md-2">
            <input class="form-control filter" name="name_en" placeholder="Enter Product Name to Filter" id="name_en"/>
        </div>
        <div class="col-md-2">
            <select name="content_type" class="form-control filter" id="content_type">
                <option value=""> Offer Type</option>
                {{-- <option value="data">DATA</option>
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
                <option value="free_products">FREE PRODUCTS</option>
                <option value="is_popular_pack">POPULAR PACKS</option> --}}
                @foreach($offers as $offer)
                    <option data-alias="{{ $offer->alias }}" value="{{ $offer->alias }}">{{ $offer->name_en }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
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
           id="offer_product_list" role="grid">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>USSD</th>
            <th>Content Type</th>
            <th>Show in Home</th>
            <th>Connection Type</th>
            <th>Details</th>
            <th>Has Image</th>
            <th class="filter_data">Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@push('page-js')
    {{--    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript">
        </script>--}}
        <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
        <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            new Clipboard('.copy-text');
            $("#offer_product_list").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                pageLength: 10,
                lengthChange: false,
                ajax: {
                    url: '{{ route('offers.product.list') }}',
                    data: {
                        product_code: function () {
                            return $("#product_code").val();
                        },
                        name_en: function () {
                            return $("#name_en").val();
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
                            let pin_sign = row.pin_to_top ? "<i class='la la-thumb-tack' title='Product marked as pin to top'></i>" : "";
                            return '<a href="' + row.action['edit']  + '">' + row.product_code  + '</a> <b> ' + pin_sign + '</b>';
                        }
                    },

                    {
                        name: 'name_en',
                        render: function (data, type, row) {
                            return row.name_en;
                        }
                    },

                    {
                        name: 'activation_ussd',
                        render: function (data, type, row) {
                            return row.activation_ussd;
                        }
                    },


                    {
                        name: 'content_type',
                        render: function (data, type, row) {
                            return row.offer_category;
                            //return row.content_type;
                        }
                    },

                    {
                        name: 'show_in_home',
                        render: function (data, type, row) {
                            return row.show_in_home;
                        }
                    },
                    {
                        name: 'connection_type',
                        render: function (data, type, row) {
                            return   row.connection_type;
                        }
                    },
                    {
                        name: 'details',
                        render: function (data, type, row) {
                            return row.details
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
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                                        <a href=" ` + row.action['edit'] + ` "class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-pencil"></i></a>
                                    </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            $(document).on('change', '.filter', function (e) {
                $('#offer_product_list').DataTable().ajax.reload();
            });
        });

    </script>

@endpush



