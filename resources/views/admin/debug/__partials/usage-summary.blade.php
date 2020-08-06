@if($summary_usage->status_code ==200)
    <div class="col-md-12 border-right-blue-grey border-right-lighten-5">
        <div class="p-1 text-center">
            <div>
                <h4 class="display-4 blue-grey darken-1">TK. {{ number_format($summary_usage->data->total) }}</h4>
                <span class="blue-grey darken-1">Total Usage</span>
            </div>
            <div class="card-content">
                <div class="row mt-2">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Internet Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="info text-bold-600">
                                                @if($summary_usage->data->internet->total >= 1024)
                                                    @if(floor($summary_usage->data->internet->total) ==$summary_usage->data->internet->total)
                                                        {{ $summary_usage->data->internet->total /1024 }}
                                                    @else
                                                        {{ round($summary_usage->data->internet->total/1024, 1) }}
                                                    @endif
                                                @else
                                                    {{ round($summary_usage->data->internet->total , 1) }}
                                                @endif
                                            </h6>
                                            <p class="blue-grey lighten-2 mb-0">
                                                @if(($summary_usage->data->internet->total >= 1024))
                                                    GB
                                                @else
                                                    MB
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->internet->cost) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Tk.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Minutes Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->minutes->total) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Minutes</p>
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->minutes->cost) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Tk.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">SMS Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->sms->total) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">SMS</p>
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->sms->cost) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Tk.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Subscriptions Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->vas->total) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Active Subscriptions</p>
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->vas->cost) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">Tk.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center"> Recharge Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->recharge->total) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">TK.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center">Roaming Usage</h4>
                                <hr/>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h6 class="info text-bold-600">{{ number_format($summary_usage->data->roaming->total) }}</h6>
                                            <p class="blue-grey lighten-2 mb-0">USD</p>
                                        </div>
                                    </div>
                                </div>
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
                <strong>ERROR </strong> {{ $summary_usage->error->message }}
            </div>
        </div>
    </div>
@endif