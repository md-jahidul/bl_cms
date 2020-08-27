@if($details->status_code ==200)
    @if(count($details->data) > 0)
        <div class="list-group">
            <div class="row">
                <table class="table table-bordered" id="audit_log_table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details->data as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->date, 'UTC')->setTimezone('Asia/Dhaka')->toDateTimeString()  }}</td>
                            <td>
                                {{ number_format($item->amount, 2, '.', '') }} Tk.
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
