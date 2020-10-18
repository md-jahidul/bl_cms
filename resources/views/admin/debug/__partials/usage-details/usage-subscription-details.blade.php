@if($details->status_code ==200)
    @if(count($details->data) > 0)
        <div class="list-group">
            <div class="row">
                <table class="table table-bordered" id="audit_log_table">
                    <thead>
                    <tr>
                        <th>Service Name</th>
                        <th>Activation Date</th>
                        <th>Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details->data as $item)
                        <tr>
                            <td> {{ $item->service_name }}  @if($item->is_active)<i class="la la-check-circle success font-medium-1 mr-1"></i> @endif </td>
                            <td>{{ \Carbon\Carbon::parse($item->activated_date, 'UTC')->setTimezone('Asia/Dhaka')->format('d M, Y')  }}</td>
                            <td>
                                {{ number_format($item->fee, 2, '.', '') }} Tk.
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
