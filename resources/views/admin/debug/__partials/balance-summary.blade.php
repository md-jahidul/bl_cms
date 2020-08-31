@if($summary->status_code ==200)
    <div class="d-flex justify-content-center">
        @if($summary->data->connection_type == 'PREPAID')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 media-middle">
                                <h1 class="success">{{ number_format($summary->data->balance->amount, 2, '.', '') }} TK</h1>
                            </div>
                            <div class="media-body p-2">
                                <h4>Current Balance</h4>
                                <h6 class="warning">valid Till {{ \Carbon\Carbon::parse($summary->data->balance->expires_in, 'UTC')->setTimezone("Asia/Dhaka")->format('d M, Y') }} </h6>
                            </div>
                            <div class="media-right bg-success p-2 media-middle rounded-right">
                                <i class="icon-wallet font-large-2 text-white"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="col-md-6">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 media-middle">
                                <h1 class="success">{{ number_format($summary->data->balance-> total_outstanding, 2, '.', '') }} TK</h1>
                            </div>
                            <div class="media-body p-2">
                                <h4>Outstanding Balance</h4>
                                <h6 class="warning">valid Till 23 june, 2020</h6>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="progress mt-1 mb-0" style="height: 12px;background-color:#b0bec5; ">
                                            <div class="progress-bar bg-warning"
                                                 role="progressbar"
                                                 title="Limit {{ number_format($summary->data->balance->credit_limit) }}"
                                                 style="width: {{ round(($summary->data->balance-> total_outstanding/$summary->data->balance->credit_limit)*100) }}%"
                                                 aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                <b>{{ round(($summary->data->balance-> total_outstanding/$summary->data->balance->credit_limit)*100) }}%</b>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-md-4">
                                        <h6 class="mt-1">{{ $summary->data->balance->credit_limit  }}</h6>
                                    </div>--}}
                                </div>
                            </div>
                            <div class="media-right bg-success p-2 media-middle rounded-right">
                                <i class="icon-wallet font-large-2 text-white"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info"> {{ number_format($summary->data->minutes->total) }} </h3>
                                <span>MINUTES</span>
                            </div>
                            <div class="align-self-center">
                                <i class="la la-phone success font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info" id="summary_sms">{{ number_format($summary->data->sms->total) }}</h3>
                                <span>SMS</span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-speech info font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info" id="summary_data">
                                    @if($summary->data->internet->total >= 1024)
                                        @if(floor($summary->data->internet->total/1024 ) == $summary->data->internet->total/1024 )
                                            {{ $summary->data->internet->total/1024  }}
                                        @else
                                            {{ round($summary->data->internet->total/1024 , 1) }}
                                        @endif
                                    @else
                                        {{ round($summary->data->internet->total, 1) }}
                                    @endif
                                </h3>
                                <span id="data_unit">
                                    @if($data = $summary->data->internet->total >= 1024)
                                        GB
                                    @else
                                        MB
                                    @endif
                                </span>
                            </div>
                            <div class="align-self-center">
                                <i class="icon-globe primary font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger border-0 mb-2" role="alert">
                <strong>ERROR </strong> {{ $summary->error->message }}
            </div>
        </div>
    </div>

@endif

