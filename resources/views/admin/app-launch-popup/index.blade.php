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
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pop_ups as $key=>$popup)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $popup->title }}</td>
                                    <td>{{ strtoupper($popup->type) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($popup->start_date)->setTimezone('Asia/Dhaka')->toDayDateTimeString() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($popup->end_date)->setTimezone('Asia/Dhaka')->toDayDateTimeString() }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{route('app-launch.delete', $popup->id)}}" method="post">
                                                {{csrf_field()}}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-sm btn-icon btn-outline-danger delete" type="submit"><i class="la la-remove"></i></button>
                                            </form>
                                            <a href="{{ route('app-launch.edit', $popup->id) }}" class="btn btn-sm btn-icon btn-outline-success edit" title="edit"><i class="la la-eye"></i></a>
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







