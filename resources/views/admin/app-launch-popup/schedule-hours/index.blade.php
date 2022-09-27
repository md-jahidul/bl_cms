@extends('layouts.admin')
@section('title', 'App Launch Popup')
@section('card_name', 'Recurring Schedule/Happy Hours')

@section('content')
    <section>
        <div class="card">

            <!-- Card for add time slot -->
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" action="{{route('recurring-schedule-hours.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="feature" class="control-label">Feature</label>
                                    <select name="feature" id="feature" class="form-control">
                                        <option value="popup">Popup</option>
                                        <option value="new_campaign_modality">New Campaign Modality</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_time" class="control-label">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_time" class="control-label">End Time</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <br><button class="btn btn-success" type="submit">Add Time Slot</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <span class="content-header-title">Recurring Schedule/ Happy Hours List</span>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Feature</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($timeSlots as $timeSlot)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ ucwords($timeSlot->feature) }}</td>
                                <td>{{ \Carbon\Carbon::parse($timeSlot->start_time)->setTimezone('Asia/Dhaka')->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($timeSlot->end_time)->setTimezone('Asia/Dhaka')->format('h:i A') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('recurring-schedule-hours.destroy', $timeSlot->id)}}" method="post">
                                            @csrf @method('delete')
                                            <button class="btn btn-sm btn-icon btn-outline-danger delete" type="submit">
                                                <i class="la la-remove"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@stop

@push('page-js')
    <script>
        $(".form").submit(function () {
            var startTime = Date.parse('01/01/2020 ' + $('#start_time').val() + ':00');
            var endTime = Date.parse('01/01/2020 ' + $('#end_time').val() + ':00');
            if ( startTime >= endTime) {
                alert('End time need to be greater than start time! Please check and retry');
                return false;
            }
        });
    </script>
@endpush


