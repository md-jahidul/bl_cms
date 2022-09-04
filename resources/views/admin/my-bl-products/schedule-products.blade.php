@extends('layouts.admin')
@section('title', 'Scheduler Products')
@section('card_name', 'Scheduler Products')
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Scheduler Products</h4>
                    <table class="table table-striped table-bordered" id="Example1"
                           role="grid" aria-describedby="Example1_info">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Code</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($scheduleProducts as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data->product_code }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    <a href="{{ route('schedule-product.view', [$data->id]) }}" role="button"
                                       class="btn-pancil btn btn-outline-warning">
                                        <i class="la la-eye" disabled="disabled" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" remove="{{ url("product-schedule-revert/$data->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $data->id }}" title="Cancel Schedule">
                                        <i class="la la-trash"></i> Cancel Schedule
                                    </a>
                                </td>
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

