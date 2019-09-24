@extends('layouts.admin')
@section('title', 'Mixed Bundle Offer Configuration')
@section('card_name', "Mixed Bundle Offer Filter")
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

                        @include('admin.offer-mixedbundle.config._partials.price_config_form')
                        <!---------------  Internet Config ------------------------------------>

                        @include('admin.offer-mixedbundle.config._partials.internet_config_form')

                        <!---------------  Minutes Config ------------------------------------>
                        @include('admin.offer-mixedbundle.config._partials.minutes_config_form')

                        <!---------------  SMS Config ------------------------------------>
                        @include('admin.offer-mixedbundle.config._partials.sms_config_form')

                        <!---------------  Validation Config ------------------------------------>
                        <div id="validation_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#validation_config"
                               aria-expanded="false"
                               aria-controls="accordion14" class="card-title lead collapsed">Validation Filter</a>
                        </div>
                        <div id="validation_config" role="tabpanel" aria-labelledby="validation_heading"
                             class="collapse"
                             aria-expanded="false" style="height: 0px;">
                            <div class="card-content">
                                <div class="card-body">
                                    Sesame snaps chocolate lollipop sesame snaps apple pie chocolate cake sweet roll.
                                    Dragée candy canes carrot cake chupa chups danish cake sugar
                                    plum candy. Cake powder biscuit bear claw. Sesame snaps cotton
                                    candy cheesecake topping ice cream cookie tiramisu. Liquorice
                                    bonbon cookie pie halvah. Cookie toffee ice cream cotton
                                    candy lollipop fruitcake. Tart cheesecake tiramisu danish
                                    marzipan pie pastry chocolate cake. Pastry bonbon lollipop
                                    oat cake pastry halvah dessert jelly. Toffee caramels croissant
                                    apple pie chupa chups toffee muffin chupa chups apple pie.
                                </div>
                            </div>
                        </div>

                        <!---------------  Sorting Config ------------------------------------>
                        <div id="sorting_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#sorting_config"
                               aria-expanded="false"
                               aria-controls="accordion14" class="card-title lead collapsed">Sorting Filter</a>
                        </div>
                        <div id="sorting_config" role="tabpanel" aria-labelledby="sorting_heading" class="collapse"
                             aria-expanded="false" style="height: 0px;">
                            <div class="card-content">
                                <div class="card-body">
                                    Sesame snaps chocolate lollipop sesame snaps apple pie chocolate cake sweet roll.
                                    Dragée candy canes carrot cake chupa chups danish cake sugar
                                    plum candy. Cake powder biscuit bear claw. Sesame snaps cotton
                                    candy cheesecake topping ice cream cookie tiramisu. Liquorice
                                    bonbon cookie pie halvah. Cookie toffee ice cream cotton
                                    candy lollipop fruitcake. Tart cheesecake tiramisu danish
                                    marzipan pie pastry chocolate cake. Pastry bonbon lollipop
                                    oat cake pastry halvah dessert jelly. Toffee caramels croissant
                                    apple pie chupa chups toffee muffin chupa chups apple pie.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style>
        .add-button {
            margin-top: 1.9rem !important;
        }

        .filter_data {
            text-align: right;
        }
    </style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
@endpush
