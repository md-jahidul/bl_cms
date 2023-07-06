@extends('layouts.admin')
@section('title', 'Edit|Lms Tier List')
@section('card_name', 'LMS Tier')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('loyalty/tier') }}">Loyalty Tier List</a></li>
    <li class="breadcrumb-item active"> Tier Edit</li>
@endsection
@section('action')
    <a href="{{ url('loyalty/tier') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("network-types.update", $networkTypes->id) }}" method="POST" novalidate enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $networkTypes->id }}">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $networkTypes->title_en }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title (english)"
                                           value="{{ $networkTypes->title_bn }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>
                                @include('layouts.partials.common_types.image_other_component',['component'=>$networkTypes])
                                @include('layouts.partials.common_types.label_with_url')
                                <div class="form-group col-md-6 mb-2">
                                    <label for="status_input" class="required">Status: </label>
                                    <div class="form-group {{ $errors->has('status') ? ' error' : '' }}">
                                        <input required type="radio" name="status" value="1"
                                               data-validation-required-message="Please select status"
                                               id="input-radio-15" {{ ($networkTypes->status) ? 'checked' : '' }}>
                                        <label for="input-radio-15" class="mr-3">Active</label>
                                        <input required type="radio" name="status" value="0"
                                               data-validation-required-message="Please select status"
                                               id="input-radio-16" {{ ($networkTypes->status == 0) ? 'checked' : '' }}>
                                        <label for="input-radio-16" class="mr-3">Inactive</label>
                                        @if ($errors->has('status'))
                                            <div class="help-block"> {{ $errors->first('status') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop



