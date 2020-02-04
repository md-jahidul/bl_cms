
@extends('layouts.admin')
@section('title', "Amar Offer Details")
@section('card_name', "Amar Offer Details")
@section('breadcrumb')
<li class="breadcrumb-item ">Offer Details List</li>
@endsection
@section('action')

@endsection
@section('content')

<section>

    @php $types = array(1=> 'Internet', 2 => 'Voice', 3 => 'Bundle'); @endphp
    @foreach($offerDetails as $details)
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="menu-title text-success"><strong> {{ $types[$details->type] }}</strong></h4><hr>
                <div class="card-body card-dashboard">
                    <div class="raw">
                        <div class="col-xs-12 col-md-5 pull-left">
                            <h5 class="text-center">
                                <strong> English</strong>
                                <hr>
                            </h5>
                            
                            {!! $details->details_en !!}
                        </div>
                        <div class="col-xs-12 col-md-5 pull-left">
                            <h5 class="text-center">
                                <strong> Bangla</strong>
                                <hr>
                            </h5>
                            {!! $details->details_bn !!}
                        </div>
                        <div class="col-xs-12 col-md-2 text-center pull-right">
                            <a href="{{ route('amaroffer.edit', [$details->id]) }}" role="button" class="btn-sm btn-warning">
                                <i class="la la-pencil-square"></i> Update
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>

@stop

