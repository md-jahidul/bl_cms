@extends('layouts.admin')
@section('title', 'Scheduler Details')
@section('card_name', 'Scheduler Details')
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    @if($productScheduleRunning)
                        <h4 class="menu-title">Schedule Data</h4>
                        <table class="table table-striped table-bordered"
                               role="grid" aria-describedby="Example1_info">
                            <thead>
                                <tr>
                                    <th>Media</th>
                                    <th>Tag</th>
                                    <th>Is Visible</th>
                                    <th>Pin To Top</th>
                                    <th>Base Group Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img class="" src="{{ asset('storage'.'/'.$product->media) }}" alt="Media"
                                             height="100" width="200"/>
                                    </td>
                                    <td>{{ $product->tag }}</td>
                                    <td>{{ $product->is_visible == 1 ? "On" : "Off" }}</td>
                                    <td> {{ $product->pin_to_top == 1 ? "On" : "Off"}}</td>
                                    <td> {{ $baseMsisdnTitleForProduct == null ? 'No Base' : $baseMsisdnTitleForProduct}}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <h4 class="menu-title"> <br> <br>
                            Scheduler Data</h4>
                        <table class="table table-striped table-bordered"
                               role="grid" aria-describedby="Example1_info">
                            <thead>
                            <tr>
                                <th>Media</th>
                                <th>Tag</th>
                                <th>Is Visible</th>
                                <th>Pin To Top</th>
                                <th>Base Group Title</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td><img class="" src="{{ asset('storage'.'/'.$scheduleProduct->media) }}" alt="Media"
                                         height="100" width="200"/>
                                </td>
                                <td>{{ $tagTitleForScheduler == null ? 'No Tag'  : $tagTitleForScheduler}}</td>
                                <td>{{ $scheduleProduct->is_visible == 1 ? "On" : "Off"}}</td>
                                <td> {{ $scheduleProduct->pin_to_top == 1 ? "On" : "Off"}}</td>
                                <td> {{ $baseMsisdnTitleForSchedule == null ? 'No Base' : $baseMsisdnTitleForSchedule }}</td>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        $(function () {
            $('#Example1').DataTable({
                buttons: [],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        })

    </script>
@endpush

