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

                                    <select id="msisdn_selection" class="product_code form-control" name="msisdn"
                                            data-validation-required-message="Please select MSISDN">
                                        <option value="">Select MSISDN</option>
                                        @foreach($testMsisdnList as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h4 class="my-2">Please choose features from where to remove</h4>
                            <table class="table table-striped table-bordered text-center"
                                   id="remove_msisdn_table"></table>
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="javascript:;" class="btn btn-success mt-5 px-2" id="submit_msisdn_list">
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
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var features = Object.values(JSON.parse('{!! $featureList !!}'));

            $('#remove_msisdn_table').DataTable({
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
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(`<input type="checkbox" class="float-left form-check-input" id="featureCheck" data-id="${index}">` + (index + 1));
                }
            }).columns.adjust();
            $("#submit_msisdn_list").click(function (e) {
                e.preventDefault();
                var msisdn = $("#msisdn_selection").val();
                var features = [];
                $('#remove_msisdn_table').find('#featureCheck:checked').each(function () {
                    features.push($(this).attr('data-id'));
                });

                msisdn && features.length ? removeMsisdn(features, msisdn) : alert('Please select msisdn & features');
            });
            $("#selectAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            function removeMsisdn(features, msisdn) {
                $.ajax({
                    url: "{{ url('remove-msisdn/remove') }}",
                    type: "POST",
                    data: {
                        msisdn: msisdn,
                        feature_list: features,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        if(data.success){
                            Swal.fire(
                                'Removed',
                                '',
                                'success',
                            );
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                        }else {
                            Swal.fire(
                                'Error Occured',
                                '',
                                'error',
                            );
                        }

                    }
                });
            }
        });
    </script>
@endpush