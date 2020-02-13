@extends('layouts.admin')
@section('title', 'Header Menu List')
@section('card_name', 'Header Menu List')
@section('breadcrumb')
    <li class="breadcrumb-item active">App & Service Tabs List</li>
@endsection
@section('action')
    <a href="{{--{{ $parent_id == 0 ? url('menu/create') : url("menu/$parent_id/child-menu/create") }}--}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Header Menu
    </a>
@endsection
@section('content')


<section id="dom">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">DOM / jQuery events</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <p class="card-text">Events assigned to the table can be exceptionally useful for
                        user interaction, however you must be aware that DataTables
                                          will add and remove rows from the DOM as they are needed (i.e.
                        when paging only the visible elements are actually available
                      in the DOM). As such, this can lead to the odd hiccup when
                      working with events.</p>
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Position</th>
                          <th>Office</th>
                          <th>Age</th>
                          <th>Start date</th>
                          <th>Salary</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Tiger Nixon</td>
                          <td>System Architect</td>
                          <td>Edinburgh</td>
                          <td>61</td>
                          <td>2011/04/25</td>
                          <td>$320,800</td>
                        </tr>
                        <tr>
                          <td>Garrett Winters</td>
                          <td>Accountant</td>
                          <td>Tokyo</td>
                          <td>63</td>
                          <td>2011/07/25</td>
                          <td>$170,750</td>
                        </tr>
                        <tr>
                          <td>Ashton Cox</td>
                          <td>Junior Technical Author</td>
                          <td>San Francisco</td>
                          <td>66</td>
                          <td>2009/01/12</td>
                          <td>$86,000</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@stop
