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

@push('page-js')
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
@endpush
