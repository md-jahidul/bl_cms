@extends('layouts.admin')
@section('title', 'Special Call Rate Filter Configuration')
@section('card_name', "Special Call Rate Pack Filter")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        Configuration
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div class="card-content">
                <div id="settings_panel" role="tablist" aria-multiselectable="true">
                    <div class="card collapse-icon accordion-icon-rotate">
                        <!---------------  Price Config ------------------------------------>

                        @include('admin.offer-special.config._partials.price_config_form')
                        <!---------------  Internet Config ------------------------------------>

                        @include('admin.offer-special.config._partials.minute_config_form')

                        <!---------------  Validation Config ------------------------------------>
                       @include('admin.offer-special.config._partials.validity_config_form')

                    <!---------------  Sorting Config ------------------------------------>
                        @include('admin.offer-special.config._partials.sorting_config_form')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" href="{{asset('app-assets')}}/vendors/css/forms/icheck/custom.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
{{--    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/forms/toggle/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/css/plugins/forms/switch.css">--}}
    <style>
        .add-button {
            margin-top: 1.9rem !important;
        }

        .filter_data {
            text-align: right;
        }

        .dataTable{
            width: 100%!important;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
{{--    <script src="{{asset('app-assets')}}/vendors/js/forms/toggle/bootstrap-switch.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/forms/toggle/bootstrap-checkbox.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/forms/switch.js" type="text/javascript"></script>--}}

    <script>
        $(function () {

            $('.collapse').on('shown.bs.collapse', function () {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endpush
