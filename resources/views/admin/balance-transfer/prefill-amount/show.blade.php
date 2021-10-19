@extends('layouts.admin')
@section('title', 'Recharge')
@section('card_name', 'Balance Transfer Prefill Amounts')

@section('content')
    <section>
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @if(!empty($amounts))
                                <form method="POST" action="{{ route('balance-transfer.prefill-amounts.store') }}">
                                    <button class="btn btn-success btn-sm pull-right mb-2" type="submit"> Update
                                    </button>
                                    {{ csrf_field() }}
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                            <th width='30%'>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody id="ordering">
                                        @foreach ($amounts as $key => $amount)
                                            <tr data-index="{{ $amount->id ?? 0 }}"
                                                data-position="{{ $amount->sort ?? $key}}">
                                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                                <td width='30%'>
                                                    @if(isset($amount->id))
                                                        <input type="hidden" name="prefill_id[{{$key}}]"
                                                               value="{{$amount->id}}">
                                                    @endif
                                                    <input class="form-control"
                                                           type="number"
                                                           min="10"
                                                           max="1000"
                                                           name="amount[]"
                                                           required
                                                           value="{{$amount->amount ?? ($amount ?? "") }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('style')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush
@push('page-js')
    <script>
        $("#ordering").sortable();
    </script>
@endpush
