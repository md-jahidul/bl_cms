<table class="table table-striped table-bordered dataTable" id="msisdn_list">
    <thead>
        <tr>
            <th width=5%># SL</th>
            <th>Msisdn</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 0 @endphp
        @foreach ($msisdnList as $item)
        <tr>
            <th>{{++$i}}</th>
            <th>{{ $item->msisdn }}</th>
        </tr>    
        @endforeach
    </tbody>
    <div class="pull-right">
        {{ $msisdnList->links() }}
    </div>
</table>

{{--<div class="card">
    @foreach ($msisdnList as $user)
        {{ $user->msisdn }}
    @endforeach
</div>--}}

@push('page-js')
{{--<script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>--}}
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
{{--<script>
        $(function () {
            // new Clipboard('.copy-text');
            $("#msisdn_list").dataTable({
                lengthChange: true,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, "All"]],
                pageLength: 5,
                paging: true,
                processing: true,
                searching: true,
                serverSide: true,
                ordering: false,
                autoWidth: false,
                ajax: {
                    url: '{{ route('myblslider.baseMsisdnList.table', $baseMsisdn->id) }}',
                    data: {
                        search_keyword: function () {
                            return $("#searchInput").val();
                        },
                    }
                },
                columns: [
                    {
                        name: 'sl',
                        width: '5%',
                        render: function () {
                            return null;
                        }
                    },
                    {
                        name: 'msisdn',
                        render: function (data, type, row) {
                            return row.msisdn;
                        }
                    },
                    // {
                    //     name: 'created_at',
                    //     render: function (data, type, row) {
                    //         return row.created_at;
                    //     }
                    // }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }

            });

            // $(document).on('change', '.filter', function (e) {
            //     $('#product_list').DataTable().ajax.reload();
            // });
        });
</script>--}}
@endpush
