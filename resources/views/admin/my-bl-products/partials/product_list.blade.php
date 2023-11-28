<div class="col-md-12 mt-5" >
    <div class="row">
        <div class="col-md-2">
            <select name="sim_type" class="form-control filter" id="sim_type">
                <option value=""> Connection Type</option>
                <option value="1">PREPAID</option>
                <option value="2">POSTPAID</option>
            </select>
        </div>

        <div class="form-group select-role col-md-3 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
            <div class="role-select">
                <select class="select2 form-control" multiple="multiple" name="product_codes[]" id="product_code_filter">
                    @foreach($products as $product)
                        <option value="{{ $product->product_code }}">{{$product->product_code}}</option>
                    @endforeach
                </select>
            </div>
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
                <option value="reactivation">REACTIVATION OFFER</option>
                <option value="ma loan">MA LOAN</option>
                <option value="data loan">DATA LOAN</option>
                <option value="minute loan">MINUTE LOAN</option>
                <option value="gift">GIFT</option>
                <option value="volume request">VOLUME REQUEST</option>
                <option value="volume transfer">VOLUME TRANSFER</option>
                <option value="bonus">BONUS</option>
                <option value="free_products">FREE PRODUCTS</option>
                <option value="is_popular_pack">POPULAR PACKS</option>
                <option value="roam">ROAMING PRODUCT</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="show_in_home" class="form-control filter" id="show_in_home">
                <option value=""> Show in Home</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="col-md-2">
            <select name="pinned_products" class="form-control filter" id="pinned_products">
                <option value=""> Pinned Products ?</option>
                <option value="1">Show Pinned</option>
                <option value="0">Show Non Pinned</option>
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
            <th>Renew Prod. Code</th>
            <th>Recharge Prod. Code</th>
            <th>Description</th>
            <th>Show in Home</th>
            <th>Visibility</th>
            <th>Show From</th>
            <th>Hide From</th>
            <th>Has Image</th>
            <th>Deep Link</th>
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
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        $(function () {
            new Clipboard('.copy-text');
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
                        product_codes: function () {
                            return $("#product_code_filter").val();
                        },
                        sim_type: function () {
                            return $("#sim_type").val();
                        },
                        content_type: function () {
                            return $("#content_type").val();
                        },
                        show_in_home: function () {
                            return $("#show_in_home").val();
                        },
                        pinned_products: function () {
                            return $("#pinned_products").val();
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
                            let detail_question_url = "{{ URL('mybl/products/') }}" + "/" + row.product_code;
                            let pin_sign = row.pin_to_top ? "<i class='la la-thumb-tack' title='Product marked as pin to top'></i>" : "";
                            return '<a href="' + detail_question_url + '">' + row.product_code  + '</a> <b> ' + pin_sign + '</b>';
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
                            let visibility = '';
                            switch (row.is_visible) {
                                case 'Shown':
                                case 'Active Schedule':
                                case 'To be Hidden':
                                    visibility = "<span class='badge badge-success'>" + row.is_visible + "</span>";
                                    break;

                                case 'Completed Schedule':
                                case 'Hidden':
                                    visibility = "<span class='badge badge-danger'>" + row.is_visible + "</span>";
                                    break;

                                case 'To be Shown':
                                    visibility = "<span class='badge badge-warning'>" + row.is_visible + "</span>";
                                    break;

                                default:
                                    visibility = "<span class='badge badge-info'>" + row.is_visible + "</span>";
                                    break;
                            }
                            return visibility;
                        }
                    },
                    {
                        name: 'show_from',
                        render: function (data, type, row) {
                            return   row.show_from;
                        }
                    },
                    {
                        name: 'hide_from',
                        render: function (data, type, row) {
                            return   row.hide_from;
                        }
                    },
                    {
                        name: 'Attached Image',
                        render: function (data, type, row) {
                            return row.media;
                        }
                    },
                    {
                        name: 'name',
                        width: '150px',
                        render: function (data, type, row) {
                            // return row.deep_link;
                            if(row.deep_link==null){
                                return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-sm btn-icon btn-outline-success edit" onclick="deepLinkCreate('` + row.product_code + `');"><i class="la icon-link"></i></button>
                          </div>`
                            }else{
                                return `<button class="btn btn-sm btn-success" id="` + row.deep_link + `" onclick="copyDeepLinkCreate('` + row.deep_link + `');" class="copy-text" href="#">copy</button>`;

                            }
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

            $(document).on('change', '#product_code_filter', function (e) {
                $('#product_list').DataTable().ajax.reload();
            });
        });

        function deepLinkCreate(productCode){
            $.ajax({
                url: "{{ url('mybl-products-deep-link-create') }}/"+productCode,
                methods: "get",
                success: function (result) {
                    console.log(result.status_code);
                    if(result.status_code===200){
                        Swal.fire(
                            'Generated!',
                            'Deep link generated successfully .<br><br> Link :  '+result.short_link,
                            'success',
                        );
                    }else{
                        Swal.fire(
                            'Oops!',
                            'Something went wrong please try again ',
                            'error',
                        );
                    }
                    setTimeout(redirect, 2000)
                    function redirect() {
                        $('#product_list').DataTable().ajax.reload();
                    }
                }
            });
        }

        function copyDeepLinkCreate(deeplink){
            const str = document.getElementById(deeplink).id;
            const el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }
    </script>
@endpush



