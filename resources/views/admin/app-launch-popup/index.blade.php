@extends('layouts.admin')
@section('title', 'App Launch Popup')
@section('card_name', 'App Launch Popup | List')

@section('action')
    <a href="{{ route('app-launch.new') }}" class="btn btn-info btn-sm btn-glow px-2">
        Add New
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Connection Type</th>
                                <th>Visibility</th>
                                <th>Schedule Information</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pop_ups as $key => $popup)
                                @php
                                    $recurringType = $popup->recurring_type;
                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $popup->title }}</td>
                                    <td>{{ strtoupper($popup->type) }}</td>
                                    <td>{{ strtoupper($popup->connection_type) }}</td>
                                    <td>
                                        @php
                                            echo $popup->visibilityStatus() ? "<span class='badge badge-success'>Visible</span>"
                                               : "<span class='badge badge-danger'>Not Visible</span>";
                                        @endphp
                                    </td>
                                    <td>
                                        Recurring Type: <strong>{{ ucwords($recurringType) }}</strong><br>
                                        @if($recurringType == 'none')
                                            Start Time:
                                            <strong>
                                                {{ \Carbon\Carbon::parse($popup->start_date)->setTimezone('Asia/Dhaka')->toDayDateTimeString() }}
                                            </strong><br>
                                            End Time:
                                            <strong>
                                                {{ \Carbon\Carbon::parse($popup->end_date)->setTimezone('Asia/Dhaka')->toDayDateTimeString() }}
                                            </strong>

                                        @else
                                            @php
                                                $schedule = $popup->schedule;
                                                $timeSlots = $popup->timeSlots;
                                            @endphp
                                            @if($recurringType == 'weekly')
                                                Weekdays: <strong>{{strtoupper($schedule->weekdays)}}</strong><br>
                                            @endif
                                            @if($recurringType == 'monthly')
                                                Month dates:  <strong>{{strtoupper($schedule->month_dates)}}</strong>
                                                <br>
                                            @endif
                                            Time slots:
                                            @foreach($timeSlots as $timeSlot)
                                                <span class="badge badge-info">
                                                    {{\Carbon\Carbon::parse($timeSlot->start_time)->format('h:i: A')}} -
                                                    {{\Carbon\Carbon::parse($timeSlot->end_time)->format('h:i: A')}}
                                                </span>
                                            @endforeach

                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{route('app-launch.delete', $popup->id)}}" method="post">
                                                {{csrf_field()}}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-sm btn-icon btn-outline-danger delete"
                                                        type="submit"><i class="la la-remove"></i></button>
                                            </form>
                                            <a href="{{ route('app-launch.edit', $popup->id) }}"
                                               class="btn btn-sm btn-icon btn-outline-success edit" title="edit"><i
                                                    class="la la-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $pop_ups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop







