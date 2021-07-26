@extends('layouts.admin')
@section('title', 'Redis Reset Schedules')
@section('card_name', ucwords($entryType) . ' Redis Reset Schedules')

@section('content')
    <section>
        <div class="card">

            <!-- Card for add redis reset schedule -->
            <div class="card-content collapse show">
                <div class="card-body">
                    @if($entryType == 'edit')
                    <form class="form" method="post" action="{{route('redis-reset-schedules.update', $editingSchedule->id)}}">
                        @method('PUT')
                    @else
                    <form class="form" method="post" action="{{route('redis-reset-schedules.store')}}">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title" class="control-label">Start At</label>
                                    <input type="text" id="start_at" name="start_at" class="form-control"
                                           value="{{$entryType === 'edit' ? \Carbon\Carbon::parse($editingSchedule->start)->format('Y/m/d H:i') : old('start_at')}}"
                                           autocomplete="off" placeholder="Choose Date and Time" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="priority" class="control-label">Key to Reset</label>
                                    <select class="form-control" name="redis_key_to_reset" required>
                                        @foreach(config('constants.redis-keys') as $key => $redisKey)
                                            <option value="{{$key}}">{{$redisKey}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <br>
                                @if($entryType == 'edit')
                                <button class="btn btn-info" type="submit">
                                    <i class="la la-pencil"></i>
                                    Edit Schedule
                                </button>
                                @else
                                    <button class="btn btn-success" type="submit">+ Add New Schedule</button>
                                @endif

                                <a href="{{route('mybl.product.index')}}" class="btn btn-warning right">
                                    <i class="la la-backward"></i>
                                    Back to Product List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <span class="content-header-title">Redis Reset Schedule List</span>
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Start At</th>
                            <th>Key to reset</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ \Carbon\Carbon::parse($schedule->start_at)->format('h:i A d-m-Y') }}</td>
                                <td>{{ $schedule->redis_key_to_reset }}</td>
                                <td>
                                    <i class="badge badge-{{config('constants.status_bootstrap_classes.' . $schedule->status)}}">
                                        {{ ucwords($schedule->status) }}
                                    </i>
                                </td>
                                <td>{{$schedule->user->name ?? 'N/A'}}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-sm btn-info" title="Edit"
                                           href="{{route('redis-reset-schedules.edit', $schedule->id)}}">
                                            <i class="la la-edit"></i>
                                        </a> &nbsp;

                                        @if($schedule->status == 'active')
                                            <a class="btn btn-sm btn-warning" title="Stop Schedule"
                                               href="{{route('redis-reset-schedules.toggle-status', $schedule->id)}}">
                                                <i class="la la-stop text-white"></i>
                                            </a>
                                        @elseif($schedule->status == 'inactive')
                                            <a class="btn btn-sm btn-success" title="Start Schedule"
                                               href="{{route('redis-reset-schedules.toggle-status', $schedule->id)}}">
                                                <i class="la la-play-circle"></i>
                                            </a>
                                        @endif
                                        &nbsp;
                                        <form action="{{route('redis-reset-schedules.destroy', $schedule->id)}}"
                                              class="delete-form" method="post">
                                            @csrf @method('delete')
{{--                                            <button class="btn btn-sm btn-danger" title="Delete" type="submit">--}}
{{--                                                <i class="la la-times"></i>--}}
{{--                                            </button>--}}
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

@push('style')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/pickers/daterange/daterange.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
    <script>
        $('.delete-form').submit(function () {
            let confirmation = confirm('Are you sure to delete this Schedule?');
            return confirmation;
        });

        $('.dataTable').dataTable();

        var date;
        // Date & Time
        date = new Date();
        date.setDate(date.getDate());
        $('#start_at').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 5,
            @if($entryType == 'edit')
            startDate: '{{date('Y-m-d H:i:s', strtotime($editingSchedule->start_at))}}',
            @else
            startDate: date.getHours() > 3 ? '{{date('Y-m-d 1:00:00', strtotime('+ 1 day'))}}' : '{{date('Y-m-d H:i:s')}}',
            @endif
            minDate: date.getHours() > 3 ? '{{date('Y-m-d 1:00:00', strtotime('+ 1 day'))}}' : '{{date('Y-m-d H:i:s')}}',
            locale: {
                format: 'YYYY/MM/DD HH:mm'
            }
        });

        @if($entryType == 'create')
            $('#start_at').val("");
        @else
            $("#start_at").trigger("click");
        @endif

        $('input[name="start_at"]').on('showCalendar.daterangepicker', function (ev, picker) {
            var $hours = picker.container.find('.hourselect').children();

            $hours.filter(':gt(3)').remove();
            $hours.filter(':lt(1)').remove();
        });


    </script>
@endpush
