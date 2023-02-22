@extends('layouts.admin')
@section('title', 'Commerce Bill Status')
@section('card_name', 'Commerce Bill Status')

@section('content')
    <section>
        <table class="table table-striped table-bordered dataTable" id="msisdn_list">
            <thead>
                <tr>
                    <th>result</th>
                    <th>message</th>
                    <th>bill_payment_id</th>
                    <th>bill_refer_id</th>
                    <th>bill_id</th>
                    <th>bill_name</th>
                    <th>bill_no</th>
                    <th>biller_acc_no</th>
                    <th>biller_mobile</th>
                    <th>bill_from</th>
                    <th>bill_to</th>
                    <th>bill_gen_date</th>
                    <th>bill_due_date</th>
                    <th>charge</th>
                    <th>bill_total_amount</th>
                    <th>transaction_id</th>
                    <th>payment_date</th>
                    <th>payment_status</th>
                    <th>payment_amount</th>
                    <th>payment_trx_id</th>
                    <th>payment_method</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($billStatus as $item)
                <tr>
                    <th>{{$item->result}}</th>
                    <th>{{$item->message}}</th>
                    <th>{{$item->bill_payment_id}}</th>
                    <th>{{$item->bill_refer_id}}</th>
                    <th>{{$item->bill_id}}</th>
                    <th>{{$item->bill_name}}</th>
                    <th>{{$item->bill_no}}</th>
                    <th>{{$item->biller_acc_no}}</th>
                    <th>{{$item->biller_mobile}}</th>
                    <th>{{$item->bill_from}}</th>
                    <th>{{$item->bill_to}}</th>
                    <th>{{$item->bill_gen_date}}</th>
                    <th>{{$item->bill_due_date}}</th>
                    <th>{{$item->charge}}</th>
                    <th>{{$item->bill_total_amount}}</th>
                    <th>{{$item->transaction_id}}</th>
                    <th>{{$item->payment_date}}</th>
                    <th>{{$item->payment_status}}</th>
                    <th>{{$item->payment_amount}}</th>
                    <th>{{$item->payment_trx_id}}</th>
                    <th>{{$item->payment_method}}</th>
                    <th>{{$item->created_at}}</th>
                    <th>{{$item->updated_at}}</th>
                </tr>    
                @endforeach
            </tbody>
            <div class="pull-right">
                {{ $billStatus->links() }}
            </div>
        </table>
    </section>
@endsection

@push('style')
@endpush

@push('page-js')
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
@endpush


