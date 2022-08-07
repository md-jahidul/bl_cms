@extends('layouts.admin')
@section('title', 'Campaign Modality Winner')
@section('card_name', 'Campaign Modality Winner')
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Campaign Modality Winners List</h4>
                    <table class="table table-striped table-bordered" id="Example1"
                           role="grid" aria-describedby="Example1_info">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Campaign Name</th>
                            <th>Product Code</th>
                            <th>Total Recharge Amount</th>
                            <th>Pack Purchase Amount</th>
                            <th>Msisdn</th>
                            <th>Bonus Product Code</th>
                            <th>Winner Slot Start</th>
                            <th>Winner Slot End</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($winners as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->campaign->name }}</td>
                                <td>{{ $data->product_code }}</td>
                                <td>{{ isset($data->product_code) ? "" : $data->recharge_amount }}</td>
                                <td>{{ isset($data->product_code) ? $data->recharge_amount : "" }}</td>
                                <td>{{ $data->msisdn }}</td>
                                <td>{{ $data->bonus_product_code }}</td>
                                <td>{{ $data->winning_slot_start }}</td>
                                <td>{{ $data->winning_slot_end }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        $(function () {
            $('#Example1').DataTable({
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        })
    </script>
@endpush
