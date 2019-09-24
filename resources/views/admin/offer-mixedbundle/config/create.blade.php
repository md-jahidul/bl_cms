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

                        <div id="price_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#price_config"
                               aria-expanded="true"
                               aria-controls="price_config" class="card-title lead">Price Filter</a>
                        </div>
                        <div id="price_config" role="tabpanel" aria-labelledby="price_heading" class="collapse show">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <form class="form" action="#"
                                                  method="POST">
                                                @csrf
                                                @method('post')
                                                <div class="form-body">
                                                    <h4 class="form-section"><i class="la la-money"></i>Create Price
                                                        Filter</h4>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="lower_input">Lower<small
                                                                        class="text-danger">*</small></label>
                                                                <input required type="number" min="0" step="10"
                                                                       value="@if(old('lower')){{old('lower')}}@endif"
                                                                       id="lower_input"
                                                                       class="form-control @error('lower') is-invalid @enderror"
                                                                       placeholder="Enter Lower Bound...." name="lower">
                                                                <small class="form-text text-muted">Enter
                                                                    amount in Tk.</small>
                                                                @error('lower')
                                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="upper_input">Upper<small
                                                                        class="text-danger">*</small></label>
                                                                <input required type="number" min="1" step="10"
                                                                       value="@if(old('upper')){{old('upper')}}@endif"
                                                                       id="upper_input"
                                                                       class="form-control @error('lower') is-invalid @enderror"
                                                                       placeholder="Enter Upper Bound...." name="upper">
                                                                <small class="form-text text-muted">Enter
                                                                    amount in Tk.</small>
                                                                @error('lower')
                                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                                <button type="submit" class="btn btn-success round px-2">
                                                                    <i class="la la-check-square-o"></i> Add
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="offset-1 col-md-4 mt-3">
                                            <table class="table table-striped table-borderedno-footer"
                                                   id="Example1" role="grid" aria-describedby="Example1_info">
                                                <thead>
                                                <tr>
                                                    <th>SL. </th>
                                                    <th> Filter</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                       <td> 1 </td>
                                                       <td> 0-30 </td>
                                                   </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!---------------  Internet Config ------------------------------------>
                        <div id="internet_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#internet_config"
                               aria-expanded="false"
                               aria-controls="accordion14" class="card-title lead collapsed">Internet Filter</a>
                        </div>
                        <div id="internet_config" role="tabpanel" aria-labelledby="internet_heading" class="collapse"
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

                        <!---------------  Minutes Config ------------------------------------>
                        <div id="minutes_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#minutes_config"
                               aria-expanded="false"
                               aria-controls="accordion14" class="card-title lead collapsed">Minutes Filter</a>
                        </div>
                        <div id="minutes_config" role="tabpanel" aria-labelledby="minutes_heading" class="collapse"
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

                        <!---------------  SMS Config ------------------------------------>
                        <div id="sms_heading" class="card-header">
                            <a data-toggle="collapse" data-parent="#settings_panel" href="#sms_config"
                               aria-expanded="false"
                               aria-controls="accordion14" class="card-title lead collapsed">SMS Filter</a>
                        </div>
                        <div id="sms_config" role="tabpanel" aria-labelledby="sms_heading" class="collapse"
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

@endpush
@push('page-js')

@endpush
