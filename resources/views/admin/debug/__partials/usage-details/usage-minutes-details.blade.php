@if($details->status_code ==200)
    @if(count($details->data) > 0)
        <div class="list-group">
            <div class="row">
                <table class="table table-bordered" id="audit_log_table">
                    <thead>
                    <tr>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Cost</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($details->data as $item)
                        <tr>
                            <td>{{ $item->number }}</td>
                            <td>
                                @if($item->is_outgoing)
                                    <span class="badge badge-default badge-info">Outgoing</span>
                                @else
                                    <span class="badge badge-default badge-success">Incoming</span>
                                @endif
                            </td>
                            <td>
                                {{  gmdate("H:i:s", $item->duration ) }}
                            </td>
                            <td>
                                {{ number_format($item->cost) }} Tk.
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