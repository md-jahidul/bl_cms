@extends('layouts.admin')
@section('title', 'Remove MSISDN')
@section('card_name', 'Remove MSISDN')
@section('breadcrumb')
    <li class="breadcrumb-item active">Remove MSISDN List</li>
@endsection
@section('content')
    <section id="remove-msisdn-table" class="mt-2">
        <div class="w-100">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="row mb-5">
                                <div class="form-group col-md-4">
                                    <label for="reward_prepaid" class="required"> Select MSISDN </label>

                                    <select class="product_code form-control" name="msisdn" data-validation-required-message="Please select MSISDN">
                                        <option value="">Select MSISDN </option>
                                        @foreach($testMsisdnList as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h4 class="my-2">Please choose feature from where to remove</h4>
                            <table class="table table-striped table-bordered text-center" id="remove_msisdn_table"></table>
                            <div class="col-md-12">
                                <a href="#" class="btn btn-success">
                                    Submit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@push('page-css')
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var date = new Date();
            date.setDate(date.getDate());
            $('#from_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
                defaultDate: date
            });
            $('#to_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                showClose: true,
                defaultDate: date
            });

            var features = Object.values(JSON.parse('{!! $featureList !!}'));
            console.log(features);
            var remove_msisdn_table = $('#remove_msisdn_table').DataTable({
                processing: true,
                serverSide: false,
                pageLength: 10,
                destroy: true,
                "orderable": false,
                data: features,
                "aoColumns": [
                    {
                        "sTitle": "<input type='checkbox' id='selectAll'></input> Select All",
                        "orderable": false
                    },
                    {
                        "sTitle": 'Feature Name',
                    },
                ],
                "columnDefs": [{
                    "targets": 1,
                    render: function (data, type, row) {
                        var domElement = row;
                        return domElement;
                    }
                },
                ],
                "fnCreatedRow": function(row, data, index) {
                    $('td', row).eq(0).html(`<input type="checkbox" class="float-left form-check-input" id="featureCheck" data-id="${index}">`+ (index + 1));
                }
            }).columns.adjust();;
            $("#submit_msisdn_list").click(function() {
                $('remove_msisdn_table').DataTable().ajax.reload();
            });
            $("#selectAll").click(function(){
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endpush