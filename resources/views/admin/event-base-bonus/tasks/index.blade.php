@extends('layouts.admin')
@section('title', 'Task List')
@section('card_name', 'Task List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Task List</li>
@endsection
@section('action')
    <a href="{{ url('event-base-bonus/tasks/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
        Add Task
    </a>
@endsection
@section('content')

    <section id="configuration">
        <div class="">
            <div class="col-12">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <table class="table table-striped table-bordered task-tabel">
                                <thead>
                                <tr>
                                    <th>Title EN</th>
                                    <th>Btn text EN</th>
                                    <th>Recurrence number</th>
                                    <th>Reword Prepaid</th>
                                    <th>Reword Postpaid</th>
                                    <th>Reward Text</th>
                                    <th>Event</th>
                                    <th>Tracking type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)

                                    <tr>
                                        <td>{{ $task['title_en'] }}</td>
                                        <td>{{ $task['btn_text_en'] }}</td>
                                        <td>{{ $task['recurrence_number'] }}</td>
                                        <td>{{ $task['reword_prepaid'] }}</td>
                                        <td>{{ $task['reword_postpaid'] }}</td>
                                        <td>{{ $task['reward_text'] }}</td>
                                        <td>{{ $task['event'] }}</td>
                                        <td>Tracking type</td>
                                        <td>{{ $task['status'] ? 'active':'inactive'}}</td>
                                        <td><a href="#"  class="mr-3">
                                                <i class="la la-pencil text-primary"></i>
                                            </a>
                                            <a href="#" >
                                                <i class="la la-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-js')
    <script>
        $('.task-tabel').DataTable({
            "scrollX": true
        });
    </script>
@endpush
