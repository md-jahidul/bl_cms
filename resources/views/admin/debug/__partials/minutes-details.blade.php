@if($details->status_code ==200)
    @if(count($details->data) > 0)
        <div class="list-group">
            <div class="row">
                @foreach($details->data as $item)
                    <div class="col-md-6 mb-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="text-bold-600">{{ $item->package_name }}</h5>
                        </div>
                        <hr/>
                        <div>
                            <small class="text-muted pull-left"><strong class="info">
                                    @if(floor($item->remaining) == $item->remaining)
                                        {{ $item->remaining }}
                                    @else
                                        {{ round($item->remaining, 1) }}
                                    @endif
                                    @php
                                        $expires_in = \Carbon\Carbon::parse($item->expires_in, 'UTC')->setTimezone('Asia/Dhaka');
                                        $now        = \Carbon\Carbon::now('Asia/Dhaka');
                                        $days       = $now->diffInDays($expires_in);
                                        $hours      = $now->copy()->addDays($days)->diffInHours($expires_in);
                                        $minutes    = $now->copy()->addDays($days)->addHours($hours)->diffInMinutes($expires_in);
                                    @endphp
                                </strong> Minutes Left </small>
                            <small class="text-muted pull-right mr-5">Valid for <strong class="warning">{{ $days }}
                                    days {{ $hours }} hours {{ $minutes }} minutes
                                </strong></small>
                        </div>
                    </div>
                @endforeach
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