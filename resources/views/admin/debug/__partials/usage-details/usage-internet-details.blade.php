@if($details->status_code ==200)
    @if(count($details->data) > 0)
        <div class="list-group">
            <div class="row">
                <table class="table table-bordered" id="audit_log_table">
                    <thead>
                    <tr>
                        <th>Browse Time</th>
                        <th>Usage</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details->data as $item)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($item->start_time, 'UTC')->setTimezone('Asia/Dhaka')->toDateTimeString() }} - {{ \Carbon\Carbon::parse($item->end_time, 'UTC')->setTimezone('Asia/Dhaka')->toDateTimeString() }}</td>
                            <td>
                                @if($item->usage >= 1024)
                                    @if(floor($item->usage) == $item->usage)
                                        {{ $item->usage/1024 }} GB
                                    @else
                                        {{ round($item->usage/1024, 1) }} GB
                                    @endif
                                @else
                                    {{ round($item->usage , 1) }} MB
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning border-0 mb-2" role="alert">
                    No Data to Display
                </div>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger border-0 mb-2" role="alert">
                <strong>ERROR </strong> {{ $details->error->message }}
            </div>
        </div>
    </div>

@endif